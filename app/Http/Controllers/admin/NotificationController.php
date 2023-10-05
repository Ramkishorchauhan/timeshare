<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Developer;
use App\Models\Enrolled_point_type;
use App\Models\Week_type;
use App\Models\User;
use Validator;
use DB;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $week_types =Week_type::join('developers', 'developers.id', '=', 'week_types.developer_id')
        ->join('enrolled_point_types', 'week_types.enrolled_point_type_id', '=', 'enrolled_point_types.id')
        ->get(['week_types.*', 'developers.name as developers_name','enrolled_point_types.point_type_title as enrolled_points_title']);
        $enrolled_point_type = Enrolled_point_type::join('developers', 'developers.id', '=', 'enrolled_point_types.developer_id')
        ->get(['enrolled_point_types.*', 'developers.name as developer_name']);
        $developer=Developer::all();
        return view('admin.notification',['enrolled_point_type'=>$enrolled_point_type,'week_types'=>$week_types,'developers'=>$developer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

     function android_push($token, $load)
     {
         $msg = array(
             'body'  => $load['msg'],
             'title' => env('APP_NAME'),
             'icon'  => 'myicon', //Default Icon
             'sound' => 'default',
         );
         $fields = array('to' => $token, 'notification' => $msg, 'data' => $load, "priority" => "high");
         $headers = array('Authorization: key=' .'fj47EA0aTk6oYzdzcf5sY7:APA91bEDmJfg0H3P_OekR0lvOXl9wg-55c0hxR-rVqQYaBybGcJ8anNUPyUVx79qKoQeNvQIioHDZ1AhyCnXKQbY9GLU9BJKwTYNV0Zp8u1XtaSZOaoHPBZERXBLhZPVSb98wMuRnOYI', 'Content-Type: application/json');
         #Send Reponse To FireBase Server
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
         $result = curl_exec($ch);
         curl_close($ch);
     }

    public function send_notification(Request $request){
        // $ndate = Notification::all();
        // $currdate = date('Y-m-d', time());
        // foreach($ndate as $key=>$getdate){
        //     if($currdate == $getdate->notificaion_date){
        //         $getdt = $getdate->notificaion_date;
        //         $user = Notification::where('notificaion_date','=',$getdt)->get();
        //         $devid = $user[$key]['developer_id'];
        //         $userid = DB::select("select * from developer_registration where developer_id = $devid");
        //         // DB::table('developer_registration')->where('developer_id','=',$devid)->get();
        //         foreach($userid as $key=>$uid){
                    
        //             $id = $uid->user_id;
        //             $userdetails = DB::select("select * from users where id = $id");
                    
        //         }
                
                
        //     }
        // }
        // p($userdetails);die;
        
        
        
        
        $developer=Developer::all();
        $userid = "32";
        $user = User::find($userid);
        
        $name = $user->name;
        $fcmtoken = $user->fcm_token;
        $message = "Hi " .$name. ", A Note is shared in a group";
        $load = array();
        $load['title']  = env('APP_NAME');
        $load['msg']    = $message;
        $load['action'] = 'CONFIRMED';
        $this->android_push($fcmtoken, $load);
        $notification = new Notification();
        $notification->user_id = $userid;
        $notification->message = $message;
        $notification->created_at = date('Y-m-d H:i:s');
        $notification->updated_at = date('Y-m-d H:i:s');
        $notification->save();
        return view('admin.notification',['developers'=>$developer]);
    }
    public function create(Request $request)
    {
        $rules = array(
            'ntitle' => 'required',
            'description' => 'required',
            'developer_id'=>'required',
            'ndate'=>'required',
        );
        $validator= Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong');
        }else{
            $coupon = new Notification;
            $coupon->developer_id = $request->developer_id;
            $coupon->notificaion_title = $request->ntitle;
            $coupon->notificaion_message = $request->description;
            $coupon->notificaion_date = $request->ndate;
            $coupon->status = "1";
            $coupon->save();
            return back()->with('success', 'Notification has been schedule successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
