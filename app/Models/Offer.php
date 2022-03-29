<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\Message;

class Offer extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id',   
        'sender_id',
        'recipient_id',
        'amount',
        'response',
        'paid',
        'sender_confirmed',
        'recipient_confirmed',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'offers';
    protected $casts = [ 
        'id' => 'integer', 
        'sender_id' => 'integer',
        'recipient_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function getByIds($sender) {
        $data = array();

        $offers = self::where(function($p) use($sender){
            $p->where('sender_id', '=', $sender);
            $p->orWhere('recipient_id', '=', $sender);
           })->get();

           if(count($offers) > 0){
            foreach($offers as $offer){
                $data['id'] = $offer->id;
                if($offer->sender_id == $sender){
                $data['me'] = User::where('id', $offer->sender_id)->get();
                $data['recipient'] = User::where('id', $offer->recipient_id)->get();
                }else if($offer->recipient_id == $sender){
                $data['recipient'] = User::where('id', $offer->sender_id)->get();
                $data['me'] = User::where('id', $offer->recipient_id)->get();   
                }
                $data['amount'] = $offer->amount;
                $data['response'] = $offer->response;
                $data['paid'] = $offer->paid;
                $data['sender_confirmed'] = $offer->sender_confirmed;
                $data['recipient_confirmed'] = $offer->recipient_confirmed;
                $data['created_at'] = $offer->created_at;
                $data['updated_at'] = $offer->updated_at;
                //$data['uid'] = $record->uid;
            }
            return $data;
        }else{
            return false;
        }
    }


  

}
