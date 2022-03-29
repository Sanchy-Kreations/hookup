<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Models\PostViewers;
use App\Models\User;

class Post extends Eloquent
{
    use HasFactory;


    protected $fillable = [ 
        'id', 
        'uid',  
        'cnt',
        'media_1',
        'media_files',
        'monetize',
        'amount',
        'created_at',
        'updated_at'
    ];
    
    protected $table = 'posts';
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



    public static function getUserPost($uid){
        $posts = self::where('uid', $uid)->orderBy('id', 'desc')->get();

        
        if(count($posts) > 0){
            foreach($posts as $post){
                $data = array(
                        'id' => $post->id,
                        'cnt' => $post->cnt,
                        'media_1' => $post->media_1,
                        'media_files' => $post->media_files,
                        'monetize' => $post->monetize,
                        'amount' => $post->amount,
                        'created_at' => $post->created_at,
                        'updated_at' => $post->updated_at,
                        'viewers' => PostViewers::getPostViewers($post->id)
                          );
                
                     }
              return $data;

        }else{
            return false;
        }

    }



    public static function getPostById($id){
        $posts = self::where('id', $id)->get();

        
        if(count($posts) > 0){
            foreach($posts as $post){
                $data = array(
                        'id' => $post->id,
                        'cnt' => $post->cnt,
                        'media_1' => $post->media_1,
                        'media_files' => $post->media_files,
                        'monetize' => $post->monetize,
                        'amount' => $post->amount,
                        'created_at' => $post->created_at,
                        'updated_at' => $post->updated_at,
                        'viewers' => PostViewers::getPostViewers($post->id)
                          );
                
                     }
              return $data;

        }else{
            return false;
        }

    }



}
