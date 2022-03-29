<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class SubModule extends Eloquent
{
    use HasFactory;



    protected $fillable = [ 
        'id',   
        'module',
        'duration',
        'coin_amount',
        'module_type',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'sub_modules';
    protected $casts = [ 
        'id' => 'integer', 
        'coin_amount' => 'integer',
        //'subscriber_range' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function getAllSubscription(){
        $subscription = self::orderBy('id', 'desc')->get();
        if(count($subscription) > 0){
            return $subscription;
        }else{
            return false;
        }
    }

    public static function getBySubscriptionModule($module) {
        $data = array();
        $subscription = self::where('module', $module)->get();
       if(count($subscription) > 0){
        return $subscription;
        }else{
            return false;
        }
    }


    public static function deleteSubModule($id){
        $voucher = self::where('id', $id)->delete();
        if($voucher){
            return true;
        }else{
            return false;
        }
    }


}
