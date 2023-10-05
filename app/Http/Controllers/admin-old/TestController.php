<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Developer;

use App\Models\UserRegister;
use App\Models\Useranniversydate;

use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\file;
use Mail;
use DB;


class TestController extends Controller
{
    public function index(){
        $data['users'] = User::all();
        $data['developers'] = Developer::all();
        return view('mail',$data);
     }

   //   public function add_user( Request $request){
   //   //echo "<pre>";  
   //    //print_r($req->post());


     
   //       $rules = array(
   //             'name' => ['required'],
   //             'email' => ['required', 'email', 'unique:users,email'],
   //             'password' => ['required'],
   //             'contact' => ['required', 'min:9'],
   //             // 'address' => ['required'],
   //       );

   //       $validator = Validator::make($request->all(), $rules);
   //       if ($validator->fails()) {
   //             return response()->json([ "status" =>false,"msg" =>  $validator->messages()],400);
               
   //       }else{
               
   //             $user = new User;
   //             $user->name = $request->name;
   //             $user->email = $request->email;
   //             $user->password = Hash::make($request->password);
   //             $user->contact = $request->contact;
   //             $user->address = $request->address;
   //             if(!empty($request->profile_img)){
   //                $loprofileImg=$request->profile_img;
   //                $picName= $loprofileImg->getClientOriginalExtension();
   //                $filename='user_'.time().'.'.$picName;
   //                $loprofileImg->storeAs('public/profile_pics',$filename);
   //                $user->profile_img= $filename;
   //                }
   //             $user->save();
   //             $userid = $user->id;
   //             //p($result);die;          

   //             $token = $user->createToken('Timeshare_token')->plainTextToken;
   //             if($userid>0){
   //                $userdetails = $request->userdetails;
   //                foreach($userdetails as $key => $details)
   //                {
   //                   $userregister = new UserRegister();
   //                   $userregister->developer_id  = $details['developer_id'];
   //                   $userregister->points_enroll  = $details['points_enroll'];
   //                   $userregister->points_type  = $details['points_type'];
   //                   $userregister->ownership_level  = $details['ownership_level'];
   //                   $userregister->user_id  = $userid;
   //                   $userregister->no_of_points_owned  = $details['no_of_points_owned'];
   //                   $userregister->save();
   //                   // dd($details['anniversy']);
   //                   $i = 0 ;
   //                   foreach($details['anniversy']['anniversary_start_date'] as $key2 => $anniversy)
   //                   {
   //                         $anniversydate = new Useranniversydate();
   //                         $anniversydate->user_id = $userid;
   //                         $anniversydate->developer_id = $details['developer_id'];
   //                         $anniversydate->anniversary_start_date =$details['anniversy']['anniversary_start_date'][$i] ;
   //                         $anniversydate->anniversary_end_date = $details['anniversy']['anniversary_end_date'][$i] ;
   //                         $data= $anniversydate->save();
   //                         $i = $i + 1;
   //                   }
   //                }
   //             }

               

   //             if ($data) {
   //                $maildata=['name'=>'Ram','data'=>'test'];
   //                $user['to']='sram004@gmail.com';
   //                Mail::send('mail',$maildata,function($messages) use($user){
   //                      $messages->to($user['to']);
   //                      $messages->subject('New user Registration');
   //                });
   //                $response = response()->json([
   //                   "status" => true,
   //                   "msg" => "User added successfully!",
   //                   "data" => [ "name"=>$request->name,
   //                   "email" => $request->email,
   //                   "contact" => $request->contact,],
   //                   "token" => $token,

   //                ]);
   //                return json_encode($response);
   //             } else {
   //                return response()->json([
   //                   "status" => false,
   //                   "msg" => "Registration Failed!",
   //                ]);
   //             }
   //       }
   //    }

}
