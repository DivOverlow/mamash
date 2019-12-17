<?php

namespace Webkul\Discount\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Discount\Contracts\GiftRuleProducts as GiftRuleProductsContract;

class GiftRuleProducts extends Model implements GiftRuleProductsContract
{
    protected $table = 'gift_rule_products';

    protected $fillable = ['gift_rule_id', 'product_id'];
}