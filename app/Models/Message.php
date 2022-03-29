<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\FirstTimeMessage;
use App\Models\SupportTicket;

class Message extends Eloquent
{
    use HasFactory;

    protected $fillable = [ 
        'id',   
        'support_id',
        'sender_id',
        'recipient_id',
        'msg',
        'seen',
        'deleted',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'messages';
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

    public static function getAllByIds($sender, $recipient) {
        

        $first_time = FirstTimeMessage::where(function($p) use($sender, $recipient){
            $p->where('sender_id', '=', $sender);
            $p->where('recipient_id', '=', $recipient);
            $p->where('paid', '=', 0);
           })->get();

        $messages = self::where(function($p) use($sender, $recipient){
            $p->where('sender_id', '=', $sender);
            $p->where('recipient_id', '=', $recipient);
            $p->orWhere('sender_id', '=', $recipient);
            $p->where('recipient_id', '=', $sender);
           })->get();

        if(count($messages) > 0){
        foreach($messages as $message){
            if($message->sender_id == $sender){
                $data = array('id' => $message->id,
                             'support_id' => $message->support_id,
                             'me' => User::where('id', $message->sender_id)->get(),
                             'recipient' => User::where('id', $message->recipient_id)->get(),
                             'msg' => $message->msg,
                             'seen' => $message->seen,
                             'deleted' => $message->deleted,
                             'created_at' => $message->created_at,
                             'updated_at' => $message->updated_at
            //$data['uid'] = $record->uid;
                );
        }else if($message->recipient_id == $sender){
            $data = array('id' => $message->id,
            'support_id' => $message->support_id,
            'recipient' => User::where('id', $message->sender_id)->get(),
            'me' => User::where('id', $message->recipient_id)->get(),   
            'msg' => $message->msg,
            'seen' => $message->seen,
            'deleted' => $message->deleted,
            'created_at' => $message->created_at,
            'updated_at' => $message->updated_at
//$data['uid'] = $record->uid;
          );
            
            }


        }
        return $data;
    }else if(count($first_time) > 0){
        $data = array();
        foreach($first_time as $message){
            $data['id'] = $message->id;
            if($message->sender_id == $sender){
            $data['me'] = User::where('id', $message->sender_id)->get();
            $data['recipient'] = User::where('id', $message->recipient_id)->get();
            }else if($message->recipient_id == $sender){
            $data['recipient'] = User::where('id', $message->sender_id)->get();
            $data['me'] = User::where('id', $message->recipient_id)->get();   
            }
            $data['msg'] = $message->msg;
            $data['cost'] = $message->cost;
            $data['date'] = $message->created_at;
            //$data['uid'] = $record->uid;
        }
        return $data;
    }else{
        return false;
    }
    }


    public static function checkMsg($sender, $recipient){
        //$data = array();

        $first_time = FirstTimeMessage::where(function($p) use($sender, $recipient){
            $p->where('sender_id', '=', $sender);
            $p->where('recipient_id', '=', $recipient);
            $p->where('paid', '=', 0);
           })->get();

        $messages = self::where(function($p) use($sender, $recipient){
            $p->where('sender_id', '=', $sender);
            $p->where('recipient_id', '=', $recipient);
            $p->orWhere('sender_id', '=', $recipient);
            $p->where('recipient_id', '=', $sender);
           })->get();

        if(count($messages) > 0){
        $str = "message";
        return $str;
    }else if(count($first_time) > 0){
        $str = "first_time";
        return $str;
    }else{
        return false;
    }
    }

    public static function getRecordById($id){
        return self::where('id', $id)->first();
    }

}
