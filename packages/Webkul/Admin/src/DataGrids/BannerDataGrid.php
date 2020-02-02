<?php

namespace Webkul\Admin\DataGrids;

use Webkul\Ui\DataGrid\DataGrid;
use DB;

/**
 * BannerDataGrid Class
 *
 * @author Prashant Singh <prashant.singh852@webkul.com> @prashant-webkul
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BannerDataGrid extends DataGrid
{
    protected $index = 'banner_id';

    protected $sortOrder = 'desc'; //asc or desc

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('banners as bn')->addSelect('bn.id as banner_id', 'bn.banner_key', 'bt.title', 'ch.name')->leftJoin('channels as ch', 'bn.channel_id', '=',
        'ch.id')->leftJoin('banner_translations as bt', function($leftJoin) {
            $leftJoin->on('bn.id', '=', 'bt.banner_id')
                ->where('bt.locale', app()->getLocale());
        })->groupBy('bn.id');;

        $this->addFilter('banner_id', 'bn.id');
        $this->addFilter('banner_key', 'bn.banner_key');
        $this->addFilter('channel_name', 'ch.name');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index' => 'banner_id',
            'label' => trans('admin::app.datagrid.id'),
            'type' => 'number',
            'searchable' => false,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'banner_key',
            'label' => trans('admin::app.datagrid.banner-key'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'title',
            'label' => trans('admin::app.datagrid.title'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);

        $this->addColumn([
            'index' => 'name',
            'label' => trans('admin::app.datagrid.channel-name'),
            'type' => 'string',
            'searchable' => true,
            'sortable' => true,
            'filterable' => true
        ]);
    }

    public function prepareActions() {
        $this->addAction([
            'title' => 'Edit Banner',
            'method' => 'GET', // use GET request only for redirect purposes
            'route' => 'admin.banners.edit',
            'icon' => 'icon pencil-lg-icon'
        ]);

        $this->addAction([
            'title' => 'Delete Banner',
            'method' => 'POST', // use GET request only for redirect purposes
            'route' => 'admin.banners.delete',
            'icon' => 'icon trash-icon'
        ]);
    }
}