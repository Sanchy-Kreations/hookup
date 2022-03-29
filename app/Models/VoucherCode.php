<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;

class VoucherCode extends Eloquent
{
    use HasFactory;



    protected $fillable = [ 
        'id',   
        'promo_code',
        'bonus_code',
        'coin_amount',
        'subscriber_range',
        'exp_time',
        'status',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'voucher_codes';
    protected $casts = [ 
        'id' => 'integer', 
        'coin_amount' => 'integer',
        'subscriber_range' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function getAllVoucher(){
        $vouchers = self::orderBy('id', 'desc')->get();
        if(count($vouchers) > 0){
            return $vouchers;
        }else{
            return false;
        }
    }

    public static function getByPromoCode($promo) {
        $data = array();

        $vouchers = self::where(function($p) use($promo){
            $p->where('promo_code', '=', $promo);
            $p->orWhere('exp_time', '>', time());
           })->get();

           if(count($vouchers) > 0){
        return $vouchers;
        }else{
            return false;
        }
    }


    public static function getByBonusCode($bonus) {
        $data = array();

        $vouchers = self::where(function($p) use($bonus){
            $p->where('bonus_code', '=', $bonus);
            $p->orWhere('exp_time', '>', time());
           })->get();

           if(count($vouchers) > 0){
        return $vouchers;
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
