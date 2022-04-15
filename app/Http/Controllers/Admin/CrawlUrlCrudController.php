<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CrawlUrlRequest;
use App\Models\CrawlUrl;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CrawlUrlCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CrawlUrlCrudController extends CrudController
{
    use ListOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(CrawlUrl::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/crawl-url');
        CRUD::setEntityNameStrings('crawl url', 'crawl urls');
        CRUD::enableDetailsRow();
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::addColumn(['label' => 'Site', 'name' => 'url_id']);
        CRUD::column('url');
        CRUD::column('status');
        CRUD::column('data_status');
        CRUD::column('created_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
}
