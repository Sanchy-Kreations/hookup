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
use App\Models\Message;
use App\Models\FirstTimeMessage;
use App\Models\AdminWalletSettings;
use App\Models\AdminFundWallet;
use App\Models\Transaction;
use App\Models\Notification;
use App\Models\Offer;
use App\Models\SupportTicket;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;

class MessagesController extends BaseController
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

    public function show_messages($sender, $recipient = null){
        $showMsg = Message::getAllByIds($sender, $recipient);
        if($showMsg == false){
            return $this->showErrorMsg("No message in this inbox yet", "Error");  
        }else{
            return $this->sendResponse($showMsg, 'Message loaded.');
        }
    }

    public function send_message(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'sender' => 'required',
            'recipient' => 'required',
            'support_id' => 'nullable',
            'message' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
      $checkMsg = Message::checkMsg($request->input('sender'), $request->input('recipient'));
      if($checkMsg == "message"){
      $support = SupportTicket::where('id', $request->input('support_id'))->get();
      if(count($support) > 0){
         if($support[0]->status == "Open"){
            $message = new Message;
            $message->support_id = $support[0]->id;
            $message->sender_id = $request->input('sender');
            $message->recipient_id = $request->input('recipient');
            $message->msg = $request->input('message');
            $message->save();
         }else if($support[0]->status == "Closed"){
            return $this->showErrorMsg("This support ticket is closed!", "Error"); 
         }else if($support[0]->status == "Pending"){
            return $this->showErrorMsg("This support is not open for conversation yet!", "Error"); 
         }
      }else{
      $message = new Message;
      $message->sender_id = $request->input('sender');
      $message->recipient_id = $request->input('recipient');
      $message->msg = $request->input('message');
      $message->save();
      }
      $showMsg = Message::getAllByIds($message->sender_id, $message->recipient_id);
      return $this->sendResponse($showMsg, 'Message loaded.');
      }else if($checkMsg == "first_time"){
      $showMsg = FirstTimeMessage::getMessageByIds($request->input('sender'), $request->input('recipient'));
      return $this->showErrorMsg("Pay ".$showMsg['cost']." coins to continue messaging", "Error");  
      }else if($checkMsg == false){
      $adminWallet = AdminWalletSettings::all();
      $new = new FirstTimeMessage;
      $new->sender_id = $request->input('sender');
      $new->recipient_id = $request->input('recipient');
      $new->msg = $request->input('message');
      $new->cost = $adminWallet[0]->first_time_chat_coin_cost;
      $new->save();
      $showMsg = Message::getAllByIds($new->sender_id, $new->recipient_id);
      return $this->sendResponse($showMsg, 'First time message loaded.');
    }

    }

    public function make_payment(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'sender' => 'required',
            'recipient' => 'required',
            //'message' => 'nullable',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $user_wallet = UserWallet::where('uid', $request->input('sender'))->get();
        //recipient validation
        $recipient_id = $request->input('recipient');
        
        $user_type_check = User::where('id', $recipient_id)->get();
        $adminWallet = AdminWalletSettings::all();
        //$showMsg = FirstTimeMessage::getMessageByIds($request->input('sender'), $request->input('recipient'));
        if($user_type_check[0]->user_type == "celebrity"){
            if($user_wallet[0]->balance > $adminWallet[0]->celebrity_first_time_chat_coin_cost){
                $new_balance = $user_wallet[0]->balance - $adminWallet[0]->celebrity_first_time_chat_coin_cost;
                $update_user_wallet = UserWallet::where('uid', $request->input('sender'))->update(['balance' => $new_balance]);
                $update_msg = FirstTimeMessage::updateRecord($request->input('sender'), $request->input('recipient'));
                $adminWallet = new AdminFundWallet;
                $adminWallet->amount = $adminWallet[0]->celebrity_first_time_chat_coin_cost;
                $adminWallet->description = "First Time Message Coin Cost Payment";
                $adminWallet->save();
                $message = new Message;
                $message->sender_id = $request->input('sender');
                $message->recipient_id = $request->input('recipient');
                $message->msg = "Hi ".$user_type_check[0]->name;
                $message->save();
                $showMsg = Message::getAllByIds($message->sender_id, $message->recipient_id);
                return $this->sendResponse($showMsg, 'First time message loaded.');
                }else{
                    return $this->showErrorMsg("Insufficient fund: your balance is too low for this transaction.", "Error"); 
                }
        }else{
        if($user_wallet[0]->balance > $adminWallet[0]->first_time_chat_coin_cost){
        $new_balance = $user_wallet[0]->balance - $adminWallet[0]->first_time_chat_coin_cost;
        $update_user_wallet = UserWallet::where('uid', $request->input('sender'))->update(['balance' => $new_balance]);
        $update_msg = FirstTimeMessage::updateRecord($request->input('sender'), $request->input('recipient'));
        $adminWallet = new AdminFundWallet;
        $adminWallet->amount = $adminWallet[0]->first_time_chat_coin_cost;
        $adminWallet->description = "First Time Message Coin Cost Payment";
        $adminWallet->save();
        $message = new Message;
        $message->sender_id = $request->input('sender');
        $message->recipient_id = $request->input('recipient');
        $message->msg = "Hi ".$user_type_check[0]->name;
        $message->save();
        $showMsg = Message::getAllByIds($message->sender_id, $message->recipient_id);
        return $this->sendResponse($showMsg, 'First time message loaded.');
        }else{
            return $this->showErrorMsg("Insufficient fund: your balance is too low for this transaction.", "Error"); 
        }
    }

    }


    public function make_payment_offer_request(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'sender' => 'required',
            'recipient' => 'required',
            'amount' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $offer = new Offer;
        $offer->sender_id = $request->input('sender');
        $offer->recipient_id = $request->input('recipient');
        $offer->amount = $request->input('amount');
        $offer->save();

        return $this->sendResponse($offer, 'Offer made succesfully.');

    }


    public function offer_response(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'offer_id' => 'required',
            'sender' => 'required',
            'recipient' => 'required',
            'response' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $offer_id = $request->input('offer_id');
        $response = $request->input('response');
        $sender = $request->input('sender');
        $recipient = $request->input('recipient');
        $checkOffer = Offer::where(function($p) use($offer_id, $sender, $recipient){
            $p->where('id', '=', $offer_id);
            $p->where('sender_id', '=', $recipient);
            $p->where('recipient_id', '=', $sender);
            $p->where('paid', '=', 0);
           })->get();
        
        $user_wallet = UserWallet::where('uid', $request->input('sender'))->get();

       if($response == "Accepted"){
        if(count($checkOffer) > 0){
       if($user_wallet[0]->balance > $checkOffer[0]->amount){
        $new_balance = $user_wallet[0]->balance - $checkOffer[0]->amount;
        $update_user_wallet = UserWallet::where('uid', $request->input('sender'))->update(['balance' => $new_balance]);
        $update_offer = Offer::where('id', $checkOffer[0]->id)->update(['response' => $response, 'paid' => 1]);
        return $this->sendResponse($update_offer, 'Offer accepted.');
        }else{
        return $this->showErrorMsg("Insufficient fund: your balance is too low for this transaction.", "Error");  
       }
    }else{
        return $this->showErrorMsg("Invalid Id collection: Either offer_id, sender_id or recipient_id", "Error");    
    }
       }else if("Declined"){
        $update_offer = Offer::where('id', $checkOffer[0]->id)->update(['response' => $response]);
        return $this->sendResponse($update_offer, 'Offer declined.');   
    }
    
    }

    public function sender_confirm_offer(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'offer_id' => 'required',
            'sender' => 'required',
            'recipient' => 'required',
            'response' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $offer_id = $request->input('offer_id');
        $response = $request->input('response');
        $sender = $request->input('sender');
        $recipient = $request->input('recipient');
        $checkOffer = Offer::where(function($p) use($offer_id, $sender, $recipient){
            $p->where('id', '=', $offer_id);
            $p->where('sender_id', '=', $sender);
            $p->where('recipient_id', '=', $recipient);
            $p->where('paid', '=', 1);
           })->get();

        if($response == "Accepted"){
        if(count($checkOffer) > 0){
            $update_offer = Offer::where('id', $checkOffer[0]->id)->update(['sender_confirmed' => $response]);
            return $this->sendResponse($update_offer, 'Offer payment confirmed: ready to meet-up.');
        }else{
            return $this->showErrorMsg("Invalid Id collection: Either offer_id, sender_id or recipient_id", "Error");    
        }
        }else if("Declined"){
            if(count($checkOffer) > 0){
            $user_wallet = UserWallet::where('uid', $request->input('recipient'))->get(); 
            $new_balance = $user_wallet[0]->balance + $checkOffer[0]->amount;
            $update_user_wallet = UserWallet::where('uid', $request->input('recipient'))->update(['balance' => $new_balance]);
            $update_offer = Offer::where('id', $checkOffer[0]->id)->update(['sender_confirmed' => $response]);
            return $this->sendResponse($update_offer, 'Offer payment confirmation declined: Coin has been refunded');
          }else{
            return $this->showErrorMsg("Invalid Id collection: Either offer_id, sender_id or recipient_id", "Error");      
            }
        }
          
    }

    public function recipient_apporve_offer_payment_service(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'offer_id' => 'required',
            'sender' => 'required',
            'recipient' => 'required',
            'response' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $offer_id = $request->input('offer_id');
        $response = $request->input('response');
        $sender = $request->input('sender');
        $recipient = $request->input('recipient');
        $checkOffer = Offer::where(function($p) use($offer_id, $sender, $recipient){
            $p->where('id', '=', $offer_id);
            $p->where('sender_id', '=', $recipient);
            $p->where('recipient_id', '=', $sender);
            $p->where('paid', '=', 1);
            $p->where('sender_confirmed', '=', 'Accepted');
           })->get();
           
           if($response == "Confirmed"){
           if(count($checkOffer) > 0){
            $adminWallet = AdminWalletSettings::all();
            //$user_wallet = UserWallet::where('uid', $request->input('recipient'))->get(); 
            $commision = $adminWallet[0]->admin_commision_percent;
            $admin_percent = $checkOffer[0]->amount / 100 * $commision;
            $new_balance = $checkOffer[0]->amount + $admin_percent;
            
            $adminWalletInsert = new AdminFundWallet;
            $adminWalletInsert->amount = $admin_percent;
            $adminWalletInsert->description = "Offer payment commision";
            $adminWalletInsert->save();
            
            $update_user_wallet = UserWallet::where('uid', $request->input('recipient'))->update(['balance' => $new_balance]);
            $update_offer = Offer::where('id', $checkOffer[0]->id)->update(['recipient_confirmed' => 1]);
            return $this->sendResponse($update_offer, 'Offer payment service approved');
           }

        }
    }

    public function my_payment_offer_list($id){
        $offer = Offer::getByIds($id);
        if($offer == false){
            return $this->showErrorMsg("No payment offer record", "Error"); 
        }else{
            return $this->sendResponse($offer, 'Payment offer record loaded'); 
        }
    }


    public function send_support_ticket(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'uid' => 'required',
            'support_ticket' => 'required',
            'subject' => 'required',
            'message' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $sender = $request->input('uid');
        $ticket = $request->input('support_ticket');
        $subject = $request->input('subject');

        $support = new SupportTicket;
        $support->sender = $sender;
        $support->support_ticket = $ticket;
        $support->subject = $subject;
        $support->message = $request->input('message');
        $support->save();

        return $this->sendResponse($support, 'Support sent succesfully.'); 

    }


    public function reply_support_ticket(Request $request){
        $input = $request->all();
        $validator = Validator::make($input, [
            'sender' => 'required',
            'support_id' => 'required',
            //'subject' => 'required',
            'message' => 'required',
            
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $support = SupportTicket::where('id', $request->input('support_id'))->get();
      if(count($support) > 0){
      $message = new Message;
      $message->support_id = $support[0]->id;
      $message->sender_id = $request->input('sender');
      $message->recipient_id = $support[0]->sender;
      $message->msg = $request->input('message');
      $message->save();
      return $this->sendResponse($support, 'Support replied succesfully.'); 
      }else{
        return $this->showErrorMsg("This support ticket does not exit!", "Error");      
      }

    }

 public function close_support_ticket(Request $request){
    $input = $request->all();
    $validator = Validator::make($input, [
        //'sender' => 'required',
        'support_id' => 'required',
        //'subject' => 'required',
        
    ]);

    if($validator->fails()){
        return $this->sendError('Validation Error.', $validator->errors());       
    }

    $support = SupportTicket::where('id', $request->input('support_id'))->get();

    if(count($support) > 0){
     $update_support = SupportTicket::where('id', $support[0]->id)->update(['status' => 'Closed']);
     return $this->sendResponse($support, 'Support ticket closed.'); 
    }else{
      return $this->showErrorMsg("This support ticket does not exit!", "Error");      
    }

 } 


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
