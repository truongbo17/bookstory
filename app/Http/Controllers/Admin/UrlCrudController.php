<?php

namespace App\Http\Controllers\Admin;

use App\Crawler\Enum\UrlStatus;
use App\Http\Requests\UrlRequest;
use App\Models\Url;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use File;
use Response;
use Storage;

/**
 * Class UrlCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UrlCrudController extends CrudController
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
        CRUD::setModel(Url::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/url');
        CRUD::setEntityNameStrings('url', 'urls');
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
            ],
            [
                'name' => 'site',
                'type' => 'url_reducer'
            ],
            [
                'name' => 'driver_browser',
                'default' => 'default (guzzle)'
            ],
            [
                'name' => 'status',
                'type' => 'select_from_array',
                'options' => array_flip(UrlStatus::asArray()),
            ],
        ]);

        CRUD::button('delete')->remove();

        $this->crud->addButtonFromView('top', 'import', 'import_url', 'beginning');
        $this->crud->addButtonFromView('line', 'moderate', 'change_status_url', 'beginning');
        $this->crud->addButtonFromView('line', 'small', 'export_url', 'beginning');
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

    public function setupShowOperation()
    {
        $this->crud->addColumns([
            [
                'name' => 'id'
            ],
            [
                'name' => 'site',
                'type' => 'url_reducer'
            ],
            [
                'name' => 'url_start',
                'type' => 'url_reducer'
            ],
            [
                'name' => 'driver_browser',
                'default' => 'default (guzzle)'
            ],
            [
                'name' => 'config_root_url',
                'type' => 'boolean'
            ],
            [
                'name' => 'should_crawl',
                'type' => 'textarea'
            ],
            [
                'name' => 'should_get_data',
                'type' => 'textarea'
            ],
            [
                'name' => 'should_get_info',
                'type' => 'json'
            ],
            [
                'name' => 'skip_url',
                'type' => 'textarea'
            ],
            [
                'name' => 'status',
                'type' => 'select_from_array',
                'options' => array_flip(UrlStatus::asArray()),
            ],
            ['name' => 'created_at'],
            ['name' => 'updated_at']
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UrlRequest::class);

        CRUD::field('site');
        CRUD::field('url_start');
        CRUD::field('should_crawl');
        CRUD::field('should_get_data');
        CRUD::field('should_get_info');
        CRUD::field('config_root_url');
        CRUD::field('skip_url');
        CRUD::field('driver_browser');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    public function updateStatus($id)
    {
        $url = Url::findOrFail($id);
        if ($url->status == UrlStatus::RUNNING) {
            $status = UrlStatus::INIT;
        } else {
            $status = UrlStatus::RUNNING;
        }

        $url->update([
            'status' => $status,
        ]);

        return true;
    }

    public function exportUrl($id)
    {
        $url = Url::findOrFail($id)->toArray();
        $json_name = $url['id'] . '-' . Carbon::now()->format('H-i-s-d-M-Y') . '.json';

        unset($url['id']);
        unset($url['created_at']);
        unset($url['updated_at']);
        $data = json_encode($url);

        $file_name = 'export-' . uniqid() . '-' . $id . '.json';
        $file = Storage::disk(config('crawl.document_disk'))->put(config('crawl.path.import_json_urls') . '/' . $file_name, $data);

        if ($file) {
            $file = public_path() . config('crawl.public_link_storage') . config('crawl.path.import_json_urls') . '/' . $file_name;
            $headers = ['Content-Type: application/json'];
            return Response::download($file, $file_name, $headers);
        }
    }

    public function importUrl(UrlRequest $request)
    {
        $json_url = $request->file('json_url')->getContent();
        if (substr($json_url, -1) != '}') $json_url = $json_url . '}';
        $url = json_decode($json_url, true);
        Url::create($url);

        return redirect()->back();
    }
}
