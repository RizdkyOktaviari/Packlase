<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function fetch(Request $request)
  {
    return ResponseFormatter::success($request->user(),'Data profile user berhasil diambil');
  }

  public function login(Request $request)
  {
    try {
      $request->validate([
        'email' => 'email|required',
        'password' => 'required'
      ]);

      $credentials = request(['email', 'password']);
      if (!Auth::attempt($credentials)) {
        return ResponseFormatter::error([
          'message' => 'Unauthorized'
        ],'Authentication Failed', 500);
      }

      $user = User::where('email', $request->email)->first();
      if ( ! Hash::check($request->password, $user->password, [])) {
        throw new \Exception('Invalid Credentials');
      }

      $tokenResult = $user->createToken('authToken')->plainTextToken;
      return ResponseFormatter::success([
        'access_token' => $tokenResult,
        'token_type' => 'Bearer',
        'user' => $user
      ],'Authenticated');
    } catch (Exception $error) {
      return ResponseFormatter::error([
        'message' => 'Something went wrong',
        'error' => $error,
      ],'Authentication Failed', 500);
    }
  }

  public function register(Request $request)
  {
    try {
      $request->validate([
        'name' => ['required', 'string', 'max:35'],
        'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
        'password' => 'nullable|required_with:password_confirmation|string|confirmed',
      ]);

      User::create([
        'name' => $request->name,
        'email' => $request->email,
        'address' => $request->address,
        'phoneNumber' => $request->phoneNumber,
        'roles' => 'user',
        'password' => Hash::make($request->password),
      ]);

      $user = User::where('email', $request->email)->first();

      $tokenResult = $user->createToken('authToken')->plainTextToken;

      return ResponseFormatter::success([
          'access_token' => $tokenResult,
          'token_type' => 'Bearer',
          'user' => $user
      ],'User Registered');
  } catch (Exception $error) {
      return ResponseFormatter::error([
          'message' => 'Something went wrong',
          'error' => $error,
      ],'Authentication Failed', 500);
    }
  }

  public function logout(Request $request)
  {
    $token = $request->user()->currentAccessToken()->delete();

    return ResponseFormatter::success($token,'Token Revoked');
  }

  public function updatePhoto(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'file' => 'required|image|max:5120',
      ]);

      if ($validator->fails()) {
          return ResponseFormatter::error(['error'=>$validator->errors()], 'Update Photo Fails', 401);
      }

      if ($request->file('file')) {
        if (Auth::user()->profile_photo_path != null) {
          if (file_exists('storage/'.Auth::user()->profile_photo_path)) {
            unlink('storage/'.Auth::user()->profile_photo_path);
          }
        }
          $file = $request->file->store('public/images', 'public');

          //store your file into database
          $user = Auth::user();
          $user->profile_photo_path = $file;
          $user->update();

          return ResponseFormatter::success([
            'user' => $user,
            'file' => Storage::url($file)
          ],'File successfully uploaded');
      }
  }

  // public function updateUser(Request $request)
  // {
  //     $user = User::find($request->id);
  //
  //     $validator = Validator::make($request->all(), [
  //
  //         'file' => 'required|image|max:5120',
  //     ]);
  //
  //     if ($validator->fails()) {
  //         return ResponseFormatter::error(['error'=>$validator->errors()], 'Update Photo Fails', 401);
  //     }
  //
  //
  //     if ($request->file('file')) {
  //       if (file_exists('storage/'.$user->profile_photo_path)) {
  //         unlink('storage/'.$user->profile_photo_path);
  //       }
  //
  //       $image_name = time().$request->file->getClientOriginalName();
  //       $request->file->storeAs('public/images/', $image_name);
  //
  //         //store your file into database
  //         $user->profile_photo_path = 'public/images/'.$image_name;
  //         $user->update();
  //
  //         return ResponseFormatter::success([$image_name],'File successfully uploaded');
  //     }
  // }

  public function edit(Request $request){

    try {


      $request->validate([
        'name' => ['nullable', 'string', 'max:35'],
        'address' => ['nullable', 'string'],
        'phoneNumber' => ['nullable', 'string'],

      ]);

      $user = User::find($request->id);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->address = $request->address;
      $user->phoneNumber = $request->phoneNumber;

      $user->save();

      return ResponseFormatter::success([
        'token_type' => 'Bearer',
        'user' => $user
        ],'Update Data Berhasil');

    } catch (Exception $error) {
    return ResponseFormatter::error($e->getMessage(),'Update Data Gagal');

    }
  }


}
