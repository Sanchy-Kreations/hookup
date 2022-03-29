<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class Subscription extends Eloquent
{
    use HasFactory;



    protected $fillable = [ 
        'id', 
        'uid',  
        'module',
        'duration',
        'sub_expire',
        'status',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'subscriptions';
    protected $casts = [ 
        'id' => 'integer', 
        'uid' => 'integer',
        //'subscriber_range' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function getAllSubscription(){
        $subscriptions = self::orderBy('id', 'desc')->get();

        if(count($subscriptions) > 0){
            foreach($subscriptions as $subscription){
                $data = array(
                        'id' => $subscription->id,
                        'user' => User::where('id', $subscription->uid)->get(),
                        'module' => $subscription->module,
                        'duration' => $subscription->duration,
                        'sub_expire' => $subscription->sub_expire,
                        'status' =>  $subscription->status,
                        'created_at' => $subscription->created_at,
                        'updated_at' => $subscription->updated_at,

                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }

    


    public static function deleteVoucher($id){
        $voucher = self::where('id', $id)->delete();
        if($voucher){
            return true;
        }else{
            return false;
        }
    }


}
