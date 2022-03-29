<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class WalletTransaction extends Eloquent
{
    use HasFactory;



    protected $fillable = [ 
        'id', 
        'sender',  
        'recipient',
        'coin_amount',
        'admin_commission',
        'referrer_commission',
        'description',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'wallet_transactions';
    protected $casts = [ 
        'id' => 'integer', 
        'sender' => 'integer',
        'recipient' => 'integer',
        'coin_amount' => 'integer',
        'admin_commission' => 'integer',
        'referrer_commission' => 'integer',

        //'subscriber_range' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function getAllTransaction(){
        $transaction = self::orderBy('id', 'desc')->get();

        if(count($transaction) > 0){
            foreach($transaction as $trans){
                $data = array(
                        'id' => $trans->id,
                        'sender' => User::where('id', $trans->sender)->get(),
                        'recipient' => User::where('id', $trans->recipient)->get(),
                        'coin_amount' => $trans->coin_amount,
                        'admin_commission' => $trans->admin_commission,
                        'referrer_commission' =>  $trans->referrer_commission,
                        'description' => $trans->description,
                        'created_at' => $trans->created_at,
                        'updated_at' => $trans->updated_at,

                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }

  
    

    public static function getUserTransaction($uid){
        $transaction = self::where(function($p) use($uid){
            $p->where('sender', '=', $uid);
            $p->orWhere('recipient', '=', $uid);
           })->orderBy('id', 'desc')->get();

        if(count($transaction) > 0){
            foreach($transaction as $trans){
                $data = array(
                        'id' => $trans->id,
                        'sender' => User::where('id', $trans->sender)->get(),
                        'recipient' => User::where('id', $trans->recipient)->get(),
                        'coin_amount' => $trans->coin_amount,
                        'admin_commission' => $trans->admin_commission,
                        'referrer_commission' =>  $trans->referrer_commission,
                        'description' => $trans->description,
                        'created_at' => $trans->created_at,
                        'updated_at' => $trans->updated_at,

                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }


    public static function getSenderTransaction($uid){
        $transaction = self::where('sender', $uid)->orderBy('id', 'desc')->get();

        if(count($transaction) > 0){
            foreach($transaction as $trans){
                $data = array(
                        'id' => $trans->id,
                        'sender' => User::where('id', $trans->sender)->get(),
                        'recipient' => User::where('id', $trans->recipient)->get(),
                        'coin_amount' => $trans->coin_amount,
                        'admin_commission' => $trans->admin_commission,
                        'referrer_commission' =>  $trans->referrer_commission,
                        'description' => $trans->description,
                        'created_at' => $trans->created_at,
                        'updated_at' => $trans->updated_at,

                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }



    public static function getRecipientTransaction($uid){
        $transaction = self::where('recipient', $uid)->orderBy('id', 'desc')->get();

        if(count($transaction) > 0){
            foreach($transaction as $trans){
                $data = array(
                        'id' => $trans->id,
                        'sender' => User::where('id', $trans->sender)->get(),
                        'recipient' => User::where('id', $trans->recipient)->get(),
                        'coin_amount' => $trans->coin_amount,
                        'admin_commission' => $trans->admin_commission,
                        'referrer_commission' =>  $trans->referrer_commission,
                        'description' => $trans->description,
                        'created_at' => $trans->created_at,
                        'updated_at' => $trans->updated_at,

                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }




}
