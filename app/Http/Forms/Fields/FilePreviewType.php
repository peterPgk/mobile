<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 24.1.2018 г.
 * Time: 15:57
 */

namespace App\Http\Forms\Fields;

use Exception;
use Illuminate\Support\Str;
use Kris\LaravelFormBuilder\Fields\FormField;
use Kris\LaravelFormBuilder\Form;

class FilePreviewType extends FormField {

    /**
     * FilePreviewType constructor.
     * @param $name
     * @param $type
     * @param Form $parent
     * @param array $options
     */
    public function __construct($name, $type, Form $parent, array $options = [])
    {
        parent::__construct($name, $type, $parent, $options);

        $this->getParent()->setFormOption('files', true);
    }

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'forms.filepreview';
    }

    /**
     * @return array
     */
    protected function getDefaults() {
        return [
            'file_wrapper_attr' => ['class' => 'col-md-4 col-sm-6 padding-v-0-15'],
            'file_attr' => ['class' => 'img-responsive', 'style' => 'overflow:hidden'],
//            'file_type' => 7,
            'field_wrapper_attr' => []
        ];
    }

    /**
     * @param array $options
     * @param bool $showLabel
     * @param bool $showField
     * @param bool $showError
     * @return string
     * @throws Exception
     */
    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $model = $this->getParent()->getModel();
        $prop = Str::camel($this->getName());

        if (is_object($model)) {
            if (method_exists($model, $prop)) {
                $options['prop'] = $model->{$prop}($this->options['file_type']);
            } else {
                throw new Exception('Undefined field name');
            }
        }

        return parent::render($options, $showLabel, $showField, $showError);
    }
}