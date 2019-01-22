<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Bidder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;

class UserRegistrationCtrl extends Controller
{
  /*
  **
  * Register new user
  *
  * @param $request Request
  */
  public function register(Request $request)
  {
      $this->validate($request, [
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'dob' => 'required',
        'role' => 'required:roles'
      ]);

      $hasher = app()->make('hash');
      $first_name = $request->input('firstName');
      $last_name = $request->input('lastName');
      $dob = $request->input('dob');
      $email = $request->input('email');
      $password = $hasher->make($request->input('password'));
      $apikey = base64_encode(str_random(30));

      $user = User::create([
        'email' => $email,
        'password' => $password,
        'api_token' => $apikey
      ]);
      
      switch ( $request->input('role')) {

        case 'user':
            $user->assignRole(Role::findByName('user', 'api'));
          break;

        case 'bidder':
            $user->assignRole(Role::findByName('bidder', 'api'));
          break;

        case 'super-admin':
            $user->assignRole(Role::findByName('super-admin', 'api'));
          break;
        
        default:
          # code...
          break;
      }

      $bidder = new Bidder();
      $bidder->fill([
        'first_name' => $first_name,
        'last_name' => $last_name,
        'date_of_birth' => $dob,
        'user_id' => $user->id
      ]);

      $user->bidder()->save($bidder);
      
      $roles = $user->getRoleNames();
      $role = $roles[0];

      return response()->json([
        'status' => 'success',
        'id' => $user->id,
        'email' => $user->email,
        'FirstName' => $bidder->first_name,
        'LastName' =>  $bidder->last_name,
        'role' => $role,
        'api_token' => $apikey
      ]);
      
  }

}