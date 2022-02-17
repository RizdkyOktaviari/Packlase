<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;

class GoogleController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function redirectToGoogle()
 {
     return Socialite::driver('google')->redirect();
 }

 /**
  * Create a new controller instance.
  *
  * @return void
  */
 public function handleGoogleCallback()
 {
     try {

         $user = Socialite::driver('google')->user();

         $finduser = User::where('google_id', $user->id)->first();

         if($finduser){

             Auth::login($finduser);

             return redirect()->route('welcome');

         }else{
             $newUser = User::create([
                 'name' => $user->name,
                 'email' => $user->email,
                 'google_id'=> $user->id,
                 'roles'=> ('user'),
                 'password' => encrypt('123456dummy'),
                 'profile_photo_path' => ('16248868071.jpg'),
             ]);

             Auth::login($newUser);

             return redirect()->route('welcome');
         }

     } catch (Exception $e) {
         dd($e->getMessage());
     }
 }
}
