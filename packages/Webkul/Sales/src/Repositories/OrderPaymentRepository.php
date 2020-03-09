<?php

namespace Webkul\Sales\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Webkul\Sales\Contracts\OrderPayment;

/**
 * Order Address Reposotory
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */

class OrderPaymentRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return Mixed
     */

    function model()
    {
        return OrderPayment::class;
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        $payment = $this->findWhere(['order_id' => $id])->first();

        if ($payment) {
               $payment->update($data);
            return $payment;
        }
    }
}