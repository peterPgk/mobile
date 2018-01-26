<?php
/**
 * Created by PhpStorm.
 * User: pgk
 * Date: 25.1.2018 г.
 * Time: 09:20
 */

namespace App\Http\Controllers;

use App\Accessory;
use App\Phone;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Get search results
     */
    public function search()
    {
        $query = $this->validate(
            request(),
            ['query' => 'required|min:3']
        )['query'];

        $phones = Phone::search($query)->get();
        $accessories = Accessory::search($query)->get();

        return view('search', compact('phones', 'accessories'));

    }
}
