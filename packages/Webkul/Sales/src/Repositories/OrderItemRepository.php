<?php

namespace Webkul\Sales\Repositories;

use Illuminate\Container\Container as App;
use Webkul\Core\Eloquent\Repository;
use Webkul\Sales\Contracts\OrderItem;

/**
 * OrderItem Reposotory
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */

class OrderItemRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return Mixed
     */
    function model()
    {
        return OrderItem::class;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        if (isset($data['product']) && $data['product']) {
            $data['product_id'] = $data['product']->id;
            $data['product_type'] = get_class($data['product']);

            unset($data['product']);
        }

        return parent::create($data);
    }

    /**
     * @param mixed $orderItem
     * @return mixed
     */
    public function collectTotals($orderItem)
    {
        $qtyShipped = $qtyInvoiced = $qtyRefunded = 0;

        $totalInvoiced = $baseTotalInvoiced = 0;
        $taxInvoiced = $baseTaxInvoiced = 0;

        $totalRefunded = $baseTotalRefunded = 0;
        $taxRefunded = $baseTaxRefunded = 0;

        foreach ($orderItem->invoice_items as $invoiceItem) {
            $qtyInvoiced += $invoiceItem->qty;

            $totalInvoiced += $invoiceItem->total;
            $baseTotalInvoiced += $invoiceItem->base_total;

            $taxInvoiced += $invoiceItem->tax_amount;
            $baseTaxInvoiced += $invoiceItem->base_tax_amount;
        }

        foreach ($orderItem->shipment_items as $shipmentItem) {
            $qtyShipped += $shipmentItem->qty;
        }

        foreach ($orderItem->refund_items as $refundItem) {
            $qtyRefunded += $refundItem->qty;

            $totalRefunded += $refundItem->total;
            $baseTotalRefunded += $refundItem->base_total;

            $taxRefunded += $refundItem->tax_amount;
            $baseTaxRefunded += $refundItem->base_tax_amount;
        }

        $orderItem->qty_shipped = $qtyShipped;
        $orderItem->qty_invoiced = $qtyInvoiced;
        $orderItem->qty_refunded = $qtyRefunded;

        $orderItem->total_invoiced = $totalInvoiced;
        $orderItem->base_total_invoiced = $baseTotalInvoiced;

        $orderItem->tax_amount_invoiced = $taxInvoiced;
        $orderItem->base_tax_amount_invoiced = $baseTaxInvoiced;

        $orderItem->amount_refunded = $totalRefunded;
        $orderItem->base_amount_refunded = $baseTotalRefunded;

        $orderItem->tax_amount_refunded = $taxRefunded;
        $orderItem->base_tax_amount_refunded = $baseTaxRefunded;

        $orderItem->save();

        return $orderItem;
    }

    /**
     * @param mixed $orderItem
     * @return void
     */
    public function manageInventory($orderItem)
    {
        $orderItems = [];

        if ($orderItem->getTypeInstance()->isComposite()) {
            foreach ($orderItem->children as $child) {
                $orderItems[] = $child;
            }
        } else {
            $orderItems[] = $orderItem;
        }

        foreach ($orderItems as $item) {
            if (! $item->product)
                continue;

            $orderedInventory = $item->product->ordered_inventories()
                    ->where('channel_id', $orderItem->order->channel->id)
                    ->first();

            $qty = $item->qty_ordered ?: $item->parent->qty_ordered;

            if ($orderedInventory) {
                $orderedInventory->update([
                        'qty' => $orderedInventory->qty + $qty
                    ]);
            } else {
                $item->product->ordered_inventories()->create([
                        'qty' => $qty,
                        'product_id' => $item->product_id,
                        'channel_id' => $orderItem->order->channel->id,
                    ]);
            }
        }
    }

    /**
     * Returns qty to product inventory after order cancelation
     *
     * @param OrderItem $orderItem
     * @return void
     */
    public function returnQtyToProductInventory($orderItem)
    {
        $orderedInventory = $orderItem->product->ordered_inventories()
                ->where('channel_id', $orderItem->order->channel->id)
                ->first();

        if (! $orderedInventory)
            return;

        if (($qty = $orderedInventory->qty - ($orderItem->qty_ordered ? $orderItem->qty_to_cancel : $orderItem->parent->qty_ordered)) < 0)
            $qty = 0;

        $orderedInventory->update(['qty' => $qty]);
    }

    /**
     * Calculates order items tax
     *
     * @return void
     */
    public function calculateItemsTax($orderItem)
    {
        if (! $orderItem)
            return false;

            $taxCategory = app('Webkul\Tax\Repositories\TaxCategoryRepository')->find($orderItem->product->tax_category_id);

            if (! $taxCategory)
            return $orderItem;

            $order = $orderItem->order;

            if ($orderItem->product->getTypeInstance()->isStockable()) {
                $address = $order->shipping_address;
            } else {
                $address = $order->billing_address;
            }

            $taxRates = $taxCategory->tax_rates()->where([
                'state' => $address->state,
                'country' => $address->country,
            ])->orderBy('tax_rate', 'desc')->get();

            if (count( $taxRates) > 0) {
                foreach ($taxRates as $rate) {
                    $haveTaxRate = false;

                    if (! $rate->is_zip) {
                        if ($rate->zip_code == '*' || $rate->zip_code == $address->postcode) {
                            $haveTaxRate = true;
                        }
                    } else {
                        if ($address->postcode >= $rate->zip_from && $address->postcode <= $rate->zip_to) {
                            $haveTaxRate = true;
                        }
                    }

                    if ($haveTaxRate) {
                        $orderItem->tax_percent = $rate->tax_rate;
                        $orderItem->tax_amount = ($orderItem->total * $rate->tax_rate) / 100;
                        $orderItem->base_tax_amount = ($orderItem->base_total * $rate->tax_rate) / 100;

                        $orderItem->save();
                        break;
                    }
                }
            } else {
                $orderItem->tax_percent = 0;
                $orderItem->tax_amount = 0;
                $orderItem->base_tax_amount = 0;

                $orderItem->save();
            }
        return $orderItem;
    }

    /**
     * Calculates order items discount
     *
     * @return void
     */

    public function calculateItemsOrder($orderItem)
    {

    }


}