<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\developer_points;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_points(){
        $data['developers'] = Developer::all();
        $data['points'] = developer_points::all();
        return view('admin.manage-points',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_points(Request $request)
    {
        //return $request->input();

       $request->validate([
            'developer_id' => 'required',
            'year' => 'required',
            'price_per_point'=>'required',
            'created_by'=>'required'
        ]);           

            $point = new developer_points;
            $point->developer_id= $request->developer_id;
            $point->year= $request->year;
            $point->price_per_point= $request->price_per_point;
            $point->created_by= $request->created_by;
            $point->status= '1';
            $result=$point->save();

            //$token = $user->createToken('Timeshare_token')->plainTextToken;
            if ($result){
             return  back()->with('status', 'Record add successfully!');
                
            }else{
               return  back()->with('status', 'Something Went Wrong!');
            }
    }

    

     public function edit_point($id){
        $developerPoints= developer_points::find($id);
        return response()->json([
            "status" => true,
            "developers" =>$developerPoints,                  
            
        ]);
    }


    public function update_point(Request $request)
    {
        //p($request->input());die;  

        $point_id=  $request->input('id');
        $point= developer_points::find($point_id);
        if($point){
            $point->developer_id= $request->developer_id;
            $point->year= $request->year;
            $point->price_per_point= $request->price_per_point;            
            $point->status= $request->status;
            $point->created_by= $request->created_by;         
            $result=$point->update();

            if ($result){
                return  back()->with('status', 'Record updated successfully!');                    
                }else{
                return  back()->with('status', 'Something Went Wrong!');
                }
        }else{
            return  back()->with('status', 'Year not found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\developer_points  $developer_points
     * @return \Illuminate\Http\Response
     */
   public function delete(Request $request,$id){
        $model=developer_points::find($id);
        $model->delete();
        return  back()->with('status', 'Record Deleted successfully!');
    }
}
