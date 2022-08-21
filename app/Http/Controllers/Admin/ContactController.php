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
        if($request->input('edit')){
            $data['add_div']    = "block";
            $id      = $request->input('edit');
            $result  = Contacts::get_result($id);
            $data['id']                = $id;
            $data['phone1']            = $result->phone1;
            $data['phone2']            = $result->phone2;
            $data['email']             = $result->email;
        }
        $data['contact_list']      = Contacts::get_page_result($data['page'], $search_array);
        return view('admin.list-contact-details')->with($data);
    }

    function Update(Request $request)
    {
        $data                   = ['title' => 'Update Contacts', 'srch_div' => 'none'];
        $data['page']           = ($request->input('page')) ? $request->input('page') : 1;
        $data['add_div']        = "block";
        $method                 = $request->method();
        $data['count']          = General::get_count('contact_details');
        if ($method == 'POST') {
            $data['phone1']           = $request->phone1;
            $data['phone2']           = $request->phone2;
            $data['email']            = $request->email;

            $update_array  = array(
                "phone1" => $data['phone1'],
                "phone2" => $data['phone2'],
                "email"  => $data['email']
            );
            $db_table     = "contact_details";

            $update_data  = Contacts::update_contact($update_array, $db_table, 1);
            if ($update_data != "") {
                session()->flash('success', 'Contacts Updated Successfully');
                return redirect('admin/list-contact-details');
            }
        }
        return view('admin.list-contact-details')->with($data);
    }
}
