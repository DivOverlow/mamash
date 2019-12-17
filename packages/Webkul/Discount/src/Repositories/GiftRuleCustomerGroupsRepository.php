<?php

namespace Webkul\Discount\Repositories;

use Webkul\Core\Eloquent\Repository;

/**
 * GiftRuleCustomerGroupsReposotory
 *
 * @author  Prashant Singh <prashant.singh852@webkul.com>
 * @copyright 2019 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class GiftRuleCustomerGroupsRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Discount\Contracts\GiftRuleCustomerGroups';
    }
}
