<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\User;
use App\Models\DateRequest;
class DateApplication extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id',
        'request_id',   
        'applicant_id',
        'poster_id',
        'accepted',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'date_applications';
    protected $casts = [ 
        'id' => 'integer', 
        'request_id' => 'integer',
        'applicant_id' => 'integer',
        'poster_id' => 'integer',
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public static function getAllRecords() {
        $data = array();
        $records = self::orderBy('id', 'desc')->get();
        foreach($records as $record){
            $data['date_request'] = DateRequest::where('id', $record->request_id)->get();
            $data['applicant'] = User::where('id', $record->applicant_id)->get();
            $data['poster'] = User::where('id', $record->poster_id)->get();

        }

        return $data;
    }


    public static function getAllRecordsByPoster($id) {
        $data = array();
        $records = self::where('poster_id', $id)->orderBy('id', 'desc')->get();
        if(count($records) > 0){
        foreach($records as $record){
            $data['date_request'] = DateRequest::where('id', $record->request_id)->get();
            $data['applicant'] = User::where('id', $record->applicant_id)->get();
            //$data['poster'] = User::where('id', $record->poster_id)->get();
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
