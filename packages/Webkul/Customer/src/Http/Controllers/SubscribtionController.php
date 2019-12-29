<?php

namespace Webkul\Customer\Http\Controllers;

use Auth;
use Webkul\Customer\Repositories\CustomerRepository;

/**
 * Customer controlller for the customer basically for the tasks of customers which will
 * be done after customer authenticastion.
 *
 * @author    Prashant Singh <prashant.singh852@webkul.com>
 * @param  \Webkul\Customer\Repositories\CustomerRepository $customer
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class SubscriptionController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CustomerRepository object
     *
     * @var Object
     */
    protected $customerRepository;


    /**
     * CustomerAddressRepository object
     *
     * @var Object
     */

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->middleware('customer');

        $this->_config = request('_config');

        $this->customerRepository = $customerRepository;

        $this->customer = auth()->guard('customer')->user();
    }

    /**
     * Address Route index page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customer = $this->customerRepository->find(auth()->guard('customer')->user()->id);

        return view($this->_config['view'], compact('customer'));
    }

}
