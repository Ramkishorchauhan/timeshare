<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Developer;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developer = Developer::all();
        $coupon = Coupon::all();
        return view('admin.coupon', compact('developer','coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rules = array(
            'couponname' => 'required|unique:coupons,name',
            'coupontype' => 'required',
            'couponvalue'=>'required',
            'validfrom'=>'required',
            'validupto'=>'required',
            'coupondescription' => 'required',
        );
        $validator= Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong');
        }else{
            $user_id = $request->session()->all();
            $id = $user_id['USER_ID'];
            $data = $request->input();
            $coupon = new Coupon;
            $coupon->created_by = $id;
            $coupon->type = $data['coupontype'];
            $coupon->name = $data['couponname'];
            $coupon->value = $data['couponvalue'];
            $coupon->from_date = $data['validfrom'];
            $coupon->to_date = $data['validupto'];
            $coupon->developer_id = $data['devvalue'];
            $coupon->status = "1";
            $coupon->description = $data['coupondescription'];
            $coupon->save();
            return back()->with('success', 'Coupon has been created successfully');
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
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupons= Coupon::find($id);
        return response()->json([
            "status" => true,
            "coupons" =>$coupons               
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = array(
            'couponname' => 'required|unique:coupons,name',
            'coupontype' => 'required',
            'couponvalue'=>'required',
            'validfrom'=>'required',
            'validupto'=>'required',
            'coupondescription' => 'required',
        );
        $validator= Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return back()->with('error', 'Something went wrong');
        }else{
        // p($request->input());die; 
            $coupon_id=  $request->input('coupon_id');
            $coupon= Coupon::find($coupon_id);
            if($coupon){
                $coupon->name= $request->name;
                $coupon->type= $request->cou_type;
                $coupon->value= $request->cou_value;            
                $coupon->from_date= $request->from_date;
                $coupon->to_date= $request->end_date;    
                $coupon->developer_id= $request->devvalue;     
                $coupon->description= $request->description;   
                $result=$coupon->update();

                if ($result){
                    return  back()->with('success', 'Record updated successfully!');                    
                    }else{
                    return  back()->with('error', 'Something Went Wrong!');
                    }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $model=Coupon::find($id);
        $model->delete();
        return  back()->with('success', 'Record Deleted successfully!');
    }
}
