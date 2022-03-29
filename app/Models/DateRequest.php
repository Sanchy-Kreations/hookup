<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
class DateRequest extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id',   
        'uid',
        'category',
        'info',
        'time',
        'closed',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'date_requests';
    protected $casts = [ 
        'id' => 'integer', 
        'uid' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function getAllRecords() {
        $data = array();
        $records = self::where('closed', 0)->orderBy('id', 'desc')->get();
        if(count($records) > 0){
        foreach($records as $record){
            $data['id'] = $record->id;
            $data['uid'] = $record->uid;
            $data['category'] = $record->category;
            $data['info'] = $record->info;
            //$data['uid'] = $record->uid;
            $data['user_data'] = User::where('id', $record->uid)->get();

        }
        return $data;
    }else{
        return false;
    }
    }

    public static function getRecordById($id){
        return self::where('id', $id)->first();
    }

}
