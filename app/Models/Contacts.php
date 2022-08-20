<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;
use Config;

class Contacts extends Model
{
    protected $table = 'contact_details';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function get_page_result($page,$srch)
    {
        $offset= ($page-1) * Config::get('constants.PG_LIMIT_AD');
        $query = Contacts::select('id','phone1','phone2','email') 
                                 ->orderBy('id','asc');
                                
        if(!empty($srch))
        {
            if($srch['phone1'] !="")
            {
                $query->where('phone1','like','%'.$srch['phone1'].'%');
            } 
        }  
        //print_r($query->toSql()); exit();            
        return $query ->offset($offset)
                      ->limit(Config::get('constants.PG_LIMIT_AD'))
                      ->get();
    }
}

