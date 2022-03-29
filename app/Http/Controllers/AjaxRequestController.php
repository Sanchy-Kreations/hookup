<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerification;
use App\Models\Post;
use App\Models\UserData;
use App\Models\UserWallet;
use App\Models\Subscription;
use App\Models\DateRequest;
use App\Models\DateApplication;
use App\Models\AdminWalletSettings;
use App\Models\VoucherVerification;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AjaxRequestController extends BaseController
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

  
    public function user_search(Request $request){
      $input = $request->all();
      $validator = Validator::make($input, [
        'search_input' => 'required',
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());       
  }
  $param = $request->input('search_input');
  //$sub = 1;
  $users = User::where(function($p) use($param){
       $p->where('username', 'LIKE', '%'.$param.'%');
       //$p->orWhere('name', 'LIKE', '%'.$param.'%');
       $p->where('private', '=', 0);
  })->get();

  if(count($users) > 0){
  //return api data in an array
  return $this->sendResponse($users, 'User information shown succesfully.');
  }else{
    return $this->showErrorMsg('No user record fetched', 'Error');
  }    
}


    


    public function load_index_subescorts(Request $request){
      $input = $request->all();
      $validator = Validator::make($input, [
        'action' => 'required',
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());       
  }
  $user_type = "escort";
  $sub = 1;
  $users = User::where(function($p) use($user_type, $sub){
       $p->where('user_type', '=', $user_type);
       $p->where('subscribed', '=', $sub);
  })->inRandomOrder()->limit(3)->get()->toArray();

  //return api data in an array
  return $this->sendResponse($users, 'Subscribers loaded succesfully.');
    }


    public function load_index_page_escorts(Request $request){
        $input = $request->all();

        $validator = Validator::make($input, [
            'record_per_page' => 'required',
            'start' => 'required',
            'action' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
          
        $data = '';
        $img = '';
        $verify_img = '';
        $status = '';
        $dataArr = array();
        $users = User::where('user_type', 'escort')->orderBy('id', 'desc')->limit($request->input('record_per_page'),$request->input('start'))->get()->toArray();
        
        
         
        /********************************************************** 
        foreach($users as $user){
            $data .= "
            <li class='ajax_block_product col-xs-6 col-sm-6 col-md-4 last-item-of-tablet-line last-item-of-mobile-line'>
            <div class='product-container' itemscope='' itemtype=''>
              <div class='left-block'>
                <div class='product-image-container'>
                                                
    
      <div class='tmproductlistgallery rollover'>
        <div class='tmproductlistgallery-images'>
                          
        <a class='product_img_link cover-image' href='".url('escort/'.$user->id)."' title='".$user->name."' itemprop='url'>
        <img class='img-responsive' src='".asset('storage/img/users/'.$user->id.'/profile/'.$user->img)."' title='".$user->name."'>
      </a>
      <a class='product_img_link rollover-hover' href='".url('escort/'.$user->id)."' title='".$user->name."' itemprop='url'>
      <img class='img-responsive' src='".asset('storage/img/users/'.$user->id.'/profile/'.$user->verify_img)."' title='".$user->name."'>
    </a>
                          
                    </div>
          </div>
    
    
          <a class='sale-box' href='".url('escort/'.$user->id)."'>
          <span class='sale-label ".$user->verified."'>".$user->verified."</span>
        </a>
                 </div>
                            
              </div>
              <div class='right-block'>
    
                                          
                
                <h5 itemprop='name'>
                <a class='product-name' href='".url('escort/'.$user->id)."' title='".$user->name."' itemprop='url'>
                    <span class='list-name'>".$user->name."</span>
                    <span class='grid-name'>".$user->name."</span>
                  </a>
                </h5>
                              
                    
            
                              
                            
                
              </div>
            </div><!-- .product-container> -->
          </li>";
                    
                       
        }
        *********************************************************/
        return $this->sendResponse($users, 'Escort data loaded succesfully.');
        
    }

    public function load_male_escorts_page(Request $request){
     
      $input = $request->all();

      $validator = Validator::make($input, [
        'record_per_page' => 'required',
        'start' => 'required',
        'action' => 'required',
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());       
  }
  $user_type = "escort";
  $sub = 'Male';
  $users = User::where(function($p) use($user_type, $sub){
       $p->where('user_type', '=', $user_type);
       $p->where('gender', '=', $sub);
  })->inRandomOrder()->limit($request->input('record_per_page'))->offset(($request->input('start') - 1) * $request->input('record_per_page'))->get()->toArray();

  //return api data in an array
  return $this->sendResponse($users, 'Male escorts loaded succesfully.');
     
    }


    public function load_female_escorts_page(Request $request){
     
      $input = $request->all();

      $validator = Validator::make($input, [
        'record_per_page' => 'required',
        'start' => 'required',
        'action' => 'required',
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());       
  }
  $user_type = "escort";
  $sub = 'Female';
  $users = User::where(function($p) use($user_type, $sub){
       $p->where('user_type', '=', $user_type);
       $p->where('gender', '=', $sub);
  })->inRandomOrder()->limit($request->input('record_per_page'))->offset(($request->input('start') - 1) * $request->input('record_per_page'))->get()->toArray();

  //return api data in an array
  return $this->sendResponse($users, 'Female escorts loaded succesfully.');
     
    }
    
    public function load_escorts_on_travel_page(Request $request){
     
      $input = $request->all();

      $validator = Validator::make($input, [
        'record_per_page' => 'required',
        'start' => 'required',
        'action' => 'required',
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());       
  }
  $user_type = "escort";
  $sub = 1;
  $users = User::where(function($p) use($user_type, $sub){
       $p->where('user_type', '=', $user_type);
       $p->where('on_travel', '=', $sub);
  })->inRandomOrder()->limit($request->input('record_per_page'))->offset(($request->input('start') - 1) * $request->input('record_per_page'))->get()->toArray();

  //return api data in an array
  return $this->sendResponse($users, 'Escorts on travel loaded succesfully.');
     
    }


    public function load_verified_escorts_page(Request $request){
     
      $input = $request->all();

      $validator = Validator::make($input, [
        'record_per_page' => 'required',
        'start' => 'required',
        'action' => 'required',
    ]);

    if($validator->fails()){
      return $this->sendError('Validation Error.', $validator->errors());       
  }
  $user_type = "escort";
  $sub = 'verified';
  $users = User::where(function($p) use($user_type, $sub){
       $p->where('user_type', '=', $user_type);
       $p->where('verified', '=', $sub);
  })->inRandomOrder()->limit($request->input('record_per_page'))->offset(($request->input('start') - 1) * $request->input('record_per_page'))->get()->toArray();

  //return api data in an array
  return $this->sendResponse($users, 'Escorts on travel loaded succesfully.');
     
    }

    public function unusedFunction(){
        $user = User::where('user-type', 'escort')->where(function($p){

        })->get();
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
