<?php

namespace Webkul\Discount\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Discount\Contracts\GiftRule as GiftRuleContract;
use Webkul\Discount\Models\GiftRuleProductsProxy as GiftRuleProducts;
use Webkul\Discount\Models\GiftRuleChannelsProxy as GiftRuleChannels;
use Webkul\Discount\Models\GiftRuleCustomerGroupsProxy as GiftRuleCustomerGroups;

class GiftRule extends Model implements GiftRuleContract
{
    protected $table = 'gift_rules';

    protected $guarded = ['created_at', 'updated_at'];

    protected $with = ['channels', 'customer_groups', 'related_products'];

    public function channels()
    {
        return $this->hasMany(GiftRuleChannels::modelClass());
    }

    public function customer_groups()
    {
        return $this->hasMany(GiftRuleCustomerGroups::modelClass());
    }

    /**
     * The related products that belong to the product.
     */
    public function related_products()
    {
        return $this->hasMany(GiftRuleProducts::modelClass());
//        return $this->belongsToMany(static::class, 'gift_rule_products', 'gift_rule_id', 'product_id')->limit(4);
    }


}