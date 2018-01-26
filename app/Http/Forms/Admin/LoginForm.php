<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 12:30
 */

namespace App\Http\Forms\Admin;


use Kris\LaravelFormBuilder\Form;

class LoginForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('email', 'text', [
                'label' => 'Email',
                'rules' => 'required|email',
            ])
            ->add('password', 'password', [
                'label' => 'Password',
                'rules' => 'required|min:6'
            ])
            ->add('login', 'submit', [
                'label' => 'Submit'
            ]);
    }
}