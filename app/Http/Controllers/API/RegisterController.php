<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\User;

use Vaildator;

class RegisterController extends BaseController
{
    //


    public function register(Request $request){

       
        $validator = Validator::make($request->all(),[
   'email'=>'required|string|email|max:255',
    'name'=>'required',
    'password'=>'required',
    'c_password'=>'required|same:password',
    
    ]);

       if($validator->fails())
        { return $this->sendError('error Validation',$validator->errors());}
         
        $input=$request->all();
        $input['password']=bcrypt($input['password']);
        $user =User ::create($input);
        $success['token']=$user->createToken('MyApp')->accessToken;
        $success['name']=$user->name;
    

          return $this->sendResponse($success,' User Create successfully');
      }
  
  
  
}
