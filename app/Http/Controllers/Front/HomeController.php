<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $data               = ['title' => Config::get('constants.PROJECT_NAME')];
        return view('front.home')->with($data);
    }
}
