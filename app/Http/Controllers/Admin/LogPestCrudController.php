<?php

namespace App\Http\Controllers\Admin;

use App\Crawler\Enum\PestStatus;
use App\Http\Requests\LogPestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LogPestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LogPestCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\LogPest::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/log-pest');
        CRUD::setEntityNameStrings('log pest', 'log pests');
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
                'label' => 'IP',
                'name' => 'ip',
                'type' => 'text'
            ],
            [
                'name' => 'url',
                'type' => 'url_reducer',
            ],
            [
                'label' => 'Type',
                'name' => 'type',
                'type' => 'text'
            ],
            [
                'name' => 'status',
                'type' => 'select_from_array',
                'options' => array_flip(PestStatus::asArray()),
            ],
            [
                'label' => 'Download at',
                'name' => 'created_at',
                'type' => 'datetime',
            ],
        ]);

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'status',
            'label' => 'Filter Status'
        ], array_flip(PestStatus::asArray()), function ($value) {
            $this->crud->addClause('where', 'status', $value);
        });

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }
}
