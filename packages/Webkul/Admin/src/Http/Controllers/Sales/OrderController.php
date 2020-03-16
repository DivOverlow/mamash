<?php

namespace Webkul\Admin\Http\Controllers\Sales;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Payment\Facades\Payment;
use Webkul\Sales\Repositories\OrderItemRepository;
use Webkul\Sales\Repositories\OrderPaymentRepository;
use Webkul\Shipping\Facades\Shipping;
use Webkul\Sales\Repositories\OrderAddressRepository;
use Webkul\Sales\Repositories\OrderRepository;

/**
 * Sales Order controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * OrderRepository object
     *
     * @var array
     */
    protected $orderRepository;
    protected $orderItemRepository;
    protected $orderAddressRepository;
    protected $orderPaymentRepository;


    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository $orderRepository
     * @return void
     */
    public function __construct(OrderRepository $orderRepository,
                                OrderAddressRepository $orderAddressRepository,
                                OrderPaymentRepository $orderPaymentRepository,
                                OrderItemRepository $orderItemRepository
                                )
    {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderAddressRepository = $orderAddressRepository;
        $this->orderPaymentRepository = $orderPaymentRepository;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function view($id)
    {
        $order = $this->orderRepository->findOrFail($id);

        return view($this->_config['view'], compact('order'));
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit_shipping($id)
    {
        $order = $this->orderRepository->findOrFail($id);

        return view($this->_config['view'], compact('order'));
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $order = $this->orderRepository->findOrFail($id);

        return view($this->_config['view'], compact('order'));
    }

    /**
     * Show the view for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit_payment($id)
    {
        $order = $this->orderRepository->findOrFail($id);

        $paymentMethods = Payment::getPaymentMethods();

        $shippingRateGroups = Shipping::getShippingMethods($id);

        return view($this->_config['view'], compact('order', 'paymentMethods', 'shippingRateGroups'));
    }

    /**
     * Cancel action for the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $result = $this->orderRepository->cancel($id);

        if ($result) {
            session()->flash('success', trans('admin::app.response.cancel-success', ['name' => 'Order']));
        } else {
            session()->flash('error', trans('admin::app.response.cancel-error', ['name' => 'Order']));
        }

        return redirect()->back();
    }

    /**
     * Edit's the premade resource of customer called
     * Address.
     *
     * @return redirect
     */
    public function update($orderId)
    {
         $this->validate(request(), [
            'qty_ordered.items.*' => 'required|numeric|min:0',
        ]);

        $haveProductToOrder = false;
        $productGift_id = 0;
        $orderItem_id = 0;

        $data = request()->all();

        foreach ($data['qty_ordered']['items'] as $itemId => $qty) {
            if ($qty) {
                $haveProductToOrder = true;
                break;
            }
        }

        foreach ($data['product_id'] as $itemId => $id) {
            $orderItem_id = $itemId;
            if ($id) {
                $productGift_id = $id;
                break;
            }
        }

        if (! $haveProductToOrder ) {
                session()->flash('error', trans('admin::app.sales.orders.product-error'));
            return redirect()->back();
        }

        $is_OrderModify = false;

        foreach ($data['qty_ordered']['items'] as $itemId => $qty) {
            if ($qty) {
                $orderItem = $this->orderItemRepository->findOrFail($itemId);
                if ($orderItem->qty_ordered != $qty) {


                    $orderItem->total = core()->convertPrice($orderItem->price * $qty);
                    $orderItem->base_total = $orderItem->price * $qty;
                    $orderItem->total_weight = $orderItem->weight * $qty;
                    $orderItem->discount_amount = $orderItem->discount_amount / $orderItem->qty_ordered * $qty;
                    $orderItem->base_discount_amount = $orderItem->base_discount_amount / $orderItem->qty_ordered * $qty;
                    $orderItem->qty_ordered = $qty;
                    $orderItem->save();
                    $this->orderItemRepository->calculateItemsTax($orderItem);
                    $this->orderItemRepository->collectTotals($orderItem);
                    $is_OrderModify = true;
                }
            }
            else {
                $this->orderItemRepository->delete($itemId);
                $is_OrderModify = true;
            }
        }

        if ($productGift_id) {
            $product = app('Webkul\Product\Repositories\ProductRepository')->findByIdOrFail($productGift_id);
            if ($orderItem_id) {
                $orderItem = $this->orderItemRepository->findOrFail($orderItem_id);
                if ($orderItem->product_id != $productGift_id) {
                    // update Gift product
                    $orderItem->sku = $product->sku;
                    $orderItem->type = $product->type;
                    $orderItem->name = $product->name;
                    $orderItem->weight = $product->weight;
                    $orderItem->total_weight = $product->weight;
                    $orderItem->product_id = $productGift_id;
                    $orderItem->save();
                }
            }
            else {
                // Add Gift product
                $data = [];
                $data['sku'] = $product->sku;
                $data['type'] = $product->type;
                $data['name'] = $product->name;
                $data['weight'] = $product->weight;
                $data['total_weight'] = $product->weight;
                $data['qty_ordered'] = 1;
                $data['qty_shipped'] = 0;
                $data['qty_invoiced'] = 0;
                $data['qty_canceled'] = 0;
                $data['qty_refunded'] = 0;
                $data['product_id'] = $productGift_id;
                $data['product_type'] = 'Webkul\Product\Models\Product';
                $data['order_id'] = $orderId;
                $this->orderItemRepository->create($data);
            }
        }  else {
            if ($orderItem_id) {
                // delete Gift product
                $this->orderItemRepository->delete($orderItem_id);
            }
        }

        if ($is_OrderModify) {
            $order = $this->orderRepository->calculateOrder($orderId);

            $this->orderRepository->collectTotals($order);

            if(isset($order->status) && $order->status == 'pending')
                $this->orderRepository->updateOrderStatus($order);

        }

        session()->flash('success', trans('admin::app.sales.orders.order-update-success'));

        return redirect()->route($this->_config['redirect'], $orderId);
    }

    /**
     * Edit's the premade resource of customer called
     * Address.
     *
     * @return redirect
     */
    public function update_shipping($id)
    {

        $this->validate(request(), [
            'first_name' => 'string|required',
            'last_name' => 'string|required',
            'city' => 'string|required',
            'address1' => 'string|required',
            'phone' => 'string|required',
        ]);

        $address = $this->orderAddressRepository->update(request()->all(), $id);

        if($address) {
            $order = $this->orderRepository->findOrFail($id);

            if($order->status == 'pending')
                $this->orderRepository->updateOrderStatus($order);

            session()->flash('success', trans('admin::app.sales.orders.order-update-success'));
        }

        return redirect()->route($this->_config['redirect'], $id);
    }

    /**
     * Edit's the premade resource of customer called
     * Address.
     *
     * @return redirect
     */
    public function update_payment($id)
    {

        $data['method'] = request()->all()['payment_method'];

        $order = $this->orderRepository->findOrFail($id);

        $payment = $this->orderPaymentRepository->update($data, $id);

        if($payment) {
            $shippingRateGroups = Shipping::getShippingMethods($id);

            foreach ($shippingRateGroups as $rateGroup) {
                foreach ($rateGroup['rates'] as $rate) {
                    if($rate->method == request()->all()['shipping_method']) {
                        $order->shipping_method = $rate->method;
                        $order->shipping_title = $rate->method_title;
                        $order->shipping_description = $rate->method_description;
                        $order->shipping_amount = $rate->price;
                        $order->base_shipping_amount = $rate->base_price;
                        break;
                    }
                }
            }

            $this->orderRepository->collectTotals($order);

            if($order->status == 'pending')
                $this->orderRepository->updateOrderStatus($order);

            session()->flash('success', trans('admin::app.sales.orders.order-update-success'));
        }

        return redirect()->route($this->_config['redirect'], $id);
    }
}