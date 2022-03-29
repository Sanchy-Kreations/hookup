<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class AdminPrivilege extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id', 
        'uid',  
        'module',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'admin_privileges';
    protected $casts = [ 
        'id' => 'integer', 
        //'subscriber_range' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function getAllAdminModules(){
        $modules = self::orderBy('id', 'desc')->get();

        if(count($modules) > 0){
            foreach($modules as $module){
                $data = array(
                        'id' => $module->id,
                        'user_data' => User::where('id', $module->uid)->get(),
                        'module' => $module->module,
                        'created_at' => $module->created_at,
                        'updated_at' => $module->updated_at,
                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }

  
    

    public static function getAdminByModule($module){
        $modules = self::where('module', $module)->orderBy('id', 'desc')->get();

        if(count($modules) > 0){
            foreach($modules as $module){
                $data = array(
                        'id' => $module->id,
                        'user_data' => User::where('id', $module->uid)->get(),
                        'module' => $module->module,
                        'created_at' => $module->created_at,
                        'updated_at' => $module->updated_at,
                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }


    


}
