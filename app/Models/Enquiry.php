<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Config;

class Enquiry extends Model
{
    protected $table = 'enquiry';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function get_enquiry_result($page, $srch)
    {
        $offset = ($page - 1) * Config::get('constants.PG_LIMIT_AD');
        $query = Enquiry::select('id', 'name', 'phone', 'email', 'location', 'message')
            ->orderBy('id', 'asc');

        if (!empty($srch)) {
            if ($srch['name'] != "") {
                $query->where('name', 'like', '%' . $srch['name'] . '%');
            }
            if ($srch['phone'] != "") {
                $query->where('phone', 'like', '%' . $srch['phone'] . '%');
            }
            if ($srch['email'] != "") {
                $query->where('email', 'like', '%' . $srch['email'] . '%');
            }
            if ($srch['location'] != "") {
                $query->where('location', 'like', '%' . $srch['location'] . '%');
            }
        }
        //print_r($query->toSql()); exit();            
        return $query->offset($offset)
            ->limit(Config::get('constants.PG_LIMIT_AD'))
            ->get();
    }
    public static function get_result($id)
    {
        $query = Enquiry::where('id', $id);
        return $query->first();
    }
    public static function delete_enquiry($id)
    {
        DB::table('enquiry')
        ->where('id', $id)
        ->delete();
    }
}
