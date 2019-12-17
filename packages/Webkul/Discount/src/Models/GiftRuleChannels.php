<?php

namespace Webkul\Discount\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Discount\Contracts\GiftRuleChannels as GiftRuleChannelsContract;
use Webkul\Discount\Models\GiftRuleProxy as GiftRule;

class GiftRuleChannels extends Model implements GiftRuleChannelsContract
{
    protected $table = 'gift_rule_channels';

    protected $guarded = ['created_at', 'updated_at'];

    public function channels()
    {
        return $this->belongsTo(GiftRule::modelClass(), 'gift_rule_id');
    }
}