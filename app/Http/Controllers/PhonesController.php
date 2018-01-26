<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 22.1.2018 г.
 * Time: 12:27
 */

namespace App\Http\Controllers;


use App\Phone;

/**
 * Class PhonesController
 * @package App\Http\Controllers
 */
class PhonesController extends Controller
{

    /**
     * @param Phone $phone
     * @return \Illuminate\Http\Response
     */
    public function show(Phone $phone)
    {
        $phone->load('accessories');

        return view('site.phone', compact('phone'));
    }

}
