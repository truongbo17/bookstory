<?php

namespace App\Http\Controllers\Admin;

use App\Crawler\Enum\CrawlStatus;
use App\Crawler\Enum\Status;
use App\Crawler\Enum\UrlStatus;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\Url;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class DocumentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DocumentCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(Document::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/document');
        CRUD::setEntityNameStrings('document', 'documents');
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
                'name' => 'download',
                'type' => 'number'
            ],
            [
                'name' => 'view',
                'type' => 'number'
            ],
            [
                'name' => 'status',
                'type' => 'select_from_array',
                'options' => array_flip(Status::asArray()),
            ],
            [
                'name' => 'created_at',
                'type' => 'datetime'
            ]
        ]);

        $this->crud->addButtonFromView('top', 'approve_documents', 'approve_documents', 'beginning');

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'status',
            'label' => 'Document Status'
        ], array_flip(Status::asArray()), function ($value) {
            $this->crud->addClause('where', 'status', $value);
        });
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(DocumentRequest::class);

        CRUD::field('binding');
        CRUD::field('code');
        CRUD::field('content_file');
        CRUD::field('content_hash');
        CRUD::field('created_at');
        CRUD::field('download');
        CRUD::field('download_link');
        CRUD::field('id');
        CRUD::field('page');
        CRUD::field('slug');
        CRUD::field('status');
        CRUD::field('title');
        CRUD::field('image');
        CRUD::field('updated_at');
        CRUD::field('view');

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

    public function approveDocuments()
    {
        if (Document::where('is_crawl', CrawlStatus::IS_CRAWL)
            ->where('content_file', '<>', '')
            ->whereNotNull('content_file')
            ->where('download_link', '<>', '')
            ->whereNotNull('download_link')
            ->where('image', '<>', '')
            ->whereNotNull('image')
            ->where('status', Status::PENDING)
            ->update(['status' => Status::ACTIVE])) return true;
        return false;
    }
}
