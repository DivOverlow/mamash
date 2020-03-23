<?php

namespace Webkul\Liqpay\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use LiqPay as LiqPaySDK;
use Webkul\Checkout\Facades\Cart;
use Webkul\Sales\Models\Invoice;
use Webkul\Sales\Models\Order;
use Webkul\Sales\Repositories\InvoiceRepository;
use Webkul\Sales\Repositories\OrderRepository;

/**
 * Liqpay controller
 *
 */
class LiqpayController extends BaseController
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $orderRepository;

    /**
     * InvoiceRepository object
     *
     * @var object
     */
    protected $invoiceRepository;

    /**
     * @var string
     */
    protected $public_key;

    /**
     * @var string
     */
    protected $private_key;

    /**
     * @var LiqPaySDK
     */
    protected $liqpay;

    /**
     * LiqpayController constructor.
     * @param OrderRepository $orderRepository
     * @param InvoiceRepository $invoiceRepository
     */
    public function __construct(
        OrderRepository $orderRepository,
        InvoiceRepository $invoiceRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->invoiceRepository = $invoiceRepository;

        $this->public_key   = env('LIQPAY_PUBLIC','sandbox');
        $this->private_key  = env('LIQPAY_PRIVATE','sandbox');
        $this->liqpay       = new LiqPaySDK( $this->public_key, $this->private_key );
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Exception
     */
    public function redirect()
    {
        $order = $this->maybeCreateOrderFromCart();

        if ( !empty( $order )
            && ( $order instanceof Order )
            && $order->payment
            && $order->payment->method == 'liqpay' ){
            $html_form = $this->getHtmlForm( $order );
        } else {
            $html_form = false;
            session()->flash('error', 'LiqPay. Error' );
        }

        return $html_form ? view('liqpay::standard-redirect',['html_form' => $html_form ] ) : redirect()->back();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function result( Request $request ){
        $this->validate($request, [
            'signature' => 'required|max:255',
            'data'      => 'required',
        ]);

        $data       = $request->get('data');
        $signature  = $request->get('signature');

        if ( !$this->verifyParams( $data, $signature )) {
            session()->flash('error', 'Error LiqPay signature verify');
            return redirect()->route('shop.checkout.cart.index');
        }

        $result = $this->parsingRequestData( $data );

        if ( isset( $result['success'] ) ) {
            $this->maybePaidOrder( $result['success'] );
            return redirect()->route('shop.checkout.success');
        }

        if ( isset( $result['error'] ) ) {
            session()->flash('error', 'LiqPay. ' . $result['error']);
        }

        if ( isset( $result['cancel'] ) ) {
            $this->maybeCancelOrder( $result['cancel'] );
        }

        return redirect()->route('shop.checkout.cart.index');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Exception
     */
    public function server( Request $request ){
        $this->validate($request, [
            'signature' => 'required|max:255',
            'data'      => 'required',
        ]);

        $data       = $request->get('data');
        $signature  = $request->get('signature');

        if ( !$this->verifyParams( $data, $signature )) {
            return response('Forbidden Signature',403);
        }

        $result = $this->parsingRequestData( $data );

        if ( isset( $result['error'] ) ) {
            return response('Forbidden.' . $result['error'],403);
        }

        if ( isset( $result['success'] ) ) {
            $this->maybePaidOrder( $result['success'] );
        }

        if ( isset( $result['cancel'] ) ) {
            $this->maybeCancelOrder( $result['cancel'] );
        }

        return response('OK.' ,200);
    }




    //Protected methods

    /**
     * @return mixed|string
     * @throws \Exception
     */
    protected function maybeCreateOrderFromCart(){
        $cart = Cart::getCart();

        if ( empty( $cart ) ) {
            return '';//exception
        }

        $order = $this->orderRepository->findOneWhere(['cart_id' => $cart->id, 'status' => 'pending' ]);

        if ( empty( $order ) ) {
            $order = $this->orderRepository->findOneWhere(['cart_id' => $cart->id, 'status' => 'pending_payment' ]);
        }

        if ( empty( $order ) && $this->orderRepository->findOneWhere(['cart_id' => $cart->id ])) {
            return '';//exception
        }

        if ( empty( $order ) ) {
            $order = $this->orderRepository->create(Cart::prepareDataForOrder() );
        }

        return $order;
    }


    /**
     * @param Order $order
     * @return string
     */
    protected function getHtmlForm( Order $order ){
        if ( empty( $order ) ) {
            return '';
        }

        $params = array(
            'action'         => 'pay',
            'amount'         => $order->grand_total,
            'currency'       => $order->order_currency_code,
            'description'    => $order->customer_first_name . ' ' . $order->customer_last_name . ', ' .__('admin::app.sales.orders.view-title', ['order_id' => $order->id]),
            'order_id'       => $order->id,
            'version'        => '3',
            'result_url'     => route('liqpay.result'),
            'server_url'     => route('liqpay.server')
        );

        $html = $this->liqpay->cnb_form($params);

        return $html;
    }


    /**
     * @param $data
     * @param $signature
     * @return bool
     */
    protected function verifyParams( $data, $signature ){
        $sign = $this->liqpay->str_to_sign($this->private_key . $data . $this->private_key );
        return $signature ==  $sign;
    }


    /**
     * @param string $request_data
     * @return array
     */
    protected function parsingRequestData( $request_data ){
        $parsed_data = $this->liqpay->decode_params( $request_data );
        if ( empty( $parsed_data['order_id'] ) ) {
            return ['error' => 'Empty order_id'];
        }

        $order = $this->orderRepository->findOneByField(['id' => $parsed_data['order_id'] ]);
        if ( empty( $order ) ) {
            return ['error' => 'Order not found'];
        }

        $apiStatus = $this->getApiFromOrderId( $parsed_data['order_id'] );
        if( empty( $apiStatus ) || empty( $apiStatus->order_id )
            || empty($apiStatus->amount)
            || empty($apiStatus->currency)
            || empty($order->payment)
            || $order->payment->method != 'liqpay'
            || $order->grand_total != $apiStatus->amount
            || $order->order_currency_code != $apiStatus->currency )
        {
            return ['error' => 'Error found order from LiqPay API'];
        }

        if ( in_array( $apiStatus->status,['success'] ) ) {
            return ['success' => $apiStatus];
        }

        if ( in_array( $apiStatus->status,['error','failure','reversed','cancel'] ) ) {
            return [ 'cancel' => $parsed_data['order_id'] ];
        }
    }

    /**
     * @param int $order_id
     * @return \stdClass|null
     */
    protected function getApiFromOrderId( $order_id = 0 ){
        $requestAPI = $this->liqpay->api("request", array(
            'action'        => 'status',
            'version'       => '3',
            'order_id'      => $order_id
        ));

        return $this->liqpay->get_response_code() == 200 ? $requestAPI : null;
    }


    /**
     * @param int $order_id
     */
    protected function maybeCancelOrder( $order_id )
    {
        $result = $this->orderRepository->cancel($order_id);

        if ($result) {
            session()->flash('success', trans('admin::app.response.cancel-success', ['name' => 'Order']));
        } else {
            session()->flash('error', trans('admin::app.response.cancel-error', ['name' => 'Order']));
        }
    }

    /**
     * @param \stdClass $apiStatus
     * @throws \Exception
     */
    protected function maybePaidOrder( \stdClass $apiStatus )
    {
        if ( empty( $apiStatus->order_id )) {
            return;
        }

        $order = $this->orderRepository->getOrder( $apiStatus->order_id );
        if ( empty( $order )) {
            return;
        }

        /** @var Order $order */
        if ( !$order->canInvoice() || $order->invoices()->count() ) {
            return;
        }

        Cart::deActivateCart();

        $invoiceData = [
            "order_id" => $order->id
        ];

        foreach ( $order->items as $item ) {
            $invoiceData['invoice']['items'][$item->id] = $item->qty_to_invoice;
        }

        $invoice = $this->invoiceRepository->create($invoiceData);
        if ( $invoice instanceof Invoice ) {
            $invoice->transaction_id = $apiStatus->transaction_id;
            $invoice->save();
        }

        session()->flash('order', $order);
    }
}