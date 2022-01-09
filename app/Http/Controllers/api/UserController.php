<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\QbidUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

  public function userRegistration(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'firstName'=>'required|min:4',
       'email'=>'required|email',
       'password'=>'required|min:6',
       'contact'=>'required|min:10',
       'zipCode'=>'required|min:6',
       'address'=>'required',
  ]);
  
  if ($validator->fails()) {
     return response()->json(['success'=>false,'message' => 'User registered successfully', 'status' => 200]);

  }
     $user=new User();
     $userDetails=new QbidUser();
     DB::beginTransaction();
     try{
        
     DB::transaction(function() use($request,$user,$userDetails){
      $user->name=$request->firstName;
      $user->email=$request->email;
      $user->password=encrypt($request->password);
      $user->save(); 
      $userDetails->user_id=$user->id;
      $userDetails->mobile_call=$request->contact;
      $userDetails->mobile_text=$request->contact;
      $userDetails->zip_code=$request->zipCode;
      $userDetails->address_line1=$request->address;
      $userDetails->address_line2=$request->address;
      $userDetails->save();
      DB::commit();
     });
      return response()->json(['success'=>true,'message' => 'User registered successfully', 'status' => 200]);
     }catch(\Exception $ex)
     {
         DB::rollBack();
        return response()->json(['success'=>false,'message' => $ex->getMessage(), 'status' => 422]);
    }
  }

}
