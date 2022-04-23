<?php

namespace App\Http\Controllers\Admin;

use App\Crawler\Enum\CrawlStatus;
use App\Crawler\Enum\DataStatus;
use App\Models\CrawlUrl;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
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

    public function showDetailsRow($id)
    {
        $data = $this->crud->getEntry($id);
        dump($data);
        return view('crud::details_row', compact('data'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text'
            ],
            [
                'label' => 'Site',
                'name' => 'url_id',
                'type' => 'url_id'
            ],
            [
                'name' => 'url',
                'type' => 'url_reducer',
            ],
            [
                'name' => 'status',
                'type' => 'select_from_array',
                'options' => array_flip(CrawlStatus::asArray()),
            ],
            [
                'name' => 'data_status',
                'type' => 'select_from_array',
                'options' => array_flip(DataStatus::asArray()),
            ],
            [
                'name' => 'created_at',
                'type' => 'datetime',
            ],
        ]);

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'status',
            'label' => 'Filter Status'
        ], array_flip(CrawlStatus::asArray()), function ($value) {
            $this->crud->addClause('where', 'status', $value);
        });

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'data_status',
            'label' => 'Filter Data Status'
        ], array_flip(DataStatus::asArray()), function ($value) {
            $this->crud->addClause('where', 'data_status', $value);
        });
    }
}
