<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\General;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    function index(Request $request)
    {
        $data               = ['title' => 'Enquiry Details', 'srch_div' => 'none'];
        $data['page']       = ($request->input('page')) ? $request->input('page') : 1;
        $data['count']      = General::get_count('enquiry');
        $search_array       = "";
        if (!empty($request->input('search'))) {
            $data['srch_div']    = "block";
        }
        if (!empty($request->input('sr'))) {
            $data['name']       = $request->input('name');
            $data['email']      = $request->input('email');
            $data['location']   = $request->input('location');
            $data['phone']      = $request->input('phone');
            $search_array     = array("name" => $data['name'],"email" => $data['email'],"location" => $data['location'],"phone" => $data['phone']);
            $data['srch_div'] = "block";
        }
        $data['contact_list']      = Enquiry::get_enquiry_result($data['page'], $search_array);
        return view('admin.list-enquiry')->with($data);
    }
    function Delete(Request $request)
    {
        $page        = $request->page;
        $id          = $request->id;
        $delete      = Enquiry::delete_enquiry($id);
        if ($delete == "") {
            session()->flash('success', 'Enquiry Deleted Successfully');
            return redirect('admin/list-enquiry?page=' . $page);
        }
    }
}
