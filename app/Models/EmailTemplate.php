<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class EmailTemplate extends Eloquent
{
    use HasFactory;

    protected $fillable = [ 
        'id',   
        'title',
        'content',
        'footer',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'email_templates';
    protected $casts = [ 
        'id' => 'integer', 
    ];
    protected $primaryKey = 'id';
    protected $dates = [
        'last_updated',
        'created_at',
        'updated_at',
    ];

    public function getRecords() {
        return self::get();
    }

    public static function getById($id){
        return self::where('id', $id)->first();
    }


}
