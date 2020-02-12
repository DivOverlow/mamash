<?php

namespace Webkul\Shop\Http\Controllers;

use Webkul\Customer\Repositories\WishlistRepository;
use Webkul\Product\Repositories\ProductRepository;
use Cart;

/**
 * Cart controller for the customer and guest users for adding and
 * removing the products in the cart.
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @author  Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class CartController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * WishlistRepository Repository object
     *
     * @var Object
     */
    protected $wishlistRepository;

    /**
     * ProductRepository object
     *
     * @var Object
     */
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Customer\Repositories\CartItemRepository $wishlistRepository
     * @param  \Webkul\Product\Repositories\ProductRepository   $productRepository
     * @return void
     */
    public function __construct(
        WishlistRepository $wishlistRepository,
        ProductRepository $productRepository
    )
    {
        $this->middleware('customer')->only(['moveToWishlist']);

        $this->wishlistRepository = $wishlistRepository;

        $this->productRepository = $productRepository;

        $this->_config = request('_config');
    }

    /**
     * Method to populate the cart page which will be populated before the checkout process.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Cart::collectTotals();

        return view($this->_config['view'])->with('cart', Cart::getCart());
    }

    /**
     * Function for guests user to add the product in the cart.
     *
     * @return Mixed
     */
    public function add($id)
    {
        try {
            $result = Cart::addProduct($id, request()->all());

            if ($result) {
                $message = $this->checkedGift($result->base_sub_total);
//                session()->flash('success', trans('shop::app.checkout.cart.item.success') . ' ' . $message );

                if ($customer = auth()->guard('customer')->user())
                    $this->wishlistRepository->deleteWhere(['product_id' => $id, 'customer_id' => $customer->id]);

                if (request()->get('is_buy_now'))
                    return redirect()->route('shop.checkout.onepage.index');
            } else {
                session()->flash('warning', trans('shop::app.checkout.cart.item.error-add'));
            }
        } catch(\Exception $e) {
            session()->flash('error', trans($e->getMessage()));

            $product = $this->productRepository->find($id);

            return redirect()->route('shop.products.index', ['slug' => $product->url_key]);
        }

        return redirect()->back();
    }

    /**
     * Removes the item from the cart if it exists
     *
     * @param integer $itemId
     * @return Response
     */
    public function remove($itemId)
    {
        $result = Cart::removeItem($itemId);

        if ($result)  {
            $cart = Cart::getCart();
            $message = '';
            if($cart) {
                $message = $this->checkedGift($cart->base_sub_total);
            }
            else $this->checkedGift(0);

            session()->flash('success', trans('shop::app.checkout.cart.item.success-remove') . ' ' . $message );

        }


        return redirect()->back();
    }

    /**
     * Updates the quantity of the items present in the cart.
     *
     * @return Response
     */
    public function updateBeforeCheckout()
    {
        try {
            $result = Cart::updateItems(request()->all());


            if ($result) {

                $request = request()->all();

                if (isset($request['product_gift_id']))
                    $new_product_gift_id = (int) $request['product_gift_id'];
                else
                    $new_product_gift_id = null;

                $cart = Cart::getCart();
                $message = $this->checkedGift($cart->base_sub_total, $new_product_gift_id);
                session()->flash('success', trans('shop::app.checkout.cart.quantity.success') . ' ' . $message );

            }

        } catch(\Exception $e) {
            session()->flash('error', trans($e->getMessage()));
        }

        return redirect()->back();
    }

    /**
     * Function to move a already added product to wishlist will run only on customer authentication.
     *
     * @param integer $id
     * @return Response
     */
    public function moveToWishlist($id)
    {
        $result = Cart::moveToWishlist($id);

        if ($result) {
            session()->flash('success', trans('shop::app.wishlist.moved'));
        } else {
            session()->flash('warning', trans('shop::app.wishlist.move-error'));
        }

        return redirect()->back();
    }

    public function checkedGift($cart_base_sub_total, $new_product_gift_id = null)
    {
        if ($cart_base_sub_total > 0) {
            $gift_products = app('Webkul\Discount\Repositories\GiftRuleRepository')->getGiftsProduct();

            if(count($gift_products)) {
                $gifts = [];
                foreach ($gift_products as $gift_product) {
                    if( $cart_base_sub_total < $gift_product->action_amount) {
                        break;
                    }

                    if(isset($gift_product->related_products()->first()->product_id)) {
                        $gifts[] = $gift_product->related_products()->first()->product_id;
                    }
                }
                if (count($gifts) > 0) {
                    if (in_array($new_product_gift_id, $gifts)
                        && ((int) session()->has('gift_product_id') != $new_product_gift_id)) {
                        if (session()->has('gift_product_id')) {
                            session()->forget('gift_product_id');
                        }
                        session()->put('gift_product_id', $new_product_gift_id);
                        return trans('shop::app.checkout.gift.gift-selected');
                    }
                    if (session()->has('gift_product_id')) {
                        if (!in_array(session()->get('gift_product_id'), $gifts) ) {
                            session()->forget('gift_product_id');
                            session()->put('gift_product_id', end($gifts));
                            return trans('shop::app.checkout.gift.gift-change');
                        }
                    }
                    else {
                        session()->put('gift_product_id', end($gifts));
                        session()->put('new_gift_product', end($gifts));
                        return trans('shop::app.checkout.gift.gift-available');
                    }
                }
                elseif (session()->has('gift_product_id')) {
                    session()->forget('gift_product_id');
                    return trans('shop::app.checkout.gift.gift-not-available');
                }
            }
        }
        elseif (session()->has('gift_product_id')) {
            session()->forget('gift_product_id');
        }
    }

    /**
     * Change gift to the cart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeGift()
    {
        $gift_id= (int) request()->get('product_gift_id');

        try {
            if ($gift_id > 0) {
                $message = $this->checkedGift(Cart::getCart()->base_sub_total, $gift_id);

                session()->flash('success',  $message );

                    return response()->json([
                        'success' => true,
                        'message' => $message
                    ]);

            }

            session()->flash('warning',  trans('shop::app.checkout.cart.gift.gift-change-error') );

            return response()->json([
                'success' => false,
                'message' => trans('shop::app.checkout.cart.gift.gift-change-error')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => trans('shop::app.checkout.cart.gift.gift-change-error')
            ]);
        }
    }

    /**
     * Apply coupon to the cart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyCoupon()
    {
        $couponCode = request()->get('code');

        try {
            if (strlen($couponCode)) {
                Cart::setCouponCode($couponCode)->collectTotals();

                if (Cart::getCart()->coupon_code == $couponCode) {
                    return response()->json([
                        'success' => true,
                        'message' => trans('shop::app.checkout.total.success-coupon')
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => trans('shop::app.checkout.total.invalid-coupon')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => trans('shop::app.checkout.total.coupon-apply-issue')
            ]);
        }
    }

    /**
     * Apply coupon to the cart
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeCoupon()
    {
        Cart::removeCouponCode()->collectTotals();

        return response()->json([
            'success' => true,
            'message' => trans('shop::app.checkout.total.remove-coupon')
        ]);
    }


}