<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\UserVerification;
use App\Models\Post;
use App\Models\UserData;
use App\Models\UserWallet;
use App\Models\Subscription;
use App\Models\DateRequest;
use App\Models\DateApplication;
use App\Models\Transaction;
use App\Models\AdminWalletSettings;
use App\Models\VoucherCode;
use App\Models\VoucherVerification;
use App\Models\WalletTransaction;
use App\Models\PostViewers;
use App\Models\PaymentTracker;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class AccountManagerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view_user_profile($id){
     $user = User::where('id', $id)->get();
     if(count($user) > 0){
        //$post = Post::where('uid', $user[0]->id)->get();
        $user_data = UserData::where('uid', $user[0]->id)->get();
        $wallet = UserWallet::where('uid', $user[0]->id)->get();
        $date_request = DateRequest::where('uid', $user[0]->id)->get();
        $subs = Subscription::where('uid', $user[0]->id)->get(); 
        $data = array('profile' => User::getUserProfile($user[0]->id),
                      'personal_data' => $user_data,
                      'posts' => Post::getUserPost($user[0]->id),
                      'coin_balance' => $wallet,
                      'date_requests' => $date_request,
                      'referrer_network_downline' => User::getNetworkDownLine($id),
                      'personal_transaction_list' => '',
                      'referrer_network_downline_transactions' => '',
                      'subscription' => $subs
                      );
     return $this->sendResponse($data, 'User information shown succesfully.');
     }else{
    return $this->showErrorMsg('No user record fetched', 'Error');   
     }
    }

    public function view_single_post($user, $pid = null){
        $post = Post::getPostById($pid);
        if($post == false){
        return $this->showErrorMsg('No data fetched', 'Error');
        }else{
        // return $post;
        $ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));
         
        if(Auth::user()){
         $view = new PostViewers;
         $view->post_id = $pid;
         $view->uid = Auth::user()->id;
         $view->ip = $ip;
         $view->save();
        }else{
            $view = new PostViewers;
            $view->post_id = $pid;
            //$view->uid = Auth::user()->id;
            $view->ip = $ip;
            $view->save();
        }

        return $this->sendResponse($post, 'Post loaded.');
    }
    }

    public function referrer_network_downline($id){
        $user = User::where('id', $id)->get();
        $referred = User::where('referrer_id', $user[0]->id)->get();
        if(count($referred)){
            return $this->sendResponse($referred, 'User information shown succesfully.'); 
        }else{
            return $this->showErrorMsg('No user record fetched', 'Error');    
        }
    }


    public function referrer_network_downline_transaction($id){
        $user = User::where('id', $id)->get();
        $referred = User::where('referrer_id', $user[0]->id)->get();
        
        if(count($referred)){
            $data = array();
            foreach($referred as $referrer){
                $data['referrer_transaction'] = Transaction::where('uid', $referrer->id)->get();
            }
            return $this->sendResponse($data, 'User information shown succesfully.'); 
        }else{
            return $this->showErrorMsg('No user record fetched', 'Error');    
        }
    }

    //updateUserRecord api endpoint methosd
    public function update_user_record(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'required',
            'name' => 'nullable',
            'username' => 'nullable',
            'email' => 'required|email',
            'gender' => 'required',
            'gender_interest' => 'required',
            'age' => 'nullable',
            'country' => 'required',
            'state' => 'nullable',
            'city' => 'nullable',
            'country_code' => 'required',
            'phone' => 'required',
            'user_type' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
    //query user db table to check if email and phone alread exist    
    $checkUser = User::where('id', $request->input('uid'))->get();
    
    if(count($checkUser) > 0){
                //$success['token'] =  $user->createToken('MyApp')-> accessToken;
                $user = User::find($request->input('uid'));
                $user->name = $request->input('name');
                $user->username = $request->input('username');
                $user->phone = $request->input('phone');
                $user->email =  $request->input('email');
                $user->age =  $request->input('age');
                $user->country =  $request->input('country');
                $user->state =  $request->input('state');
                $user->city =  $request->input('city');
                $user->country_code =  $request->input('country_code');
                $user->gender = $request->input('gender');
                $user->gender_interest =  $request->input('gender_interest');
                $user->user_type = $request->input('user_type');
                $user->save();

                return $this->sendResponse($user, 'Record updated.');
                
    }else{
        return $this->showErrorMsg('Invalid user id', 'Error');
    }
    
    }


    public function update_profile_img(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'required',
            'img' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::where('id', $request->input('uid'))->get();

        if($user[0]->images){
            $getServerImg = json_decode($user[0]->images, true);

            $getServerImg[] = $request->input('img');
        }else{

            $getServerImg = array();

            $getServerImg[] = $request->input('img');

        }

        $update_user_img = User::where('id', $request->input('uid'))->update([
            'img_1' => $getServerImg[0],
            'images' => json_encode($getServerImg)
        ]);

    if($update_user_img){
     //Redirect::url('admin/edit_resort_img/'.$resort[0]->id);
     return $this->sendResponse($update_user_img, 'Image uploaded succesfully.');
    }
    
    }

    public function create_personal_data(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'nullable',
            'about' => 'nullable',
            'drinking' => 'nullable',
            'smoking' => 'nullable',
            'sexual_orientation' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'body_type' => 'nullable',
            'ethnicity' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user_data = UserData::where('uid', $request->input('uid'))->get();

        if(count($user_data) > 0){
         $update_data = UserData::find($user_data[0]->id);
         $update_data->about = $request->input('about');
         $update_data->drinking = $request->input('drinking');
         $update_data->smoking = $request->input('smoking');
         $update_data->sexual_orientation = $request->input('sexual_orientation');
         $update_data->height = $request->input('height');
         $update_data->weight = $request->input('weight');
         $update_data->body_type = $request->input('body_type');
         $update_data->ethnicity = $request->input('ethnicity');
         $update_data->save();
         return $this->sendResponse($update_data, 'Personal info updated.');
        }else{
            $insert_data = new UserData;
            $insert_data->uid = $request->input('uid');
            $insert_data->about = $request->input('about');
            $insert_data->drinking = $request->input('drinking');
            $insert_data->smoking = $request->input('smoking');
            $insert_data->sexual_orientation = $request->input('sexual_orientation');
            $insert_data->height = $request->input('height');
            $insert_data->weight = $request->input('weight');
            $insert_data->body_type = $request->input('body_type');
            $insert_data->ethnicity = $request->input('ethnicity');
            $insert_data->save();
            return $this->sendResponse($insert_data, 'Personal info created.');
        }

    }


    public function make_post(Request $request){

        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'required',
            'content' => 'nullable',
            'media' => 'nullable',
            'monetize' => 'nullable',
            'amount' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        if($request->hasFile('media')){
            //get filename with the extension
            $fileNameWithExt = $request->file('media')->getClientOriginalName();
            //get just filename
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $extension = $request->file('media')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore = str_replace(' ', '_', $filename).'_'.time().'.'.$extension;
            $path = $request->file('media')->storeAs('public/img/users/'.$request->input('uid').'/post', $fileNameToStore);
    
            }else{
            $fileNameToStore = "";
            }
    
        
            $dir = asset('storage/img/users/'.$request->input('uid').'/post');
            /********************************************
            if ($rooms[0]->images) {
    
                $getServerImg = json_decode($rooms[0]->images, true);
    
                $getServerImg[] = $dir.'/'.$fileNameToStore;
    
            } else {
    
                $getServerImg = array();
    
                $getServerImg[] = $dir.'/'.$fileNameToStore;
    
            }
    **************************************************/

        $getServerImg = array();

        //$feature = json_decode($request->input('feature'), true);
       /***********************************************
        foreach($request->input('media') as $media){
        $getServerImg[] = $media;
        }
        *********************************************/

        $getServerImg[] = $dir.'/'.$fileNameToStore;

        $post = new Post;
        $post->uid = $request->input('uid');
        $post->cnt = $request->input('content');
        $post->media_1 = $getServerImg[0];
        $post->media_files = json_encode($getServerImg);
        if($request->input('monetize') == 1){
        $post->monetize = 1;
        $post->amount = $request->input('amount');
        }
        $post->save();
    
        return $this->sendResponse($post, 'Post created succesfully.');

    }


    public function monetized_post_coin_payment(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'post_id' => 'required',
            'sender' => 'required',
            'recipient' => 'required',
            'coin_amount' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $user_wallet = UserWallet::where('uid', $request->input('sender'))->get();
        //recipient validation
        $recipient_id = $request->input('recipient');
        $recipient_wallet = UserWallet::where('uid', $recipient_id)->get();
        
        //$user_type_check = User::where('id', $recipient_id)->get();
        
        //$showMsg = FirstTimeMessage::getMessageByIds($request->input('sender'), $request->input('recipient'));
        
        if($user_wallet[0]->balance > $request->input('coin_amount')){
        //update sender wallet record
        $sender_new_balance = $user_wallet[0]->balance - $request->input('coin_amount');
        $update_sender_wallet = UserWallet::where('uid', $request->input('sender'))->update(['balance' => $sender_new_balance]);
        
        //update recipient wallet record
        $recipient_new_balance = $recipient_wallet[0]->balance + $request->input('coin_amount');
        $update_recipient_wallet = UserWallet::where('uid', $recipient_id)->update(['balance' => $recipient_new_balance]);

        $ip = preg_replace('#[^0-9.:]#', '', getenv('REMOTE_ADDR'));

        $post_view = new PostViewers;
        $post_view->post_id = $request->input('post_id');
        $post_view->uid = $request->input('sender');
        $post_view->ip = $ip;
        $post_view->paid = 1;
        $post_view->save();

        $transaction = new WalletTransaction;
        $transaction->sender = $request->input('sender');
        $transaction->recipient = $recipient_id;
        $transaction->coin_amount = $request->input('coin_amount');
        $transaction->description = "Payment for a monetized post";
        $transaction->save();

        return $this->sendResponse($post_view, 'Payment made succesfully.');
        }else{
            return $this->showErrorMsg("Insufficient fund: your balance is too low for this transaction.", "Error"); 
        }
    

    }

  
    public function create_date_request(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'required',
            'category' => 'required',
            'info' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $uid = $request->input('uid');
        $category = $request->input('category');
        $status = 0;
       
      $check = DateRequest::where(function($p) use($uid, $category, $status){
        $p->where('uid', '=', $uid);
        $p->where('category', '=', $category);
        $p->where('closed', '=', $status);
       })->get();
      
       if(count($check) > 0){
        return $this->showErrorMsg("There's an open date request for ".$category." created by you, you won't be able to create for this category until it is closed.", "Error");   
       }else{
      $day = 86400;
      //$months = round($day * 30);
      $exp_time = time() + 1 * $day;
      $insert = new DateRequest;
      $insert->uid = $request->input('uid');
      $insert->category = $request->input('category');
      $insert->info = $request->input('info');
      $insert->exp_time = $exp_time;
      $insert->save();
      return $this->sendResponse($insert, 'Date request created succesfully.');
       }

    }

    public function date_request_application(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'request_id' => 'required',
            'uid' => 'required',
            'poster_id' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }  
        
        $date_id = $request->input('request_id');
        $uid = $request->input('uid');
        $poster = $request->input('poster_id');
        $check_application = DateApplication::where(function($p) use($uid, $date_id){
            $p->where('request_id', '=', $date_id);
            $p->where('applicant_id', '=', $uid);
           })->get();

        if(count($check_application) > 0){
            return $this->showErrorMsg("You have applied for this date already.", "Error");   
        }else{
        $insert = new DateApplication;
        $insert->request_id = $date_id;
        $insert->applicant_id = $uid;
        $insert->poster_id = $poster;
        $insert->save();
        return $this->sendResponse($insert, 'Application sent.');
        }


    }


    public function date_application_response(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'application_id' => 'required',
            'uid' => 'required',
            //'poster_id' => 'required',   
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        } 
        
        $application = $request->input('application_id');
        $uid = $request->input('uid');
        
        $check_application = DateApplication::where(function($p) use($application, $uid){
            $p->where('id', '=', $application);
            $p->where('poster_id', '=', $uid);
            $p->where('accepted', '=', 0);
           })->get();

        if(count($check_application) > 0){

            $update_application = DateApplication::where('id', $application)->update(['accepted' => 1]);
            
            return $this->sendResponse($update_application, 'Application accepted.');
        }else{
            return $this->showErrorMsg("You do not have the permission to execute this task.", "Error");    
        }
        
    }
    

    public function show_all_open_date_request(){
      $open_request = DateRequest::getAllRecords();
     if($open_request == false){
        return $this->showErrorMsg("No data fetched", "Error");  
     }else{
        return $this->sendResponse($open_request, 'Date requests loaded.');
     }
    }

    public function show_my_date_applicant($uid){
      $show_application = DateApplication::getAllRecordsByPoster($uid);
      if($show_application == false){
        return $this->showErrorMsg("No data fetched", "Error"); 
      }else{
        return $this->sendResponse($show_application, 'Date request applications loaded.');
      }
    }


    public function verify_voucher(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
          'uid' => 'required',
          'voucher_code' => 'required',
      ]);
  
      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
       }
  
       $voucher_check = VoucherCode::getByBonusCode($request->input('voucher_code'));
       $voucher_count = VoucherVerification::where('bonus_code', $voucher_check[0]->bonus_code)->get();
       if($request->input('voucher_code') == $voucher_check[0]->bonus_code){
          if($voucher_check[0]->subscriber_range < count($voucher_count)){
              
              $uid = $request->input('uid');//uid input field
              $voucher_code = $request->input('voucher_code');//voucher_code input field
            
              $voucher_check = VoucherVerification::where(function($p) use($uid, $voucher_code){
                    $p->where('uid', '=', $uid);
                    $p->where('voucher_code', '=', $voucher_code);
               })->get();

          if(count($voucher_check) > 0){
            return $this->showErrorMsg("You cannot use code more than once", "Error"); 
          }else{
           $wallet_balance = UserWallet::where('uid', $uid)->get();
           $new_balance = $wallet_balance[0]->balance + $voucher_check[0]->coin_amount;
           $insert = new VoucherVerification;
           $insert->uid = $uid;
           $insert->bonus_code = $voucher_code;
           $insert->save();
           $update_wallet = UserWallet::where('uid', $uid)->update(['balance' => $new_balance]);
           return $this->sendResponse($insert, 'Voucher verified succesfully, check your coin balance to confirm');
          }   
          }else{
            return $this->showErrorMsg("We've reached the maximum number of subscribers for this voucher.", "Error"); 
          }
       }else{
        return $this->showErrorMsg('Invalid voucher code', 'Error'); 
       }
  
      }
      
      //make subscription method
      public function make_subscription(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
          'uid' => 'required',
          'module' => 'required',
          //'duration' => 'required',
      ]);
  
      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
       }

       $chech_sub = SubModule::where('module', $request->input('module'))->get();
       if(count($chech_sub) > 0){
        $wallet = UserWallet::where('uid', $request->input('uid'))->get();
        if($wallet[0]->balance > $chech_sub[0]->coin_amount){
        $subscribe = Subscription::where('uid', $request->input('uid'))->get();
        if(count($subscribe) > 0 ){
            
            $new_balance = $wallet[0]->balance - $chech_sub[0]->coin_amount;
            $day = 86400;//number seconds in a day
            $months = round($day * $chech_sub[0]->duration);
            $exp_time = time() + 1 *  $months;
            $update_subscribe = Subscription::where('uid', $request->input('uid'))->update(['module' => $request->input('module'),
                                                                                            'duration' => $chech_sub[0]->duration,
                                                                                            'sub_expire' => $exp_time,
                                                                                            'status' => 1]);
                                                                                      
                                                                                          
           
           $update_wallet =  UserWallet::where('uid', $request->input('uid'))->update(['balance' => $new_balance]);

            if($update_subscribe){
                return $this->sendResponse($update_subscribe, 'Subscription made succesfully.');   
            }
        }else{
            
        $new_balance = $wallet[0]->balance - $chech_sub[0]->coin_amount;
      $day = 86400;//number seconds in a day
      $months = round($day * $chech_sub[0]->duration);
      $exp_time = time() + 1 *  $months;

      $insert_sub = new Subscription;
      $insert_sub->uid = $request->input('uid');
      $insert_sub->module = $request->input('module');
      $insert_sub->duration = $chech_sub[0]->duration;
      $insert_sub->coin_amount = $chech_sub[0]->coin_amount;
      $insert_sub->sub_expire = $exp_time;
      $insert_sub->benefits = $chech_sub[0]->benefits;
      $insert_sub->status = 1;
      $insert_sub->save();
      if($request->input('module') == "Stealth" || $request->input('module') == "Stealth Mode" || $request->input('module') == "Private"){
        $user = User::where('id', $request->input('uid'))->update(['private' => 1]);
      } 
      
      $update_wallet =  UserWallet::where('uid', $request->input('uid'))->update(['balance' => $new_balance]);

      $check_user = User::where('id', $request->input('uid'))->get()->first();

      EmailController::userSubscription($check_user, $insert_sub);

      return $this->sendResponse($insert_sub, 'Subscription made succesfully.');
        }

    }else{
        return $this->showErrorMsg("Insufficient balance! Please buy coin to continue", "Error");   
    }

       }else{
        return $this->showErrorMsg("This module does not exit!", "Error"); 
       }
     
      }

    //stealth mode subscription method
    public function stealth_mode_subscription(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
          'uid' => 'required',
          'module' => 'required',
          'duration' => 'required',
      ]);
  
      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
       }

      $module = $request->input('module');
      $duration = $request->input('duration');

       $chech_sub = SubModule::where(function($p) use($module, $duration){
        $p->where('module', '=', $module);
        $p->orWhere('duration', '=', $duration);
       })->get();
       
       if(count($chech_sub) > 0){
        $wallet = UserWallet::where('uid', $request->input('uid'))->get();
        if($wallet[0]->balance > $chech_sub[0]->coin_amount){
        $subscribe = Subscription::where('uid', $request->input('uid'))->get();
        if(count($subscribe) > 0 ){
            
            $new_balance = $wallet[0]->balance - $chech_sub[0]->coin_amount;
            $day = 86400;//number seconds in a day
            $months = round($day * $chech_sub[0]->duration);
            $exp_time = time() + 1 *  $months;
            $update_subscribe = Subscription::where('uid', $request->input('uid'))->update(['module' => $request->input('module'),
                                                                                            'duration' => $chech_sub[0]->duration,
                                                                                            'coin_amount' => $chech_sub[0]->coin_amount,
                                                                                            'sub_expire' => $exp_time,
                                                                                            'benefits' => $chech_sub[0]->benefits,
                                                                                            'status' => 1]);

            $check_last_sub = Subscription::where('uid', $request->input('uid'))->get()->first();

                                                                                      
                                                                                      
                                                                                      
           
            $user = User::where('id', $request->input('uid'))->update(['private' => 1]);    
           
           $update_wallet =  UserWallet::where('uid', $request->input('uid'))->update(['balance' => $new_balance]);
             $check_user = User::where('id', $request->input('uid'))->get()->first();
            if($update_subscribe){
                EmailController::userSubscription($check_user, $check_last_sub);
                return $this->sendResponse($update_subscribe, 'Subscription made succesfully.');   
            }
        }else{
            
        $new_balance = $wallet[0]->balance - $chech_sub[0]->coin_amount;
      $day = 86400;//number seconds in a day
      $months = round($day * $chech_sub[0]->duration);
      $exp_time = time() + 1 *  $months;

      $insert_sub = new Subscription;
      $insert_sub->uid = $request->input('uid');
      $insert_sub->module = $request->input('module');
      $insert_sub->duration = $chech_sub[0]->duration;
      $insert_sub->coin_amount = $chech_sub[0]->coin_amount;
      $insert_sub->sub_expire = $exp_time;
      $insert_sub->benefits = $chech_sub[0]->benefits;
      $insert_sub->status = 1;
      $insert_sub->save();
      
      $user = User::where('id', $request->input('uid'))->update(['private' => 1]);
       
      
      $update_wallet =  UserWallet::where('uid', $request->input('uid'))->update(['balance' => $new_balance]);

      $check_user = User::where('id', $request->input('uid'))->get()->first();

      EmailController::userSubscription($check_user, $insert_sub);
      return $this->sendResponse($insert_sub, 'Subscription made succesfully.');
        }

    }else{
        return $this->showErrorMsg("Insufficient balance! Please buy coin to continue", "Error");   
    }

       }else{
        return $this->showErrorMsg("This module does not exit!", "Error"); 
       }

    
    }

      

    public function show_my_subscription($id){
      $subs = Subscription::where('uid', $id)->get(); 
      if(count($subs) > 0){
        return $this->sendResponse($subs, 'Subscription data loaded.');
      }else{
        return $this->showErrorMsg("No record fetched!", "Error");   
      }

    }

    public function buy_coin(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
          'uid' => 'required',
          'amount' => 'required',
          'payment_gateway' => 'required',
          ''
      ]);
  
      if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
       }



    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
