<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\Post;
use App\Models\User;

class PostViewers extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id', 
        'post_id',  
        'uid',
        'ip',
        'paid',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'post_viewers';
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



    public static function getPostViewers($pid){
        $postView = self::where('post_id', $pid)->orderBy('id', 'desc')->get();

        
        if(count($postView) > 0){
            $array_data = array();
            foreach($postView as $post){
                 
                $post['id'] = $post->id;
                $post['post_id'] = $post->post_id;
                $post['user'] = User::getUserProfile($post->uid);
                $post['ip_address'] = $post->ip;
                $post['paid'] = $post->paid;
                $post['created_at'] = $post->created_at;
                $post['updated_at'] = $post->updated_at;
                
                array_push($array_data, $post);
                
                     }
              return $array_data;

        }else{
            return false;
        }

    }


}
