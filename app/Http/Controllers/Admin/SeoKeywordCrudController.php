<?php

namespace App\Http\Controllers\Admin;

use App\Crawler\Enum\SeoKeywordStatus;
use App\Http\Requests\SeoKeywordRequest;
use App\Models\SeoKeyword;
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
        $this->crud->addColumns([
            [
                'name' => 'id',
                'type' => 'text'
            ],
            [
                'name' => 'title',
                'type' => 'text'
            ],
            [
                'name' => 'length',
                'type' => 'number'
            ],
            [
                'name' => 'documents_matched',
                'type' => 'number'
            ],
            [
                'name' => 'status',
                'type' => 'select_from_array',
                'options' => array_flip(SeoKeywordStatus::asArray()),
            ],
        ]);

        $this->crud->addButtonFromView('top', 'approve_seo_keywords', 'approve_seo_keywords', 'beginning');

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'status',
            'label' => 'Seo Keywords Status'
        ], array_flip(SeoKeywordStatus::asArray()), function ($value) {
            $this->crud->addClause('where', 'status', $value);
        });

    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->crud->addField('status');
    }

    protected function approveSeoKeywords()
    {
        if (SeoKeyword::where('documents_matched', '>', 0)
            ->where('hits', '<>', '')
            ->whereNotNull('hits')
            ->update(['status' => SeoKeywordStatus::HAS_SEO_KEYWORD])) return true;
        return false;
    }
}
