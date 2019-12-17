<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * Catalog Rule DataGrid class
 *
 * @author Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class GiftRuleDataGrid extends DataGrid
{
    protected $index = 'id'; //the column that needs to be treated as index column

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('gift_rules')
                ->select('id')
                ->addSelect('id', 'name', 'status', 'action_amount');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'id',
            'label' => trans('admin::app.datagrid.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('admin::app.datagrid.name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'status',
            'label' => trans('admin::app.datagrid.status'),
            'type' => 'boolean',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true,
            'wrapper' => function ($value) {
                if ($value->status == 1)
                    return 'True';
                else
                    return 'False';
            }
        ]);

        $this->addColumn([
            'index' => 'action_amount',
            'label' => 'Action Amount',
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);
    }

    public function prepareActions()
    {
        $this->addAction([
            'title' => 'Edit GiftRule',
            'method' => 'GET', //use post only for redirects only
            'route' => 'admin.gift-rule.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => 'Delete GiftRule',
            'method' => 'POST', //use post only for requests other than redirects
            'route' => 'admin.gift-rule.delete',
            'icon' => 'icon trash-icon'
        ]);
    }

    public function prepareMassActions()
    {
        // $this->addMassAction([
        //     'type' => 'delete',
        //     'action' => route('admin.catalog.attributes.massdelete'),
        //     'label' => 'Delete',
        //     'method' => 'DELETE'
        // ]);
    }
}
