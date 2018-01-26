<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 23.1.2018 г.
 * Time: 11:57
 */

namespace App\Http\Forms;

use App\Accessory;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class PhoneForm extends Form
{
    protected $clientValidationEnabled = false;

    public function buildForm()
    {

        $this
            ->add('name', 'text', [
                'label' => 'Phone name',
                'rules' => [
                    'required',
                    'max:160',
                    Rule::unique('phones')->ignore(!empty($this->model) ? $this->model->id : null)
                ],
            ])
            ->add('image', 'imagepreview', [
                'file_type' => 'image'
            ])
            ->add('description', 'textarea', [
                'attr' => ['class' => 'form-control count-char'],
                'label' => 'Description',
                'rules' => 'max:500'
            ])
            ->add('year', 'choice', [
                'choices' => range(Carbon::now()->year, 1980),
                'choice_options' => [
                    'wrapper' => ['class' => 'choice-wrapper'],
                    'label_attr' => ['class' => 'label-class'],
                ],
                'selected' => function ($data) {
                    return null;
                },
                'expanded' => false,
                'multiple' => false
            ])
            ->add('accessories', 'vue-multiselect', [
                'label' => 'Accessories:',
                'class' => Accessory::class,
                'query_builder' => function (Accessory $accessory)
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
                    return $accessories ? Accessory::whereIn('id', $accessories->pluck('id'))->get() : collect([]);
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