<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 12:27
 */

namespace App\Http\Controllers;


use App\Accessory;

class AccessoriesController extends Controller
{

    /**
     * @param Accessory $accessory
     * @return \Illuminate\Http\Response
     */
    public function show(Accessory $accessory)
    {
        $accessory->load('phones');

        return view('site.accessory', compact('accessory'));
    }

}
