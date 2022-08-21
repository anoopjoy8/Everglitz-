<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\General;
use App\Models\Banner;
use Image;
use Webp;

class BannerController extends Controller
{
    function index(Request $request)
    {
        $data               = ['title' => 'Banner Details', 'srch_div' => 'none'];
        $data['page']       = ($request->input('page')) ? $request->input('page') : 1;
        $data['count']      = General::get_count('banner');
        $data['add_div']    = "none";
        $search_array       = "";
        if($request->input('edit')){
            $data['add_div']    = "block";
            $id      = $request->input('edit');
            $result  = Banner::get_result($id);
            $data['id']                 = $id;
            $data['titlep']             = $result->title;
            $data['description']        = $result->description;
            $data['image']              = $result->image;
        }
        $data['banner_list']      = Banner::get_page_result($data['page'], $search_array);
        return view('admin.list-banner-image')->with($data);
    }

    function Update(Request $request)
    {
        $data                   = ['title' => 'Update Banner Details', 'srch_div' => 'none'];
        $data['page']           = ($request->input('page')) ? $request->input('page') : 1;
        $data['add_div']        = "block";
        $method                 = $request->method();
        $data['count']          = General::get_count('banner');
        if ($method == 'POST') {
            $id                       = $request->id;
            $data['titlep']           = $request->titlep;
            $data['description']      = $request->description;
            $data['image']            = $request->main_img;
            $img_name                 = "";
            $img                      = $data['image'];
            if ($img != "") {
                $img_name             = $img->getClientOriginalName();
            }

            if ($img_name != "") {
                $this->remove_Image($id);
                if ($data['image'] != "") {
                    $filename        = pathinfo($img_name, PATHINFO_FILENAME);
                    $imageName       = time() . '-' . $filename;
                    $img_upload    = $this->Image_upload($request, $request->main_img, $imageName);
                }
            }
            $update_array  = array(
                "title"        => $data['titlep'],
                "description"  => $data['description']
            );
            $db_table     = "banner";

            $update_data  = Banner::update_banner($update_array, $db_table, 1);
            if ($img_name != "") {
                $update_array  = array("image" => $imageName . ".webp");
                $update_data   = Banner::update_banner($update_array, $db_table, $id);
            }
            if ($update_data != "") {
                session()->flash('success', 'Banner Updated Successfully');
                return redirect('admin/list-banner-image');
            }
        }
        return view('admin.list-banner-image')->with($data);
    }

    private function Image_upload($request, $image, $name)
    {
        //image validation
        $destinationPath = public_path('/uploads');
        $orginal_path    = $destinationPath . "/" . $name;
        $validate        = $this->validate($request, ['main_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        $uploaded        = $image->move(public_path() . '/uploads/', $name);

        //webp conversion
        $image_we = Image::make($orginal_path)->encode('webp', 90)->save(public_path('uploads/'  .  $name . '.webp'));
        $image_we = Image::make($orginal_path)->encode('webp', 90)->resize(200, 200)->save(public_path('thumbnail/'  .  $name . '.webp'));

        //deletion of  original file
        $original     = public_path('/uploads/' . $name);
        $files        = array($original);
        \File::delete($files);

        /*  //thumbnail making
        $thumbnailpath   = public_path('/thumbnail/'.$name);
        $img  = Image::make($orginal_path)->resize(250, 250, function($constraint) {
            $constraint->aspectRatio();
        })->save($thumbnailpath); */
        return $uploaded;
    }
    private function remove_Image($id)
    {
        $file_name    = Banner::get_image_name($id);
        $file_name    = $file_name['image'];
        $original     = public_path('/uploads/' . $file_name);
        $thumb        = public_path('/thumbnail/' . $file_name);
        $files        = array($original, $thumb);
        \File::delete($files);
    }
}
