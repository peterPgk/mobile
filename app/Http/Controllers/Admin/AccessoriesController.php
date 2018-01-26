<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 12:27
 */

namespace App\Http\Controllers\Admin;

use App;
use App\Accessory;
use App\Http\ListViews\AccessoriesListView;

/**
 * Class AccessoriesController
 * @package App\Http\Controllers\Admin
 */
class AccessoriesController extends AdminController
{

    /**
     * Show all accessories
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Accessories';

        $list = new AccessoriesListView(
            Accessory::orderBy('created_at', 'desc')->get()
        );

        return view('admin.list', compact('list', 'title'));
    }

}
