<?php

namespace Webkul\Discount\Http\Controllers;
use phpDocumentor\Reflection\Types\Collection;
use Webkul\Discount\Models\GiftRuleProducts;
use Webkul\Product\Repositories\ProductFlatRepository as Product;
use Webkul\Discount\Repositories\GiftRuleRepository as GiftRule;
use Webkul\Discount\Repositories\GiftRuleChannelsRepository as GiftRuleChannels;
use Webkul\Discount\Repositories\GiftRuleCustomerGroupsRepository as GiftRuleCustomerGroups;
use Webkul\Discount\Helpers\Catalog\Apply;

/**
 * GiftRule controller
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright  2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class GiftRuleController extends Controller
{
    /**
     * Initialize _config, a default request parameter with route
     */
    protected $_config;

    /**
     * Product $product
     */
    protected $product;

    /**
     * Property for catalog rule application
     */
    protected $appliedConfig;

    /**
     * Property for catalog rule application
     */
    protected $appliedConditions;

    /**
     * Property to hold Catalog Rule Channels Repository
     */
    protected $giftRuleChannels;

    /**
     * Property to hold Catalog Rule Customer Groups Repository
     */
    protected $giftRuleCustomerGroups;

    /**
     * Property to hold Catalog Rule Customer Groups Repository
     */
    protected $giftRuleProducts;

    /**
     * To hold catalog repository instance
     */
    protected $giftRule;

    /**
     * To hold Sale instance
     */
    protected $apply;

    public function __construct(
        Product $product,
        GiftRule $giftRule,
        GiftRuleChannels $giftRuleChannels,
        GiftRuleCustomerGroups $giftRuleCustomerGroups,
        GiftRuleProducts $giftRuleProducts,
        Apply $sale
    ) {
        $this->_config = request('_config');
        $this->product = $product;
        $this->giftRule = $giftRule;
        $this->giftRuleChannels = $giftRuleChannels;
        $this->giftRuleCustomerGroups = $giftRuleCustomerGroups;
        $this->giftRuleProducts = $giftRuleProducts;
    }

    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * To load create form for catalog rule
     *
     * @return View
     */
    public function create()
    {
        return view($this->_config['view']);
    }

    /**
     * To store newly created catalog rule and store it
     *
     * @return Redirect
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|string|unique:gift_rules,name',
            'customer_groups' => 'required',
            'channels' => 'required',
            'status' => 'required|boolean',
            'action_amount' => 'required|numeric',
//            'related_products' => 'required',
        ]);

        $gift_rule = request()->all();

        $gift_rule_channels = array();
        $gift_rule_customer_groups = array();

        $gift_rule_channels = $gift_rule['channels'];
        $gift_rule_customer_groups = $gift_rule['customer_groups'];

        unset($gift_rule['channels']); unset($gift_rule['customer_groups']);
        unset($gift_rule['_token']);

        $giftRule = $this->giftRule->create($gift_rule);

        foreach($gift_rule_channels as $gift_rule_channel) {
            $data['gift_rule_id'] = $giftRule->id;
            $data['channel_id'] = $gift_rule_channel;

            $giftRuleChannels = $this->giftRuleChannels->create($data);
        }
        unset($data);

        foreach ($gift_rule_customer_groups as $gift_rule_customer_group) {
            $data['gift_rule_id'] = $giftRule->id;
            $data['customer_group_id'] = $gift_rule_customer_group;

            $giftRuleCustomerGroups = $this->giftRuleCustomerGroups->create($data);
        }
        unset($data);


        if($giftRule && $giftRuleChannels && $giftRuleCustomerGroups) {
            session()->flash('success', trans('admin::app.promotion.status.success'));

            return redirect()->route('admin.gift-rule.index');
        } else {
            session()->flash('error', trans('admin::app.promotion.status.failed'));

            return redirect()->back();
        }
    }

    /**
     * To load edit for previously created catalog rule
     *
     * @param $id
     *
     * @return View
     */
    public function edit($id)
    {
        $gift_rule = $this->giftRule->find($id);

        $gift_rule_channels = $this->giftRuleChannels->findByField('gift_rule_id', $id);

        $gift_rule_customer_groups = $this->giftRuleCustomerGroups->findByField('gift_rule_id', $id);

        return view($this->_config['view'])->with('gift_rule', [
                $gift_rule,
                $gift_rule_channels,
                $gift_rule_customer_groups
            ]);
    }

    /**
     * To update previously created catalog rule
     *
     * @param $id
     *
     * @return Redirect
     */
    public function update($id)
    {
        $data = request()->input();

        $this->validate(request(), [
            'name' => 'required|string|unique:catalog_rules,name,'.$id,
            'customer_groups' => 'required',
            'channels' => 'required',
            'status' => 'required|boolean',
            'action_amount' => 'required|numeric',
//            'related_products' => 'required',
        ]);

        $gift_rule = request()->all();

        $gift_rule_channels = array();
        $gift_rule_customer_groups = array();
        $gift_rule_products = array();

        $gift_rule_channels = $gift_rule['channels'];
        $gift_rule_customer_groups = $gift_rule['customer_groups'];
        $gift_rule_products = $gift_rule['related_products'];
        unset($gift_rule['channels']); unset($gift_rule['customer_groups']);
        unset($gift_rule['related_products']);

        $giftRule = $this->giftRule->update($gift_rule, $id);

        $giftRuleChannels = $this->giftRule->ChannelSync($gift_rule_channels, $giftRule);
        $giftRuleCustomerGroups = $this->giftRule->CustomerGroupSync($gift_rule_customer_groups, $giftRule);
        $giftRuleProducts = $this->giftRule->ProductSync($gift_rule_products, $giftRule);
        $giftRuleProducts = true;

        if($giftRule && $giftRuleChannels && $giftRuleCustomerGroups && $giftRuleProducts) {
            session()->flash('success', trans('admin::app.promotion.status.update-success'));

            return redirect()->route($this->_config['redirect']);
        } else {
            session()->flash('error', trans('admin::app.promotion.status.update-failed'));

            return redirect()->back();
        }
    }

    /**
     * To delete existing catalog rule
     *
     * @param Integer $id
     *
     * @return Redirect
     */
    public function destroy($id)
    {
        $giftRule = $this->giftRule->findOrFail($id);

        if ($giftRule->delete()) {
            session()->flash('success', trans('admin::app.promotion.status.delete-success'));

            return response()->json(['message' => true], 200);
        } else {
            session()->flash('error', trans('admin::app.promotion.status.delete-failed'));

            return response()->json(['message' => false], 400);
        }
    }

    /**
     * Get Countries and states list from core helpers
     *
     * @return Array
     */
    public function getStatesAndCountries()
    {
        $countries = core()->countries()->toArray();
        $states = core()->groupedStatesByCountries();

        return [
            'countries' => $countries,
            'states' => $states
        ];
    }
}