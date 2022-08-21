<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Portfolio;

class AjaxController extends Controller
{
    function DeleteImage(Request $request)
    {
        $id           = $request->input('id');
        $page_id      = $request->input('page_id');
        $remove       = $this->remove_Image($id);
        $delete_image = Page::delete_subimage($id);
        $sub_images      = Page::get_subimages($page_id);
        foreach ($sub_images as $row) {
?>
            <span class="pip"><img src="<?= url('thumbnail/' . $row->image) ?>" class="imageThumb" />
                <br>
                <span class="removes" onClick="DeleteImage(<?= $row->id ?>,<?= $row->page_id ?>)"> <i class="fa-solid fa-trash-can"></i></span>
            </span>

<?php
        }
    }

    function DeletepImage(Request $request)
    {
        $id           = $request->input('id');
        $portfolio_id = $request->input('portfolio_id');
        $remove       = $this->remove_PImage($id);
        $delete_image = Portfolio::delete_subimage($id);
        $sub_images   = Portfolio::get_subimages($portfolio_id);
        foreach ($sub_images as $row) {
?>
            <span class="pip"><img src="<?= url('thumbnail/' . $row->image) ?>" class="imageThumb" />
                <br>
                <span class="removes" onClick="DeletepImage(<?= $row->id ?>,<?= $row->portfolio_id ?>)"> <i class="fa-solid fa-trash-can"></i></span>
            </span>

<?php
        }
    }

    private function remove_Image($id)
    {
        $file_name  = Page::get_sub_image_name($id);
        $file_name  = $file_name->image;
        $original     = public_path('/uploads/' . $file_name);
        $thumb         = public_path('/thumbnail/' . $file_name);
        $files      = array($original, $thumb);
        \File::delete($files);
    }

    private function remove_PImage($id)
    {
        $file_name  = Portfolio::get_sub_image_name($id);
        $file_name  = $file_name->image;
        $original   = public_path('/uploads/' . $file_name);
        $thumb      = public_path('/thumbnail/' . $file_name);
        $files      = array($original, $thumb);
        \File::delete($files);
    }
}
