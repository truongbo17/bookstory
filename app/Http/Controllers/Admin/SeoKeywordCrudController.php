<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SeoKeywordRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SeoKeywordCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SeoKeywordCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\SeoKeyword::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/seo-keyword');
        CRUD::setEntityNameStrings('seo keyword', 'seo keywords');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('created_at');
        CRUD::column('documents_count');
        CRUD::column('documents_matched');
        CRUD::column('hits');
        CRUD::column('id');
        CRUD::column('length');
        CRUD::column('max_score');
        CRUD::column('mix_score');
        CRUD::column('related');
        CRUD::column('status');
        CRUD::column('title');
        CRUD::column('title_hash');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SeoKeywordRequest::class);

        CRUD::field('created_at');
        CRUD::field('documents_count');
        CRUD::field('documents_matched');
        CRUD::field('hits');
        CRUD::field('id');
        CRUD::field('length');
        CRUD::field('max_score');
        CRUD::field('mix_score');
        CRUD::field('related');
        CRUD::field('status');
        CRUD::field('title');
        CRUD::field('title_hash');
        CRUD::field('updated_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
