<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Portfolio;
use App\Models\Services ;
use Illuminate\Http\Request;
use Config;

class HomeController extends Controller
{
    function index(Request $request)
    {
        $data               = ['title' => Config::get('constants.PROJECT_NAME')];
        $contact_details    = Contacts::get_result(1);
        $data['phone1']     = $contact_details->phone1;
        $data['phone2']     = $contact_details->phone2;
        $data['email']      = $contact_details->email;

        $data['portfolio_data']  = Portfolio::get_portfolio_result_f();
        $data['service_data']    = Services::get_service_result_f();
        return view('front.home')->with($data);
    }
}
