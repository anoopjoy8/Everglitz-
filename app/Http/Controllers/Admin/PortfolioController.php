<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\General;
use App\Models\Portfolio;
use Hash;
use Session;
use Image;
use Webp;

class PortfolioController extends Controller
{
    function index(Request $request)
    {
        $data               = ['title' => 'Portfolio', 'srch_div' => 'none'];
        $data['page']       = ($request->input('page')) ? $request->input('page') : 1;
        $data['count']      = General::get_count('portfolio');
        $search_array       = "";
        if (!empty($request->input('sr'))) {
            $data['titlep']   = $request->input('titlep');
            $search_array     = array("title" => $data['titlep']);
            $data['srch_div'] = "block";
        }
        if (!empty($request->input('search'))) {
            $data['srch_div']    = "block";
        }
        $data['portfolio_list'] = Portfolio::get_portfolio_result($data['page'], $search_array);
        return view('admin.list-portfolio')->with($data);
    }
    function Add(Request $request)
    {
        $data                  = ['title' => 'Add Portfolio'];
        $data['page']           = ($request->input('page')) ? $request->input('page') : 1;
        $search_array          = "";
        $method                = $request->method();
        if ($method == 'POST') {
            $data['titlep']            = $request->titlep;
            $data['description']       = $request->description;
            $data['main_img']          = $request->main_img;
            $img                      = $data['main_img'];
            $img_name                 = "";
            $date                     = date('Y-m-d H:i:s');
            if ($img != "") {
                $img_name             = $img->getClientOriginalName();
            }
            $val_array                = array(
                "titlep" => array($data['titlep'], 'Title required'),
                "description" => array(
                    $data['description'],
                    'Description required'
                )
            );
            $data['error_msg'] = validation($val_array);
            $check_existance  = Portfolio::Existance($data['titlep']);

            if ((empty($data['error_msg'])) && ($check_existance == "false")) {
                $filename        = pathinfo($img_name, PATHINFO_FILENAME);
                $imageName       = time() . '-' . $filename;
                $img_upload      =  $this->Image_upload($request, $request->main_img, $imageName);
                if ($img_upload != "") {
                    $insert_array  = array(
                        "title" => $data['titlep'],
                        "description" => $data['description'],
                        "image" => $imageName . ".webp",
                        "created" => $date
                    );
                    $db_table      = "portfolio";
                    $insert_data  = Portfolio::insert_portfolio($insert_array, $db_table);
                    if ($request->file('files') != "") {
                        $subimg_upload  =  $this->subImage_upload($request, $insert_data);
                    }
                    if ($insert_data != "") {
                        session()->flash('success', 'Portfolio Created Successfully');
                        return redirect('admin/list-portfolio');
                    }
                }
            } else {
                if ($check_existance == "true") {
                    session()->flash('error', "title already exist");
                }
                if (!empty($data['error_msg'])) {
                    session()->flash('error', $data['error_msg']);
                }
            }
        }
        return view('admin.add-portfolio')->with($data);
    }
    function Update(Request $request)
    {
        $data                  = ['title' => 'Update Portfolio'];
        $data['page']          = ($request->input('page')) ? $request->input('page') : 1;
        $method                = $request->method();

        if ($request->input('edit')) {
            $id              = $request->input('edit');
            $result          = Portfolio::get_result($id);
            $data['id']               = $id;
            $data['titlep']           = $result->title;
            $data['description']      = $result->description;
            $data['image']            = $result->image;
            $data['sub_images']       = Portfolio::get_subimages($id);
        }
        if ($method == 'POST') {
            $id                       = $request->id;
            $page                     = $request->page;
            $data['titlep']           = $request->titlep;
            $data['description']      = $request->description;
            $data['image']            = $request->main_img;
            $img_name                 = "";
            $img                      = $data['image'];
            if ($img != "") {
                $img_name             = $img->getClientOriginalName();
            }

            $val_array                = array(
                "titlep" => array($data['titlep'], 'Title required'),
                "description" => array(
                    $data['description'],
                    'Description required'
                )
            );
            $data['error_msg'] = validation($val_array);
            $check_existance  = Portfolio::Existance_update($id, $data['titlep']);
            if ((empty($data['error_msg'])) && ($check_existance == 0)) {
                if ($img_name != "") {
                    $this->remove_Image($id);
                    if ($data['image'] != "") {
                        $filename        = pathinfo($img_name, PATHINFO_FILENAME);
                        $imageName       = time() . '-' . $filename;
                        $img_upload    = $this->Image_upload($request, $request->main_img, $imageName);
                    }
                }
                $update_array  = array(
                    "title" => $data['titlep'],
                    "description" => $data['description']
                );
                $db_table      = "portfolio";
                $update_data   = Portfolio::update_portfolio($update_array, $db_table, $id);
                if ($img_name != "") {
                    $update_array  = array("image" => $imageName . ".webp");
                    $update_data   = Portfolio::update_portfolio($update_array, $db_table, $id);
                }
                if ($request->file('files') != "") {
                    $subimg_upload  =  $this->subImage_upload($request, $id);
                }
                if ($update_data != "") {
                    session()->flash('success', 'Portfolio Updated Successfully');
                    return redirect('admin/list-portfolio?page=' . $page);
                }
            } else {
                if ($check_existance != 0) {
                    session()->flash('error', "title already exist");
                    return redirect('admin/update-portfolio?edit=' . $id . '&page=' . $page);
                }
                if (!empty($data['error_msg'])) {
                    session()->flash('error', $data['error_msg']);
                }
            }
        }
        return view('admin.add-portfolio')->with($data);
    }
    function Delete(Request $request)
    {
        $page        = $request->page;
        $id          = $request->id;
        $remove_main = $this->remove_Image($id);
        $remove_sub  = $this->remove_sub_Images($id);
        $delete      = Portfolio::delete_portfolio($id);
        $delete      = Portfolio::delete_sub_portfolio($id);
        if ($delete == "") {
            session()->flash('success', 'Portfolio Deleted Successfully');
            return redirect('admin/list-portfolio?page=' . $page);
        }
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
        $files      = array($original);
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
        $file_name  = Portfolio::get_image_name($id);
        $file_name  = $file_name['image'];
        $original   = public_path('/uploads/' . $file_name);
        $thumb      = public_path('/thumbnail/' . $file_name);
        $files      = array($original, $thumb);
        \File::delete($files);
    }
    private function remove_sub_Images($id)
    {
        $file_name  = Portfolio::get_subimages($id);
        foreach ($file_name as $val) {
            $file_name  = $val->image;
            $original     = public_path('/uploads/' . $file_name);
            $thumb         = public_path('/thumbnail/' . $file_name);
            $files      = array($original, $thumb);
            \File::delete($files);
        }
    }
    private function subImage_upload($request, $id)
    {
        $image_names = [];
        foreach ($request->file('files') as $image) {
            $name        = $image->getClientOriginalName();
            $filename    = pathinfo($name, PATHINFO_FILENAME);
            $imageName   = time() . '-sub-' . $filename;
            $image->move(public_path() . '/uploads/', $imageName);

            //webp conversion
            $destinationPath = public_path('/uploads');
            $orginal_path    = $destinationPath . "/" . $imageName;
            $image_we = Image::make($orginal_path)->encode('webp', 90)->save(public_path('uploads/'  .  $imageName . '.webp'));
            $image_we = Image::make($orginal_path)->encode('webp', 90)->resize(200, 200)->save(public_path('thumbnail/'  .  $imageName . '.webp'));
            $image_names[] = $imageName . '.webp';

            //deletion of  original file
            $original     = public_path('/uploads/' . $imageName);
            $files      = $original;
            \File::delete($files);
        }
        $Add_image  = Portfolio::Sub_imageadd($image_names, $id);
    }
}
