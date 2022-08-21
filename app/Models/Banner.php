<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;
use Config;

class Banner extends Model
{
    protected $table = 'banner';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function get_page_result($page,$srch)
    {
        $offset= ($page-1) * Config::get('constants.PG_LIMIT_AD');
        $query = Banner::select('id','title','description','image') 
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
    public static function get_result($id)
    {
        $query = Banner::where('id',$id);
        return $query->first();
 
    }
    public static function update_banner($fields, $dbtable, $id)
    {
        $update = DB::table($dbtable)
            ->where('id', $id)
            ->update($fields);
        return DB::getPdo()->lastInsertId();
    }
    public static function get_image_name($id)
    {
        $query = Banner::select('image')
                ->where('id',$id);
        return $query->first();        
    }
}

