<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Validator;
use DB;

class CouponController extends Controller
{

    // Dev name : ramkishor
    // function for add developer
    public function check_coupon(Request $request){
        $userid=auth('sanctum')->user()->id;
        if($userid>0){
            $rules = array(
            'coupon_name' => 'required',
            'points_price' => 'required',
            'total_points'=>'required',
        );

           $validator= Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json($validator->messages(),400);
            }else{

                //p($request->coupon_name);die;
                $coupon = Coupon::where('name', '=',$request->coupon_name)->first();
                if($coupon){
                    //echo $coupon->to_date;  
                    $currentdate = date('Y-m-d H:i:s');
				   //echo $coupon->to_date; 
				   //die;
				   
                    if($currentdate <= $coupon->to_date){
						
                        $point_value= ($request->points_price) * ($coupon->value)/100; 
                        $total_point_value = $request->points_price + $point_value;
                        $total_amount=$request->total_points*$total_point_value;
						//echo $total_amount; die;		
                        return response()->json(["status" =>true,"message" => "Referral code successfully validated","total_amount"=>number_format($total_amount,2)]);
                    }else{
                         return response()->json(["status" =>true,"message" => "Referral Code  is expired"]);
                    }
                     
                }else{return response()->json(["status" =>false,"message" => "Referral Code is not valid"]);}
            }
        }else{
            return response()->json(["status" =>False,"message" => "Unauthorized User"]);
        }   
    }

}
