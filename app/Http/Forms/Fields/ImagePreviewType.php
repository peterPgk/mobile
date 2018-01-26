<?php

/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 24.1.2018 г.
 * Time: 15:57
 */

namespace App\Http\Forms\Fields;

class ImagePreviewType extends FilePreviewType {

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return 'forms.imagepreview';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'image_by_type';
    }

    /**
     * @return array
     */
    protected function getDefaults() {
        return [
            'file_wrapper_attr' => ['class' => 'col-md-4 col-sm-6 padding-v-0-15'],
            'file_attr' => ['class' => 'img-responsive', 'style' => 'overflow:hidden'],
            'field_wrapper_attr' => []
        ];
    }

    /**
     * @param array $options
     * @param bool $showLabel
     * @param bool $showField
     * @param bool $showError
     * @return string
     * @throws \Exception
     */
    public function render(array $options = [], $showLabel = true, $showField = true, $showError = true)
    {
        $model = $this->getParent()->getModel();

        if ( is_callable([$model, 'hasImageType']) ) {
            $options['hasImage'] = $model->hasImageType($this->options['file_type']);
        }

        return parent::render($options, $showLabel, $showField, $showError);
    }
}