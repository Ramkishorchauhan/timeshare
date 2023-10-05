<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Developer;
use App\Models\Enrolled_point_type; 
use Validator;
use DB;

class DeveloperController extends Controller
{

    // Dev name : ramkishor
    // function for add developer
    public function add_developer(Request $request)
    {
        $rules = array(
            'name' => 'required|unique:App\Models\Developer,name',
            'location' => 'required',
            'logo'=>'required|max:2048',
            'pdf'=>'required|mimes:pdf|max:5048',
            'status' => 'required',
            'created_by'=>'required'
        );

        $validator= Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }else{

            $developer = new Developer;
            $developer->name= $request->name;
            $developer->location= $request->location;
            $developer->status= $request->status;
            $developer->created_by= $request->created_by;
            if ($request->hasFile('logo')) {
                $path = 'public/developors_logo';
                $developer->logo = uploadImage($request, 'logo', $path);
            }
            $developer->pdf = $request->file('pdf')->storeAs('public/developors_pdf');            
            $result=$developer->save();

            if ($result) {
            return response()->json([
                    "status" => true,
                    "msg" => "Developer added successfully!",
                    
                    
                ]);
                
            }else{
               return response()->json([
                    "status" => false,
                    "msg" => "Registration Failed!",
                ]);
            }
        }
        
    }
        /*
		###########################
		Start of All developers  with  enroll types Weekly Points, and owenership Level data .
		Developer-Ram
		###########################
		*/

    public function all_developers()
    { 
		// $userid=auth('sanctum')->user()->id;
		//echo $userid; die;
        $dev_data= Developer::all();
        $logopath= url('storage/app/public/developors_logo/');
        $pdfpath= url('storage/app/public/developors_pdf/');
        $ddprofilepath= url('storage/app/public/developer_profile_image/');
        $i=0;
        foreach($dev_data as $key=>$list){
            //p($list->id);die;
            if($list->id){
                $developer_points=DB::table('developer_points')->where('developer_id',$list->id)->get()->toArray();                
                $ept_list= DB::table('enrolled_point_types')->where('developer_id',$list->id)->get()->toArray();
                $weekly_list= DB::table('week_types')->where('developer_id',$list->id)->get()->toArray();
                $owenership_list= DB::table('owenership_levels')->where('developer_id',$list->id)->get()->toArray();
                
                
                // foreach($ept as $eptlist){
                //     //p($list->point_type_title);die;
                //     $ept_list[]= array(
                //         'id'=>$eptlist->id,
                //         'Developer_id'=>$eptlist->developer_id,
                //         'title'=>$eptlist->point_type_title,
                //     );
                // }

                $data[$key] = array(
                    'name' => $list->name,
                    'location' => $list->location,
                    'valid_days' => $list->valid_days,
                    'pdf' => $pdfpath."/".$list->pdf,
                    'logo' => $logopath."/".$list->logo,
                    'developer_image' => $ddprofilepath."/".$list->developer_image,
                    'status' => $list->status,
                    'created_by' => $list->created_by,
                    'developer_points'=>$developer_points,
                    'enrolled_points_type'=>$ept_list,
                    'weekly_pointsType'=>$weekly_list,
                    'owenership_level'=>$owenership_list,
                    
                );
            }
        }
           
        return response()->json(["status" => true,"message" => "Get Record  successfully.","data"=>$data]);
    }

    public function users_all_developers()
    { 
		$userid=auth('sanctum')->user()->id;
		//echo $userid; die;
        $dev_data= Developer::all();
        $logopath= url('storage/app/public/developors_logo/');
        $pdfpath= url('storage/app/public/developors_pdf/');
        $ddprofilepath= url('storage/app/public/developer_profile_image/');
        $i=0;
        foreach($dev_data as $key=>$list){
            //p($list->id);die;
            if($list->id){
                $developer_points=DB::table('developer_points')->where('developer_id',$list->id)->get()->toArray();                
                $ept_list= DB::table('enrolled_point_types')->where('developer_id',$list->id)->get()->toArray();
                $weekly_list= DB::table('week_types')->where('developer_id',$list->id)->get()->toArray();
                $owenership_list= DB::table('owenership_levels')->where('developer_id',$list->id)->get()->toArray();
                $anniversary_date= DB::table('developerannversydates')->where('user_id',$userid)->where('developer_id',$list->id)->get()->toArray();

                // foreach($ept as $eptlist){
                //     //p($list->point_type_title);die;
                //     $ept_list[]= array(
                //         'id'=>$eptlist->id,
                //         'Developer_id'=>$eptlist->developer_id,
                //         'title'=>$eptlist->point_type_title,
                //     );
                // }

                $data[$key] = array(
                    'name' => $list->name,
                    'location' => $list->location,
                    'valid_days' => $list->valid_days,
					'pdf' => $pdfpath."/".$list->pdf,
                    'logo' => $logopath."/".$list->logo,
                    'developer_image' => $ddprofilepath."/".$list->developer_image,
                    'status' => $list->status,
                    'created_by' => $list->created_by,
                    'developer_points'=>$developer_points,
                    'enrolled_points_type'=>$ept_list,
                    'weekly_pointsType'=>$weekly_list,
                    'owenership_level'=>$owenership_list,
                    'anniversary_date'=>$anniversary_date,
                    
                );
            }
        }
           
        return response()->json(["status" => true,"message" => "Get Record  successfully.","data"=>$data]);
    }

}
