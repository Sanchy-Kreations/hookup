<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\Message;
class FirstTimeMessage extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id',   
        'sender_id',
        'recipient_id',
        'msg',
        'cost',
        'paid',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'first_time_messages';
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

    public static function getMessageByIds($sender, $recipient) {
        $data = array();

        $first_time = self::where(function($p) use($sender, $recipient){
            $p->where('sender_id', '=', $sender);
            $p->where('recipient_id', '=', $recipient);
            $p->where('paid', '=', 0);
           })->get();

         if(count($first_time) > 0){
        foreach($first_time as $message){
            $data['id'] = $message->id; 
            $data['msg'] = $message->msg;
            $data['cost'] = $message->cost;
            //$data['date'] = $message->created_at;
            //$data['uid'] = $record->uid;
        }
        return $data;
    }else{
        return false;
    }
    }


  public static function updateRecord($sender, $recipient){
    
    $update_record = self::where(function($p) use($sender, $recipient){
        $p->where('sender_id', '=', $sender);
        $p->where('recipient_id', '=', $recipient);
       })->update(['paid' => 1]);
    return $update_record;
  }  


}
