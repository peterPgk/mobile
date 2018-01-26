<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Forms\Admin\LoginForm;
use Illuminate\Contracts\Auth\Guard;
use Kris\LaravelFormBuilder\FormBuilderTrait;

/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 12:23
 */

class AdminAuthController extends Controller
{

    use FormBuilderTrait;

    /**
     * @var Guard
     */
    private $auth;

    public function __construct(Guard $auth)
    {
        $this->middleware('auth', ['only' => 'getLogout']);
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->auth = $auth;
    }

    public function getLogin()
    {

        $form = $this->form(LoginForm::class, [
            'method' => 'POST',
            'url' => route('admin.auth.login')
        ]);

        return view('auth.admin-login', compact('form'));
    }

    public function postLogin()
    {
        $form = $this->form(LoginForm::class);
        $fieldValues = $form->getFieldValues();
        $attempt = $this->auth->attempt(
            [
                'email' => $fieldValues['email'],
                'password' => $fieldValues['password'],
                'is_active' => true
            ],
            $form->has('remember')
        );

        if( !$attempt )
        {
            flash()->error(trans('flowcontrol::auth.wrong_user_or_pass'));
            return back();
        }

        return redirect()->intended(route('admin.dashboard.index'));
    }

    public function getLogout()
    {
        $this->auth->logout();
        return redirect('/');
    }
}