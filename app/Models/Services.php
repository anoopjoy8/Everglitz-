<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;
use Hash;
Use Config;

class Services extends Model
{
    protected $table = 'services';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function insert_services($fields,$dbtable)
    {
        $insert = DB::table($dbtable)->insert([
            $fields
        ]);
        return DB::getPdo()->lastInsertId();
    }
    public static function update_services($fields,$dbtable,$id)
    {
        $update = DB::table($dbtable)
                ->where('id',$id)
                ->update($fields);
                return DB::getPdo()->lastInsertId();
    }
    public static function get_page_result($page,$srch)
    {
        $offset= ($page-1) * Config::get('constants.PG_LIMIT_AD');
        $query = Services::select('id','title','description','image') 
                                 ->orderBy('id','asc');
                                
        if(!empty($srch))
        {
            if($srch['title'] !="")
            {
                $query->where('title','like','%'.$srch['title'].'%');
            } 
        }  
        //print_r($query->toSql()); exit();            
        return $query ->offset($offset)
                      ->limit(Config::get('constants.PG_LIMIT_AD'))
                      ->get();
    }
    public static function get_service_result_f(){
        $query = Services::select('id','title','description','image') 
                                 ->orderBy('id','asc');
                                 return $query->get();
    }
    public static function get_result($id)
    {
        $query = Services::where('id',$id);
        return $query->first();
    }
    public static function Existance($title)
    {
        if (Services::where('title', $title )->exists()) 
        {
            return "true";
        }
        else
        {
            return "false";
        }
    }
    public static function Existance_update($id,$title)
    {
        $query = Services::where('title',$title)
                     ->where('id', '!=', $id)  
                     ->get();
        $ResCount = $query->count();
        return $ResCount;

    }
    public static function get_image_name($id)
    {
        $query = Services::select('image')
                ->where('id',$id);
        return $query->first();        
    }

    public static function delete_service($id)
    {
        DB::table('services')
        ->where('id', $id)
        ->delete();
    }
}

