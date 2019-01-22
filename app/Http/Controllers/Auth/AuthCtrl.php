<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Bidder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthCtrl extends Controller 
{ 

    public function authentication(Request $request){
       
      $this->validate($request, [
        'email' => 'required', 
        'password' => 'required'
      ]);
          
      $apikey = base64_encode(str_random(30));
      $hasher = app()->make('hash');
      $user = User::where('email', $request->input('email'))->first();
           
      
      if(count($user) > 0) {
       
        if($hasher->check( $request->input('password'),$user->password)) {
 
            User::where('email', $request->input('email'))
                ->update(['api_token' => $apikey]);

            $roles = $user->getRoleNames();
            $role = $roles[0];

            $bidder = User::where('email', $request->input('email'))
                ->join('bidders', 'bidders.id', '=', 'users.id')
                ->first();
            
              return
                response()->json([
                    'status' => 'success',
                    'id' => $bidder->id,
                    'email' => $bidder->email,
                    'FirstName' => $bidder->first_name,
                    'LastName' =>  $bidder->last_name,
                    'role' => $role,
                    'api_token' => $apikey
                  ]);

        }
        else {
          return 
            response()->json([
              'status' => 'error', 
              'message' => "user password is wrong"],401);
        }
      }
      else{
        return 
          response()->json([
            'status' => 'error',
            'message' => "user not found"],401);	
      }

  }

  public function logout(Request $request, $id) {

    $user = User::where('id', $id)->first();

    if(count($user)>0){
      User::where('id', $id)->update(['api_token' => ""]);
        return response()->json(['status' => 'success','logout' => "true"]);
    }
    else {
      return response()->json(['status' => 'error','message' => "user not found"],401);	
    } 

  }

  public function changePassword(Request $request){

    $this->validate($request, [
      'email' => 'required',
      'oldpassword' => 'required',
      'newpassword' => 'required'
    ]);

    $user = Auth::where('email', $request->input('email'))->first();

    if(count($user)>0) {
      if(base64_encode($request->input('oldpassword'))==$user->password){
        Auth::where('email', $request->input('email'))
            ->update(['password' => base64_encode($request->input('newpassword'))],200);
        return 
          response()->json(['status' => 'success','message' => "password change successful"]);
      }
      else{
        return 
        response()->json(['status' => 'error','message' => "user password is wrong"],401);
      }
    } else{
      return response()->json(['status' => 'error','message' => "user not found"],401);	
    }
  }

  public function forgotPassword(Request $request, $email){
    
    $user = UserInfo::with(['Auth'])->where('email', $email)->orwhere('email', $email)->first();

    if(count($user)>0){
      $send = new sendMails();
      $result = $send->send($user->email, base64_decode($user->Auth->password));
      
      if($result=="0"){
        return response()->json([
          'status' => 'success',
          'message' => "Password sent to your mail"],200);
      }
      else{
        return
          response()->json([
            'status' => 'error',
            'message' => "something went wrong"],401);
      }
    }
    else{
      return response()->json([
          'status' => 'error',
          'message' => "user not found"],401);	
    }
  }
  
}
