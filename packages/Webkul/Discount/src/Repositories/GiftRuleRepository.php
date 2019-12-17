<?php

namespace Webkul\Discount\Repositories;

use Webkul\Core\Eloquent\Repository;
use Webkul\Discount\Models\GiftRuleProducts as GiftRuleProducts;
use Webkul\Discount\Repositories\GiftRuleChannelsRepository as GiftRuleChannels;
use Webkul\Discount\Repositories\GiftRuleCustomerGroupsRepository as GiftRuleCustomerGroups;
use Illuminate\Container\Container as App;

/**
 * GiftRuleReposotory
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com>
 * @copyright  2019 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class GiftRuleRepository extends Repository
{
    /**
     * Will hold giftRuleChannelsRepository instance
     */
    protected $giftRuleChannels;

    /**
     * Will hold giftRuleCustomerGroupsRepository instance
     */
    protected $giftRuleCustomerGroups;

    /**
     * Will hold giftRuleProductsRepository instance
     */
    protected $giftRuleProducts;

    /**
     * @param GiftRuleChannels $giftRuleChannels
     * @param GiftRuleCustomerGroups $giftRuleProducts
     * @param GiftRuleCustomerGroups $giftRuleCustomerGroups
     * @param App $app
     */
    public function __construct(GiftRuleChannels $giftRuleChannels, GiftRuleCustomerGroups $giftRuleCustomerGroups, GiftRuleProducts $giftRuleProducts, App $app)
    {
        $this->giftRuleChannels = $giftRuleChannels;

        $this->giftRuleCustomerGroups = $giftRuleCustomerGroups;

        $this->giftRuleProducts = $giftRuleProducts;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return String
     */
    function model()
    {
        return 'Webkul\Discount\Contracts\GiftRule';
    }

    /**
     * To sync the customer groups related records
     *
     * @param Array $newCustomerGroups
     * @param GiftRule $giftRule
     *
     * @return Boolean
     */
    public function CustomerGroupSync($newCustomerGroups, $giftRule)
    {
        $oldCustomerGroups = array();
        foreach ($giftRule->customer_groups as $oldCustomerGroup) {
            array_push($oldCustomerGroups, ['id' => $oldCustomerGroup->id, 'customer_group_id' => $oldCustomerGroup->customer_group_id]);
        }

        foreach ($oldCustomerGroups as $key => $oldCustomerGroup) {
            $found = 0;

            foreach($newCustomerGroups as $newCustomerGroup) {
                if ($oldCustomerGroup['customer_group_id'] == $newCustomerGroup)
                    $found = 1;
            }

            if ($found == 0) {
                $this->giftRuleCustomerGroups->find($oldCustomerGroup['id'])->delete();
            } else {
                $found = 0;
            }
        }

        //unset the commons
        if (count($newCustomerGroups) && count($oldCustomerGroups)) {
            foreach ($oldCustomerGroups as $oldCustomerGroup) {
                $found = 0;

                foreach ($newCustomerGroups as $key => $newCustomerGroup) {
                    if ($oldCustomerGroup['customer_group_id'] == $newCustomerGroup)
                        unset($newCustomerGroups[$key]);
                }
            }
        }

        //create the left ones
        foreach ($newCustomerGroups as $newCustomerGroup) {
            $data['customer_group_id'] = $newCustomerGroup;
            $data['gift_rule_id'] = $giftRule->id;

            $this->giftRuleCustomerGroups->create($data);
        }

        return true;
    }

    /**
     * To sync the channels related records
     *
     * @param Array $newChannels
     * @param GiftRule $giftRule
     *
     * @return Boolean
     */
    public function ChannelSync($newChannels, $giftRule)
    {

        $oldChannels = array();
        foreach ($giftRule->channels as $oldChannel) {
            array_push($oldChannels, ['id' => $oldChannel->id, 'channel_id' => $oldChannel->channel_id]);
        }

        foreach ($oldChannels as $key => $oldChannel) {
            $found = 0;
            foreach($newChannels as $newChannel) {
                if ($oldChannel['channel_id'] == $newChannel)
                    $found = 1;
            }

            if ($found == 0) {
                $this->giftRuleChannels->find($oldChannel['id'])->delete();
            } else {
                $found = 0;
            }
        }

        //unset the commons
        if (count($newChannels) && count($oldChannels)) {
            foreach ($oldChannels as $oldChannel) {
                $found = 0;

                foreach ($newChannels as $key => $newChannel) {
                    if ($oldChannel['channel_id'] == $newChannel)
                        unset($newChannels[$key]);
                }
            }
        }

        //create the left ones
        foreach ($newChannels as $newChannel) {
            $data['channel_id'] = $newChannel;
            $data['gift_rule_id'] = $giftRule->id;
            $this->giftRuleChannels->create($data);
        }

        return true;
    }

   /**
     * To sync the products related records
     *
     * @param Array $newProducts
     * @param GiftRule $giftRule
     *
     * @return Boolean
     */
    public function ProductSync($newProducts, $giftRule)
    {
        $oldProducts = array();
        foreach ($giftRule->related_products as $oldProduct) {
            array_push($oldProducts, ['id' => $oldProduct->id, 'product_id' => $oldProduct->product_id]);
        }

        foreach ($oldProducts as $key => $oldProduct) {
            $found = 0;
            foreach($newProducts as $newProduct) {
                if ($oldProduct['product_id'] == $newProduct)
                    $found = 1;
            }

            if ($found == 0) {
                $this->giftRuleChannels->find($oldProduct['id'])->delete();
            } else {
                $found = 0;
            }
        }

        //unset the commons
        if (count($newProducts) && count($oldProducts)) {
            foreach ($oldProducts as $oldProduct) {
                $found = 0;

                foreach ($newProducts as $key => $newProduct) {
                    if ($oldProduct['product_id'] == $newProduct)
                        unset($newProducts[$key]);
                }
            }
        }

        //create the left ones
        foreach ($newProducts as $newProduct) {
            $data['product_id'] = $newProduct;
            $data['gift_rule_id'] = $giftRule->id;
            $this->giftRuleProducts->create($data);
        }

        return true;
    }

    public function getGiftsProduct() {
        return $this->model::orderBy('action_amount', 'ASC')->where('status', 1)->with(['channels' => function ($query) {
                $query->where('channel_id', core()->getCurrentChannelCode());
            }])->get();
    }

}