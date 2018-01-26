<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 23.1.2018 г.
 * Time: 13:41
 */

namespace App\Http\Forms;

use App\Phone;
use Kris\LaravelFormBuilder\Form;

class AccessoryForm extends Form
{
    protected $clientValidationEnabled = false;

    public function buildForm()
    {

        $this
            ->add('name', 'text', [
                'label' => 'Accessory name',
                'rules' => 'required|max:160',
            ])
            ->add('image', 'imagepreview', [
                'file_type' => 'image'
            ])
            ->add('description', 'textarea', [
                'attr' => ['class' => 'form-control count-char'],
                'label' => 'Description',
                'rules' => 'max:500'
            ])
            ->add('phones', 'vue-multiselect', [
                'label' => 'Phones:',
                'class' => Phone::class,
                'query_builder' => function (Phone $accessory)
                {
                    if (!empty($this->model))
                    {
                        return $accessory->whereKeyNot($this->model->id)->get();
                    }
                    return $accessory->all();
                },
                'property' => 'name',
                'selected' => function ($accessories)
                {
                    return $accessories ? Phone::whereIn('id', $accessories->pluck('id'))->get() : collect([]);
                },
                'property_submit' => 'id',
                'multiple' => true
            ])
            ->add('available', 'optional_checkbox', [
                    'label' => 'Available',
                ]
            )
            ->add('submit', 'submit', [
                'label' => '<i class="fa fa-fw fa-save"></i> Save',
                'attr' => ['class' => 'btn btn-success'],
            ]);

    }
}