<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Help_and_support;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\file;
use Mail;
use DB;

class HelpSupportsController extends Controller
{

    // Dev name : Sanjeev
    // function for get all help and support by id
    public function index(Request $request){
		$userid=0;
		$userid=auth('sanctum')->user()->id;
		if($userid>0){
			$allsupport = Help_and_support::where('user_id',$userid)->get();
			return response()->json([
				"status" => true,
				"allsupport" =>$allsupport,                  
				
			]);
		}else{
			return response()->json([
				"status" => false,
				"message" =>"Invalid User",                  
				
			]);
		}
    }

 
    // Dev name : Sanjeev
    // function for create new help and support question
    public function create(Request $request){
        $rules = array(

            'name' => 'required',
            'email' => 'required',
            'contact'=>'required',
            'message'=>'required'

        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return response()->json($validator->messages(), 400);
        }else{
            $getuser = User::where('email', $request->email)->where('status', 1)->first();
            if($getuser){
                $support_user = new Help_and_support;
                $support_user->user_id= $request->user_id;
                $support_user->name= $request->name;
                $support_user->email= $request->email;
                $support_user->contact= $request->contact;
                $support_user->message= $request->message;

                $result=$support_user->save();
                if ($result) {
                    return response()->json([
                            "status" => true,
                            "msg" => "We have got your response and we will get back to you shortly",
                            
                            
                        ]);
                        
                    }else{
                       return response()->json([
                            "status" => false,
                            "msg" => "Message not send.",
                        ]);
                    }
            }else{
                return response()->json([
                    "status" => false,
                    "msg" => "Entered email doesn't exist.",
                ]);
            }
        }
    }

}
