<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use App\Http\Controllers\EmailController;

class CroneJobController extends Controller
{
    /**
     * Display a l 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function subscription_checker(){
        $subscriptions = Subscription::all();
        $day = 86400;//number seconds in a day
        $days = round($day * 5);
        $exp_time = time() + 1 *  $days;
        foreach($subscriptions as $sub){
            if($sub->sub_expire == $exp_time || $sub->sub_expire < $exp_time){
                $user = User::where('id', $sub->uid)->get()->first();
                EmailController::subscriptionExpirationChecker($user, $sub);
            }else if(time() > $sub->sub_expire){
                $user = User::where('id', $sub->uid)->get()->first();
                EmailController::subscriptionExpiredChecker($user, $sub);
            }
        }
    }
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
