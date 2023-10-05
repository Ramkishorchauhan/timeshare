<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRegister;
use App\Models\Useranniversydate;
use Illuminate\Support\Facades\Auth;

use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Mail;
use DB;

class UserController extends Controller
{

    // Dev name : Ramkishor
    // function for register new user with developer data

    public function register(Request $request)
    
    {       
        $rules = array(
            'name' => ['required'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required'],
            'contact' => ['required', 'min:9'],
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([ "status" =>false,"message"=>"Registration failed",  "data"=>$validator->messages()]);            
        }else{
            
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->contact = $request->contact;
            $user->address = $request->address;
            if(!empty($request->profile_img)){
                $loprofileImg=$request->profile_img;
                $picName= $loprofileImg->getClientOriginalExtension();
                $filename='user_'.time().'.'.$picName;
                 $loprofileImg->storeAs('public/profile_pics',$filename);
                 $user->profile_img= $filename;
                }
             $user->save();
             $userid = $user->id;        

            if($userid>0){
                $userdetails = $request->userdetails;
                foreach($userdetails as $key => $details)
                {
                    $userregister = new UserRegister();
                    $userregister->developer_id  = $details['developer_id'];
                    $userregister->points_enroll  = $details['points_enroll'];
                    $userregister->points_type  = $details['points_type'];
                    $userregister->ownership_level  = $details['ownership_level'];
                    $userregister->user_id  = $userid;
                    $userregister->no_of_points_owned  = $details['no_of_points_owned'];
                    $userregister->save();
                    $i = 0 ;
                    foreach($details['anniversy']['anniversary_start_date'] as $key2 => $anniversy)
                    {
                        $anniversydate = new Useranniversydate();
                        $anniversydate->user_id = $userid;
                        $anniversydate->developer_id = $details['developer_id'];
                        $anniversydate->anniversary_start_date =$details['anniversy']['anniversary_start_date'][$i] ;
                        $anniversydate->anniversary_end_date = $details['anniversy']['anniversary_end_date'][$i] ;
                        $data= $anniversydate->save();
                        $i = $i + 1;
                    }
                }
            }

            

            if ($data) {
                $maildata=['name'=>$request->name,'email'=>$request->email];
                $user['to']=$request->email;
                Mail::send('mail',$maildata,function($messages) use($user){
                     $messages->to($user['to']);
                     $messages->subject('New user Registration');
                });
                return response()->json([
                    "status" => true,
                    "message" => "User added successfully!",
                    "data" => [
						"name"=>$request->name,
						"email" => $request->email,
						"contact" => $request->contact,
					]

                ]);
                
            } else {
                return response()->json([
                    "status" => false,
                    "msg" => "Registration Failed!",
                ]);
            }
        }
    }

    // Dev name : Ramkishor
    // function for user login
     
    public function login(Request $request)
    {
        
        $rules = array(
            'email' => ['required', 'email'],
            'password' => ['required'],
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return response()->json($validator->messages(), 400);
        }
        $user = User::where('email', $request->email)->where('status', 1)->first();
        if (isset($user->id)){
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken("Timeshare_token")->plainTextToken;
                $data = DB::table('users')->where('id', $user->id)->update(array('fcm_token'=>$request->fcm_token,'login_time'=>time()));
                if($user->profile_img){
                    $profilepic= url('storage/app/public/profile_pics/'.$user->profile_img);
                }else{
                    $profilepic= $user->profile_img;
                }

                $response = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'contact' => $user->contact,
                    'address' => $user->address,
                    'status' => $user->status,
                    'profile_pic'=>$profilepic,
                    'created_at' => $user->created_at,
                ];
                return response()->json(["status"=>true, "message" =>"Logged in successfully.", "access_token" => $token, "data" => $response]);
            } else return response()->json([ "status" =>false,"message" =>"Either email or pasword is incorrect"]);
        } else return response()->json([ "status" =>false,"message" =>"Either email or pasword is incorrect"]);
                    
        
    }

    // Dev name : Ramkishor
    // function for login with social media

    public function socialLogin(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $login_type = $request->login_type ;
        
        $user = User::where('email',$email)->first();
       
        if($user)
        {
            $user->fcm_token = $request->fcm_token;
            $req=$user->save();
            auth()->login($user, true);
            $token =  $user->createToken('Timeshare_token')->plainTextToken;
            $userid = auth()->user()->id;           
            $userpreference = User::where('id',$userid)->get();            
            $registrationstatus = 0 ;
            if(count($userpreference) < 1)
            {
                $registrationstatus = 0 ;
            }
            else{
                $registrationstatus = 1 ;
            }
            return response(["status"=>1,"token"=>$token,"userid"=>"$userid","registrationstatus" => $registrationstatus]);
        }
        else{
            $newuser = new User();
            $newuser->name = $name ;
            $newuser->email = $email ;
            $newuser->login_type = $login_type ;
            $newuser->fcm_token = $request->fcm_token ;
            $newuser->status = 2;
            $newuser->save();
            auth()->login($newuser, true);
            $token =  $newuser->createToken('Timeshare_token')->plainTextToken;
            $userid =auth()->user()->id;
            return response(["status"=>1,"token"=>$token,"userid"=>"$userid","registrationstatus"=>0]);
        }
    }

    // Dev name : Ramkishor
    // function for get user profile by id

    public function profile($id)
    {
        $userdata = User::where('id',$id)->get()->map(function($proimage){
            if($proimage->profile_img != ''){
                $proimage->profile_img = url('storage/app/public/profile_pics/').'/'.$proimage->profile_img;
            }
            return $proimage;
        });
		$logopath= url('storage/app/public/developors_logo/');
        $userdevdata = DB::table('developer_registration')
		 ->join('developers', 'developer_registration.developer_id', '=', 'developers.id')
		 ->where('developer_registration.user_id', $id)
		//  ->get(['developer_registration.*','developers.name as developer_name','developers.developer_image as developer_photo']);
        ->get()->map(function($devimage){
            if($devimage->developer_image != ''){
                $devimage->developer_image = url('storage/app/public/developors_logo/').'/'.$devimage->developer_image;
            }
            if($devimage->logo != ''){
                $devimage->logo = url('storage/app/public/developors_logo/').'/'.$devimage->logo;
            }
            $devimage->name =$devimage->name;
            return $devimage;
        });
        //  foreach($userdevdata as $key => $udd){
        //     $devphoto[] = $logopath."/".$udd->developer_photo;
        //  }
		// dd($devphoto);die;
		$purchases = DB::table('developer_registration')->where('user_id', $id)->sum('no_of_points_owned');
		
		$data = array(
            'userdata'=> $userdata,
            'userdeveloperdata'=> $userdevdata,
            // 'userdeveloperimage'=> $devphoto,
		);
        return response()->json(["status" => true, "message" => "Profile Details get successfully.", "data" => $data,"total_points"=>$purchases]);
    }

    // Dev name : Ramkishor
    // function for update user profile by id

    public function update_profile(Request $request)
    {
        $user = User::find($request->id);
        $rules = array(
            'email' => 'email', 'unique:users,email' . $request->id,            
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->messages(), 400);
        }else{
			
			if($request->name){$name=$request->name;}else{$name=$user->name;}
			if($request->email){$email=$request->email;}else{$email=$user->email;}
			if($request->password){$pwd= Hash::make($request->password);}else{$pwd=$user->password;}
			if($request->contact){$contact=$request->contact;}else{$contact=$user->contact;}
			if($request->address){$address=$request->address;}else{$address=$user->address;}
           
		    $user->name = $name; 
            $user->email = $email;
            $user->password = $pwd;
            $user->status = $request->status;
            $user->contact = $contact;
            $user->address = $address;
            if(!empty($request->profile_img)){
                $loprofileImg = $request->profile_img;
                $picName= $loprofileImg->getClientOriginalExtension();
                $filename='user_'.time().'.'.$picName;
                $loprofileImg->storeAs('public/profile_pics',$filename);
                $user->profile_img= $filename;
            }
            $res = $user->update();
            if ($res) {
                if($user->profile_img){
                    $profilepic= url('storage/app/public/profile_pics/'.$user->profile_img);
                }else{
                    $profilepic= $user->profile_img; 
                }
    
                $dataarr[]=array(
                    'id'=>$user->id,
					'name'=>$user->name,
                    'email'=>$user->email,
                    'contact'=>$user->contact,
                    'address'=>$user->address,
                    'profile_pic'=> $profilepic

                );
                return response()->json(["status" => true, "message" => "Record Updated successfully." ,"data"=>$dataarr]);
            } else {
                return response()->json(["status" => false, "message" => "Something Went Wrong"]);
            }
        }
    }

    // Dev name : Ramkishor
    // function for developers points calculator
    public function points_calculator(Request $request)
    {

        $rules = array(
            'developer_id' => 'required',
            'total_points' => 'required',
            'price_per_point' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {

            $total_points = $request->total_points;
            $price_per_point = $request->price_per_point;
            $tatal_value = $total_points * $price_per_point;

            return response()->json(["status" => true, "total points value" => $tatal_value, "message" => "Calculated points value successfully."]);
        }
    }


    // Dev name : Sanjeev
    // function for sending otp for change password
    public function send_otp(Request $request){
        $rules = array(

            'email' => 'required'

        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {

            return response()->json($validator->messages(), 400);
        }
        $getuser = User::where('email', $request->email)->where('status', 1)->first();
        if (isset($getuser->id)) {
            $otp = rand(1000,9999);
            $time = time();
            $user = User::where('email','=',$request->email)->update(['otp' => $otp,'expired_otp' =>$time]);
            if($user){

                $data['email'] = $getuser->email;
                $data['title'] = 'Mail Verification';
        
                $data['body'] = 'Your OTP is:- '.$otp;

                 Mail::send('mailVerification',['data'=>$data],function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                    return response(["status" => 200, "message" => "OTP sent successfully"]);
                });
                 
                 
                }
                else{
                    return response(["status" => 401, 'message' => 'Invalid']);
                }
        }else{
            return response(["status" => 401, "message" => "Email does not exist"]);
        }
    }

    // Dev name : Sanjeev
    // function for verify otp for change password
    public function verifiedOtp(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $otpData = User::where('otp',$request->otp)->first();
        if(!$otpData){
            return response()->json(['success' => false,'msg'=> 'You entered wrong OTP']);
        }
        else{
            $currentTime = time();
            $time = $otpData->expired_otp;

            if($currentTime >= $time && $time >= $currentTime - (90+5)){
                User::where('id',$user->id)->update([
                    'is_verified' => 1
                ]);
                return response()->json(['success' => true,'msg'=> 'Mail has been verified']);
            }
            else{
                return response()->json(['success' => false,'msg'=> 'Your OTP has been Expired']);
            }

        }
 
    }

    // Dev name : Sanjeev
    // function for re-sending otp for change password
    public function resendOtp(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $otpData = User::where('email',$request->email)->first();

        $currentTime = time();
        $time = $otpData->expired_otp;

        if($currentTime >= $time && $time >= $currentTime - (90+5)){
            return response()->json(['success' => false,'msg'=> 'Please try after some time']);
        }
        else{

            $getuser = User::where('email', $request->email)->where('status', 1)->first();
            if (isset($getuser->id)) {
                    $otp = rand(1000,9999);
                    $time = time();
                    $user = User::where('email','=',$request->email)->update(['otp' => $otp,'expired_otp' =>$time]);
                    if($user){
        
                        $data['email'] = $getuser->email;
                        $data['title'] = 'Mail Verification';
                
                        $data['body'] = 'Your OTP is:- '.$otp;
                    
                        Mail::send('mailVerification',['data'=>$data],function($message) use ($data){
                            $message->to($data['email'])->subject($data['title']);
                            return response(["status" => 200, "message" => "OTP has been sent"]);
                        });
                        
                        
                    }
                    else{
                        return response(["status" => 401, 'message' => 'Invalid']);
                    }
            
                }

        }
    }

    // Dev name : Sanjeev
    // function for change password
    public function changepassword(Request $request){
        $user = User::where('email',$request->email)->first();
        $rules = array(
            'npwd'         =>'required|min:8|max:30',
            'ncpwd' =>'required|same:npwd'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $user->password = Hash::make($request->ncpwd);

            $res = $user->update();
            if ($res) {
                return response()->json(["status" => true, "message" => "Password has been changed."]);
            } else {
                return response()->json(["status" => false, "message" => "Something Went Wrong"]);
            }
        }
    }

    // Dev name : Sanjeev
    // function for get all videos
    public function allvideos(){
        $allvideos = DB::table('videos')->select('*')->get();
        return response()->json([
            "status" => true,
            "allvideos" =>$allvideos,                  
            
        ]);
    }

    // Dev name : Sanjeev
    // function for get all app menu
    public function app_menus(){
        $allappmenu= DB::table('app_menus')->select('*')->get();
        $logopath= url('storage/app/public/menu_icon/');
        $socialmedialink= DB::table('social_media_links')->select('*')->get();
        foreach($allappmenu as $key=>$list){
            $appmenu[$key] = array(
                'menu_title' => $list->menu_title,
                'menu_slug' => $list->menu_slug,
                'icon' => $logopath."/".$list->icon,
                'status' => $list->status,
            );
        }
        foreach($socialmedialink as $key=>$list){
            $socialmedia[$key] = array(
                'social_media_name' => $list->social_media_name,
                'social_media_slug' => $list->social_media_slug,
                'icon' => $logopath."/".$list->icon,
                'status' => $list->status,
            );
        }
        $data = array(
            'app_menu'=> $appmenu,
            'socialmedia'=> $socialmedia
        );
           
        return response()->json(["status" => true,"message" => "Success.","data"=>$data]);
    }


    // Dev name : Sanjeev
    // function for Automatic session expire after some time
    public function check_session(Request $request)
    {    
        $user = $request->user()->toArray();
        //p($user['login_time']);die;   
        //$data=DB::table('user')->where('tokenable_id',$user['id'])->orderby('id','DESC')->first();
        
        $time = date($user['login_time']);
       
        $currentTime= time();
       // p($time . '/'. $currentTime); die;
        
        if($currentTime >= $time && $time >= $currentTime - (2592000)){//30 Days
            // User::where('id',$user->id)->update([
            //     'is_verified' => 1
            // ]);
            $token = request()->user()->currentAccessToken()->token;
           // echo $token
            return response()->json(['success' =>true,'data'=>$token]);
        }
        else{

            auth()->user()->tokens()->delete();
            User::where('id',$user['id'])->update([
                'login_time' => 0
            ]);

        return [
            'status' => false,
            'message' => 'Your session is expire! please login again'
        ];
        }

    }


    // Dev name : Sanjeev
    // function for delete token and logout
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'status' => true,
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }
}
