<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use DB;
use Hash;
Use Config;

class Portfolio extends Model
{
    protected $table = 'portfolio';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function insert_portfolio($fields,$dbtable)
    {
        $insert = DB::table($dbtable)->insert([
            $fields
        ]);
        return DB::getPdo()->lastInsertId();
    }
    public static function update_portfolio($fields,$dbtable,$id)
    {
        $update = DB::table($dbtable)
                ->where('id',$id)
                ->update($fields);
                return DB::getPdo()->lastInsertId();
    }
    public static function get_portfolio_result($page,$srch)
    {
        $offset= ($page-1) * Config::get('constants.PG_LIMIT_AD');
        $query = Portfolio::select('id','title','description','image') 
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
    public static function get_portfolio_result_f(){
        $query = Portfolio::select('id','title','description','image') 
                                 ->orderBy('id','asc');
                                 return $query->get();
    }
    public static function get_result($id)
    {
        $query = Portfolio::where('id',$id);
        return $query->first();
    }
    public static function Existance($title)
    {
        if (Portfolio::where('title', $title )->exists()) 
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
        $query = Portfolio::where('title',$title)
                     ->where('id', '!=', $id)  
                     ->get();
        $ResCount = $query->count();
        return $ResCount;

    }
    public static function get_image_name($id)
    {
        $query = Portfolio::select('image')
                ->where('id',$id);
        return $query->first();        
    }
    public static function get_sub_image_name($id)
    {
        $query =  DB::table('portfolio_images')
                ->select('image','id','portfolio_id')
                ->where('id',$id);
        return $query->first();        
    }
    public static function get_subimages($id)
    {
        $images = DB::table('portfolio_images')
        ->select('image','id','portfolio_id')
        ->where('portfolio_id',$id)
        ->get(); 
        return $images;
    }
    public static function delete_subimage($id)
    {
        DB::table('portfolio_images')
        ->where('id', $id)
        ->delete();
    }
    public static function delete_portfolio($id)
    {
        DB::table('portfolio')
        ->where('id', $id)
        ->delete();
    }
    public static function delete_sub_portfolio($id)
    {
        DB::table('portfolio_images')
        ->where('portfolio_id', $id)
        ->delete();
    }
    public static function Sub_imageadd($files,$id)
    {
        foreach ($files as $key=>$value) 
        {
            DB::table('portfolio_images')->insert([
                'image' => $value,
                'portfolio_id' => $id
            ]);
        }
    }
}

