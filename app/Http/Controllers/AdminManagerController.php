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
use App\Models\AdminWalletSettings;
use App\Models\SubModule;
use App\Models\VoucherCode;
use App\Models\AdminPrivilege;
use App\Models\SupportTicket;
use App\Models\adminCoinRate;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DateTimeController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;


class AdminManagerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create_wallet_settings(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'coin_value' => 'nullable',
            'currency' => 'nullable',
            'free_signup_coin' => 'nullable',
            'first_time_chat_coin_cost' => 'nullable',
            'celebrity_first_time_chat_coin_cost' => 'nullable',
            'referrer_percent' => 'nullable',
            'admin_commision_percent' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

    $wallet_settings = AdminWalletSettings::all();

    if(count($wallet_settings) > 0){
        $wallet_settings_update = AdminWalletSettings::find($wallet_settings[0]->id);
        $wallet_settings_update->coin_currency_value = $request->input('coin_value');
        $wallet_settings_update->currency = $request->input('currency');
        $wallet_settings_update->free_signup_coin = $request->input('free_signup_coin');
        $wallet_settings_update->first_time_chat_coin_cost = $request->input('first_time_chat_coin_cost');
        $wallet_settings_update->celebrity_first_time_chat_coin_cost = $request->input('celebrity_first_time_chat_coin_cost');
        $wallet_settings_update->referrer_percent = $request->input('referrer_percent');
        $wallet_settings_update->admin_commision_percent = $request->input('admin_commision_percent');
        $wallet_settings_update->save();
        
        return $this->sendResponse($wallet_settings_update, 'Admin wallet settings record updated.');
    }else{
        $wallet_settings_insert = new AdminWalletSettings;
        $wallet_settings_insert->coin_currency_value = $request->input('coin_value');
        $wallet_settings_insert->currency = $request->input('currency');
        $wallet_settings_insert->free_signup_coin = $request->input('free_signup_coin');
        $wallet_settings_insert->first_time_chat_coin_cost = $request->input('first_time_chat_coin_cost');
        $wallet_settings_insert->celebrity_first_time_chat_coin_cost = $request->input('celebrity_first_time_chat_coin_cost');
        $wallet_settings_insert->referrer_percent = $request->input('referrer_percent');
        $wallet_settings_insert->admin_commision_percent = $request->input('admin_commision_percent');
        $wallet_settings_insert->save();

        return $this->sendResponse($wallet_settings_insert, 'Admin wallet settings record inserted.');
    }


    }




    public function show_admin_wallet_settings(){
        $data = AdminWalletSettings::all();
        if(count($data) > 0){
            return $this->sendResponse($data, 'Admin wallet settings record fetched.');
        }else{
            return $this->showErrorMsg('No record available', 'Error');
        }
    }

    public function create_subscription_module(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'module' => 'required',
            'duration' => 'required',
            'coin_amount' => 'required',
            'type' => 'nullable',
            'benefits' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        
        $chech_sub = SubModule::where('module', $request->input('module'))->get();

        if(count($chech_sub) > 0){
            return $this->showErrorMsg($request->input('module').' already exists in the table', 'Error');
        }else{
        $insert_module = new  SubModule;
        $insert_module->module = $request->input('module');
        $insert_module->duration = $request->input('duration');
        $insert_module->coin_amount = $request->input('coin_amount');
        $insert_module->module_type = $request->input('type');
        $insert_module->benefits = $request->input('benefits');
        $insert_module->save();
        return $this->sendResponse($insert_module, 'Subscription module created succesfully.');
        }


    }

    public function show_all_subscription_modules(){
        $chech_sub = SubModule::getAllSubscription();

        if($chech_sub == false){
            return $this->showErrorMsg('No record fetched', 'Error');
            
        }else{
            return $this->sendResponse($chech_sub, 'Subscription module data loaded.'); 
        }
    }


    public function show_subscription_by_module($module){
        $chech_sub = SubModule::getBySubscriptionModule($module);
        if($chech_sub == false){
            return $this->showErrorMsg('No record fetched', 'Error');
            
        }else{
            return $this->sendResponse($chech_sub, 'Subscription module data loaded.'); 
        }
    }

    public function delete_sub_module(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'sub_module_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $chech_sub = SubModule::deleteSubModule($request->input('sub_module_id'));
        if($chech_sub == false){
            return $this->showErrorMsg('Could not delete subscription module', 'Error');
            
        }else{
            return $this->sendResponse($chech_sub, 'Subscription module deleted.'); 
        }
        
    }

    public function show_all_users_subscriptions(){
        $subscription = Subscription::getAllSubscription();
        if($subscription == false){
            return $this->showErrorMsg('Could not fetch data', 'Error');
            
        }else{
            return $this->sendResponse($subscription, 'Subscription module data loaded.'); 
        }
    }



    public function create_bonus_voucher(){
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'nullable',
            'promo_code' => 'nullable',
            //'bonus_code' => 'required',
            'coin_amount' => 'required',
            'subscriber_range' => 'nullable',
            'duration' => 'required',
            //'type' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        
        
        $day = 86400;//number seconds in a day
        $months = round($day * $request->input('duration'));
        $exp_time = time() + 1 *  $months;

        $voucher = new VoucherCode;
        $voucher->title = $request->input('title');
        $voucher->promo_code = $request->input('promo_code');
        $voucher->bonus_code = SettingsController::randomStrgs(3).SettingsController::randomStrgs(3);
        $voucher->coin_amount = $request->input('coin_amount');
        $voucher->subscriber_range = $request->input('subscriber_range');
        $voucher->exp_time = $exp_time;
        $voucher->save();

        return $this->sendResponse($voucher, 'Voucher created succesfully.');

    }

    public function show_all_voucher(){
        $voucher = VoucherCode::getAllVoucher();
        if($voucher == false){
            return $this->showErrorMsg('No data fetched', 'Error');
        }else{
            return $this->sendResponse($voucher, 'Voucher loaded succesfully.');
        }
    }

  
    public function delete_voucher(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'voucher_id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $voucher = VoucherCode::deleteVoucher($request->input('voucher_id'));
        if($voucher == false){
            return $this->showErrorMsg('Could not delete voucher succesfully', 'Error');
        }else{
            return $this->sendResponse($voucher, 'Voucher deleted.');
        }
    }

    public function add_admin_privilege(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'required',
            'module' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

      $user = User::where('id', $request->input('uid'))->where('user_type', 'admin')->get();
      if(count($user) > 0){
       $privilege_check = AdminPrivilege::where('uid', $user[0]->id)->get();
       if(count($privilege_check) > 0){
        if($privilege_check[0]->module){
            $getModule = json_decode($privilege_check[0]->module, true);

        foreach($request->input('module') as $module){
            $getModule[] = $module;
            }

        }else{

        $getModule = array();

        foreach($request->input('module') as $module){
            $getModule[] = $module;
            } 

        }
        

        $update_admin_module = AdminPrivilege::where('uid', $user[0]->id)->update([
            'module' => json_encode($getModule)
        ]);
    
        if($update_admin_module){
            return $this->sendResponse($update_admin_module, $getModule." added to ".$user[0]->name."'s privilege");
           }

       }else{

        $getModule = array();

        foreach($request->input('module') as $module){
            $getModule[] = $module;
            } 
       
       $privilege = new AdminPrivilege;
       $privilege->uid = $user[0]->id;
       $privilege->module = json_encode($getModule);
       $privilege->save();
       return $this->sendResponse($privilege, $getModule." added to ".$user[0]->name."'s privilege.");
       }

    }else{
        return $this->showErrorMsg('User does not belong here!', 'Error');  
      }

    }


    public function remove_admin_privilege(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'required',
            'key_num' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }


        $module = AdminPrivilege::where('uid', $request->input('uid'))->get();

    
         $getModule = json_decode($module[0]->module, true);



    unset($getModule[$request->input('key_num')]);//unset object number of the array


    //update resort_features table
    $update = AdminPrivilege::where('uid', $request->input('uid'))->update([

        'module' => json_encode($getModule)

    ]);



    if ($update) {

        return $this->sendResponse($update, 'Privilege removed.');

    }


    }



    public function create_currency_coin_rate(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'currency' => 'required',
            'rate' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $check_rate = adminCoinRate::where('currency', $request->input('currency'))->get();
        if(count($check_rate) > 0){
            $update_rate = adminCoinRate::where('currency', $request->input('currency'))->update(['rate' => $request->input('rate')]);
            return $this->sendResponse($update_rate, "rate for ".$request->input('currency')." is updated.");
        }else{
         $new_rate = new adminCoinRate;
         $new_rate->country = $request->input('currency');
         $new_rate->rate = $request->input('rate');
         $new_rate->save();
         return $this->sendResponse($new_rate, "New rate created succesfully");
        }

    }


    public function show_currency_coin_rate(){
        $check_rate = adminCoinRate::orderBy('id', 'desc')->get();
        if(count($check_rate) > 0){
            return $this->sendResponse($check_rate, "Coin rate loaded");
        }else{
            return $this->showErrorMsg('No data fetched!', 'Error');     
        }
    }

    public function show_coin_rate_by_id($id){
        $check_rate = adminCoinRate::where('id', $id)->get();
        if(count($check_rate) > 0){
            return $this->sendResponse($check_rate, "Coin rate loaded");
        }else{
            return $this->showErrorMsg('No data fetched!', 'Error');     
        }
    }

    public function show_all_user_records(){
        $users = User::getAllUserRecord();
        if(count($users) > 0){
            return $this->sendResponse($users, "Users records loaded");
        }else{
            return $this->showErrorMsg('No data fetched!', 'Error');    
        }
    }




    public function index()
    {
        //
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
