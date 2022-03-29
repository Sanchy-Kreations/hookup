<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\Message;

class SupportTicket extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id', 
        'sender',  
        'support_ticket',
        'subject',
        'message',
        'status',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'support_tickets';
    protected $casts = [ 
        'id' => 'integer', 
        'sender' => 'integer',
        //'subscriber_range' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static function getAllSupportsMessage(){
        $supports = self::orderBy('id', 'desc')->get();

        if(count($supports) > 0){
            foreach($supports as $support){
                $data = array(
                        'id' => $support->id,
                        'sender' => User::where('id', $support->sender)->get(),
                        'support_ticket' => $support->support_ticket,
                        'subject' => $support->subject,
                        'message' => $support->message,
                        'status' =>  $support->status,
                        'created_at' => $support->created_at,
                        'updated_at' => $support->updated_at
                          );
                
                     }
              return $data;

        }else{
            return false;
        }
    }

  
    

    public static function getSupportByTicket($ticket){
        $supports = self::where('support_ticket', $ticket)->orderBy('id', 'desc')->get();

        
        if(count($supports) > 0){
            foreach($supports as $support){
                $data = array(
                        'id' => $support->id,
                        'sender' => User::where('id', $support->sender)->get(),
                        'support_ticket' => $support->support_ticket,
                        'subject' => $support->subject,
                        'message' => $support->message,
                        'status' =>  $support->status,
                        'created_at' => $support->created_at,
                        'updated_at' => $support->updated_at
                          );
                
                     }
              return $data;

        }else{
            return false;
        }

    }


    public static function getSupportByStatus($status){
        $supports = self::where('status', $status)->orderBy('id', 'desc')->get();

        
        if(count($supports) > 0){
            foreach($supports as $support){
                $data = array(
                        'id' => $support->id,
                        'sender' => User::where('id', $support->sender)->get(),
                        'support_ticket' => $support->support_ticket,
                        'subject' => $support->subject,
                        'message' => $support->message,
                        'status' =>  $support->status,
                        'created_at' => $support->created_at,
                        'updated_at' => $support->updated_at
                          );
                
                     }
              return $data;

        }else{
            return false;
        }

    }



    public static function getSupportByUser($sender){
        $supports = self::where('sender', $sender)->orderBy('id', 'desc')->get();

        
        if(count($supports) > 0){
            foreach($supports as $support){
                $data = array(
                        'id' => $support->id,
                        'sender' => User::where('id', $support->sender)->get(),
                        'support_ticket' => $support->support_ticket,
                        'subject' => $support->subject,
                        'message' => $support->message,
                        'status' =>  $support->status,
                        'created_at' => $support->created_at,
                        'updated_at' => $support->updated_at
                          );
                
                     }
              return $data;

        }else{
            return false;
        }

    }


    public static function getPendingSupportCount(){
        $supports = self::where('status', 'Pending')->get();       
        if(count($supports) > 0){           
              return count($supports);
        }else{
            return false;
        }

    }




    


}
