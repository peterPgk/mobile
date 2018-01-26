<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 24.1.2018 г.
 * Time: 11:20
 */

namespace App\Http\Forms\Fields\VueComponents;

use Kris\LaravelFormBuilder\Fields\EntityType;

/**
 * Class MultiSelectType
 * @package App\Http\Forms\Fields\VueComponents
 */
class MultiSelectType extends EntityType {

    /**
     * @inheritdoc
     */
    protected function getTemplate()
    {
        return 'forms.components.multiselect';
    }

    /**
     * Reformat options to pass to Vue expectations
     *
     * @inheritdoc
     */
    protected function createChildren() {

        $result = parent::createChildren();

//        $this->options['choices'] = collect($this->options['choices'])->map(function ($item, $key) {
//            return['id' => $key, $this->options['property'] => $item];
//        });

        $choices = [];
        foreach ($this->options['choices'] as $key => $value){
            $choices[] = ['id' => $key, $this->options['property'] => $value];
        }
        $this->options['choices'] = collect($choices);

        return $result;
    }

}