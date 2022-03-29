<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\AdminPrivilege;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username','phone','email','email_verified_at','password','age','country','state','city','country_code','img_1','images','verified','verified_img',
        'gender','gender_interest','referrer_id','role','user_type','private','subscribed','status','loggedin','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getReferrer($ref){
        $profile = self::where('id', $ref)->get();
        if(count($profile) > 0){
             $data = array('id' => $profile[0]->id,
                           'name' => $profile[0]->name,
                           'username' => $profile[0]->username,
                           'phone' => $profile[0]->phone,
                           'email' => $profile[0]->email,
                           'img_1' => $profile[0]->img_1
                     );
            return $data;
        }else{
            return false;
        }
    }


    public static function getNetworkDownLine($ref){
        $profile = self::where('referrer_id', $ref)->get();
        if(count($profile) > 0){
            $array_data = array();
            foreach($profile as $data){
             $data['id'] = $data->id;
             $data['name'] = $data->name;
             $data['username'] = $data->username;
             $data['phone'] = $data->phone;
             $data['email'] = $data->email;
             $data['img_1'] = $data->img_1;

             array_push($array_data, $data);
            }  
            return $array_data;
        }else{
            return false;
        }
    }

    public static function getUserProfile($id){
        $profile = self::where('id', $id)->get();
        if(count($profile) > 0){
            
            $data = array('id' => $profile[0]->id,
                          'name' => $profile[0]->name,
                          'username' => $profile[0]->username,
                          'phone' => $profile[0]->phone,
                          'email' => $profile[0]->email,
                          'age' => $profile[0]->age,
                          'country' => $profile[0]->country,
                          'state' => $profile[0]->state,
                          'city' => $profile[0]->city,
                          'country_code' => $profile[0]->country_code,
                          'img_1' => $profile[0]->img_1,
                          'images' => $profile[0]->images,
                          'verified' => $profile[0]->verified,
                          'verified_img' => $profile[0]->verified_img,
                          'gender' => $profile[0]->gender,
                          'gender_interest' => $profile[0]->gender_interest,
                          'referrer' => self::getReferrer($profile[0]->referrer_id),
                          'role' => $profile[0]->role,
                          'user_type' => $profile[0]->user_type,
                          'privileges' => AdminPrivilege::where('uid', $profile[0]->id)->get(),
                          'private' => $profile[0]->private,
                          'subscribed' => $profile[0]->subscribed,
                          'status' => $profile[0]->status,
                          'loggedIn' => $profile[0]->loggedIn,
                          'created_at' => $profile[0]->created_at,
                          'updated_at' => $profile[0]->updated_at
        );
        return $data;
        }else{
        return false;
        }
    }


    public static function getAllUserRecord(){
        $profilePics = self::orderBy('id', 'desc')->get();
        if(count($profilePics) > 0){
            $array_data = array();
            foreach($profilePics as $data){
            $data['id'] = $data->id;
            $data['name'] = $data->name;
            $data['username'] = $data->username;
            $data['phone'] = $data->phone;
            $data['email'] = $data->email;
            $data['age'] = $data->age;
            $data['country'] = $data->country;
            $data['state'] = $data->state;
            $data['city'] = $data->city;
            $data['country_code'] = $data->country_code;
            $data['img_1'] = $data->img_1;
            $data['images'] = $data->images;
            $data['verified'] = $data->verified;
            $data['verified_img'] = $data->verified_img;
            $data['gender'] = $data->gender;
            $data['gender_interest'] = $data->gender_interest;
            $data['referrer'] = self::getReferrer($data->referrer_id);
            $data['role'] = $data->role;
            $data['user_type'] = $data->user_type;
            $data['privileges'] = AdminPrivilege::where('uid', $data->id)->get();
            $data['private'] = $data->private;
            $data['subscribed'] = $data->subscribed;
            $data['status'] = $data->status;
            $data['loggedIn'] = $data->loggedIn;
            $data['created_at'] = $data->created_at;
            $data['updated_at'] = $data->updated_at;
            
            array_push($array_data, $data);
           }
        return $array_data;
        }else{
        return false;
        }
    }



}
