<?php

namespace Webkul\Admin\Http\Controllers\Sales;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Payment\Facades\Payment;
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
                                OrderPaymentRepository $orderPaymentRepository)
    {
        $this->middleware('admin');

        $this->_config = request('_config');

        $this->orderRepository = $orderRepository;
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
    public function update($id)
    {

//        $data['method'] = request()->all()['payment_method'];
//
//        $order = $this->orderRepository->findOrFail($id);
//
//        $payment = $this->orderPaymentRepository->update($data, $id);
//
//        if($payment) {
//            $shippingRateGroups = Shipping::getShippingMethods($id);
//
//            foreach ($shippingRateGroups as $rateGroup) {
//                foreach ($rateGroup['rates'] as $rate) {
//                    if($rate->method == request()->all()['shipping_method']) {
//                        $order->shipping_method = $rate->method;
//                        $order->shipping_title = $rate->method_title;
//                        $order->shipping_description = $rate->method_description;
//                        $order->shipping_amount = $rate->price;
//                        $order->base_shipping_amount = $rate->base_price;
//                        break;
//                    }
//                }
//            }
//
//            $this->orderRepository->collectTotals($order);
//            $this->orderRepository->updateOrderStatus($order);
//            session()->flash('success', trans('admin::app.sales.orders.order-update-success'));
//        }

        return redirect()->route($this->_config['redirect'], $id);
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
            $this->orderRepository->updateOrderStatus($order);
            session()->flash('success', trans('admin::app.sales.orders.order-update-success'));
        }

        return redirect()->route($this->_config['redirect'], $id);
    }
}