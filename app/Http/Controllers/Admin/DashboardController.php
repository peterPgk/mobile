<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 13:21
 */

namespace App\Http\Controllers\Admin;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Admin
 */
class DashboardController
{
    public function index()
    {
        return view('admin.dashboard');
    }

}