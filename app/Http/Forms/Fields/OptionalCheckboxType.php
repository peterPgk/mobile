<?php namespace App\Http\Forms\Fields;

use Kris\LaravelFormBuilder\Fields\CheckableType;

class OptionalCheckboxType extends CheckableType {

    protected function getTemplate()
    {
        return 'forms.nullable-checkbox';
    }
}