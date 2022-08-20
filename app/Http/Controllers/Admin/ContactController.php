<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\General;
use App\Models\Contacts;

class ContactController extends Controller
{
    function index(Request $request)
    {
        $data               = ['title' => 'Contact Details', 'srch_div' => 'none'];
        $data['page']       = ($request->input('page')) ? $request->input('page') : 1;
        $data['count']      = General::get_count('contact_details');
        $data['add_div']    = "none";
        $search_array       = "";
        if (!empty($request->input('sr'))) {
            $data['phone1']   = $request->input('phone1');
            $search_array     = array("phone1" => $data['phone1']);
            $data['srch_div'] = "block";
        }
        if (!empty($request->input('search'))) {
            $data['srch_div']    = "block";
        }
        $data['page_list'] = Contacts::get_page_result($data['page'], $search_array);
        return view('admin.list-contact-details')->with($data);
    }
}
