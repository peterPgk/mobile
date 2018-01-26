<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 23.1.2018 г.
 * Time: 13:21
 */

namespace App\Http\Controllers\Admin;

use App\Contracts\FileSource;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Str;
use Kris\LaravelFormBuilder\FormBuilderTrait;
use Log;
use Illuminate\Http\Request;

/**
 * Class AdminController
 * @package App\Http\Controllers\Admin
 */
abstract class AdminController extends Controller
{

    use FormBuilderTrait;

    protected $model = null;
    protected $modelName = null;


    /**
     * Show form for model
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ReflectionException
     */
    public function create()
    {

        $title = 'Add '. $this->getName();
        $form = $this->form($this->getFormClass(), [
            'method' => 'POST',
            'url' => route($this->getRouteFor('store')),
        ]);
        return view('.admin.form', compact('form', 'title'));
    }


    /**
     * Store model into db
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \ReflectionException
     */
    public function store()
    {
        $form = $this->form($this->getFormClass());
        $form->redirectIfNotValid();
        $data = $form->getFieldValues();

        try {
            // First we create the element
            $model = ($this->getModel())::create($data);

            $this->syncRelations($model, $data);

            if( $model instanceof FileSource ) {
                $this->dealWithFiles($model, request());
            }

            flash()->success('The item was added successfully');
        } catch (\Exception $e) {
//            dd($e);
            Log::error($e->getMessage() .'('. $e->getFile() .'::'. $e->getLine() .')');
            flash()->error('Error when trying to add this item into database');
        }
        return redirect()->back();
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \ReflectionException
     */
    public function edit($id)
    {
        $title = 'Edit '. $this->getName();

        $model = ($this->getModel())::findOrFail($id);

        $form = $this->form($this->getFormClass(), [
            'method' => 'PUT',
            'url' => route($this->getRouteFor('update'), $id),
            'model' => $model,
        ]);

        return view('admin.form', compact('form', 'model', 'title'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function update($id)
    {

        $model = ($this->getModel())::findOrFail($id);
        $form = $this->form($this->getFormClass(), ['model' => $model]);
        $form->redirectIfNotValid();

        $data = $form->getFieldValues();

        try {
            $model->update($data);

            $this->syncRelations($model, $data);

            if( $model instanceof FileSource ) {
                $this->dealWithFiles($model, request());
            }


            flash()->success('The item was edited successfully');
        } catch (\Exception $e) {
            dd($e);
            flash()->error(config('Error edited the item'));
        }

//        return redirect()->back();
        return redirect()->route($this->getRouteFor('index'));
    }


    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getName()
    {
        if (is_null($this->modelName)) {
            $this->modelName = $this->getModelName();
        }
        return $this->modelName;
    }

    /**
     * Try to guess model name (without namespace)
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function getModelName()
    {
        $class = new \ReflectionClass(get_called_class());
        return Str::singular(
            str_replace('Controller', '', $class->getShortName())
        );
    }

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getModel()
    {
        if (is_null($this->model)) {
            $this->model = $this->getModelClass();
        }
        return $this->model;
    }

    /**
     * Try to guess model name (full)
     * @return string
     * @throws \ReflectionException
     */
    protected function getModelClass()
    {
        $class = new \ReflectionClass(get_called_class());

        $namespace = app()->getNamespace();

        $name = Str::singular(
            str_replace('Controller', '', $class->getShortName())
        );
        return sprintf('%s%s', $namespace, $name);
    }

    /**
     * Dynamically generate route for admin
     *
     * @param string $route
     * @return string
     * @throws \ReflectionException
     */
    protected function getRouteFor(string $route)
    {
        $name = Str::singular(mb_strtolower($this->getName()));
        return sprintf('%s.%s', $name, $route);
    }

    /**
     * Try to guess the corresponding form class
     * for the given controller.
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function getFormClass()
    {
        $class = new \ReflectionClass( get_called_class() );

        $namespace = app()->getNamespace();

        $name = Str::singular(
            str_replace('Controller', '', $class->getShortName())
        );

        return sprintf('\%sHttp\Forms\%sForm', $namespace,$name);
    }

    /**
     * Filter response to get only model relationships
     *
     * @param Model $model
     * @param $data
     * @return static
     */
    protected function getRelations(Model $model, $data) {

        return collect($data)->filter(function ($value, $key) use ($model) {
            return method_exists($model, $key);
        });
    }

    /**
     * Sync model relationships
     *
     * @param Model $model
     * @param $data
     */
    protected function syncRelations(Model $model, $data) {

        $relations = $this->getRelations($model, $data);

        //Check for relations and if we find some, then sync
        if( $relations->isNotEmpty() ) {
            $relations->each(function ($value, $relation) use ($model){
                if(is_string($value)) {
                    $value = json_decode($value, true);

                    $model->$relation()->sync($value);
                }
            });
        }
    }

    /**
     *
     *
     * @param FileSource $model
     * @param Request $request
     */
    protected function dealWithFiles(FileSource $model, Request $request) {

        if( $request->files->count()) {
            $model->saveFiles($request);
        }

        if ($request->has('files_remove')) {
            foreach ($request->files_remove as $file_id => $is_marked) {
                if($is_marked == 1){
                    $model->deleteFile($file_id);
                }
            }
        }
    }


    public function refreshVueData()
    {
        $class = new \ReflectionClass(get_called_class());

        $t = $class->getShortName();
    }
}