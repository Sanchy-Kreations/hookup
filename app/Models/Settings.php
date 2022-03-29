<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Settings extends Eloquent 
{
    use HasFactory;


    protected $fillable = [ 
        'id',  
        'currency',
        'logo',
        'icon',
        'language',
        'tel',
        'mobile',
        'email',
        'address',
        'site_name',
        'site_url',
        'payment_type',
        'facebook',
        'instagram',
        'twitter',
        'linkedin'
	 ];
     
	protected $primaryKey = 'id';
	protected $table = 'settings';
  	protected $dates = [
        'created_at',
        'updated_at'
    ];


    public static function insertTable($subData=array()){
        if($subData->id){
            $info = self::where('id', $subData->id)->update([
                'currency'             => $subData->currency,
                'logo'                 => $subData->logo,
                'icon'                 => $subData->icon,
                'language'             => $subData->language,
                'tel'                  => $subData->tel,
                'mobile'               => $subData->mobile,
                'email'                => $subData->email,
                'site_name'            => $subData->site_name,
                'site_url'             => $subData->site_url,
                'payment_type'         => $subData->payment_type,
                'facebook'             => $subData->facebook,
                'instagram'            => $subData->instagram,
                'twitter'              => $subData->twitter,
                'linkedin'             => $subData->linkedin
            ]);
        }
        else {
            $info = self::create([
                'currency'             => $subData->currency,
                'logo'                 => $subData->logo,
                'icon'                 => $subData->icon,
                'language'             => $subData->language,
                'tel'                  => $subData->tel,
                'mobile'               => $subData->mobile,
                'email'                => $subData->email,
                'site_name'            => $subData->site_name,
                'site_url'             => $subData->site_url,
                'payment_type'         => $subData->payment_type,
                'facebook'             => $subData->facebook,
                'instagram'            => $subData->instagram,
                'twitter'              => $subData->twitter,
                'linkedin'             => $subData->linkedin
            ]);

        }

        return $info;
    }


    public static function single(){
        return self::first();
    }


}
