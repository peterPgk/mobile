<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 12:27
 */

namespace App\Http\Controllers\Admin;


use App\Http\ListViews\PhonesListView;
use App\Phone;

class PhonesController extends AdminController
{

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = 'Phones : ';

        $list = new PhonesListView(Phone::orderBy('created_at', 'desc')->get());

        return view('admin.list', compact('list', 'title'));
    }

}
