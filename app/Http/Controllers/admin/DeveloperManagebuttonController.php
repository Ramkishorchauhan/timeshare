<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Enrolled_point_type;
use App\Models\Week_type;
use App\Models\Developer;
use App\Models\Owenership_level;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\file;
use Validator;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;


class DeveloperManagebuttonController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manage_enrolled_type()
    {
        //$enrolled_point_type = Enrolled_point_type::all();
        
        $week_types =Week_type::join('developers', 'developers.id', '=', 'week_types.developer_id')
                                ->join('enrolled_point_types', 'week_types.enrolled_point_type_id', '=', 'enrolled_point_types.id')
                                ->get(['week_types.*', 'developers.name as developers_name','enrolled_point_types.point_type_title as enrolled_points_title']);
        $enrolled_point_type = Enrolled_point_type::join('developers', 'developers.id', '=', 'enrolled_point_types.developer_id')
              		->get(['enrolled_point_types.*', 'developers.name as developer_name']);
        $owenership_level = Owenership_level::join('developers', 'developers.id', '=', 'owenership_levels.developer_id')
                    // ->join('enrolled_point_types', 'owenership_levels.enroll_point_type_id', '=', 'enrolled_point_types.id')  comment by sanjeev 23-08-2023
              		// ->get(['owenership_levels.*', 'developers.name as developer_name','enrolled_point_types.point_type_title']);  comment by sanjeev 23-08-2023
                      ->get(['owenership_levels.*', 'developers.name as developer_name']); //   add by sanjeev 23-08-2023
        $developer=Developer::all();
        $owenership = Owenership_level::all();

       // dd($enrolled_point_type);
       return view('admin.manage-developer-button',['enrolled_point_type'=>$enrolled_point_type,'week_types'=>$week_types,'developers'=>$developer,'owenership_level'=>$owenership_level]);
    }

    /*##############################################
        Stsrt eidt Enroll type by id 
        Developer : Ram
    ##############################################*/

    
    public function edit_enroll_type($id){
        //$enroll= Enrolled_point_type::find($id);
        $enroll=Enrolled_point_type::join('developers', 'developers.id', '=', 'enrolled_point_types.developer_id')
		->where('enrolled_point_types.id',$id)->get(['enrolled_point_types.*', 'developers.name as developer_name'])->toArray();
        return response()->json([
            "status" => true,
            "enroll" =>$enroll,                  
            
        ]);
    }

    
    public function update_enrolled_type(Request $request)
    { 
            $rules = array(
                'developer_id' => 'required',
                'point_type_title' => 'required',                            
                'status' => 'required',
                
            );

            $validator= Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages()
                ]);
            }
            
            $id=  $request->input('id');
           // p($id);die;
            $enrollType= Enrolled_point_type::find($id);
            if($enrollType){
                $enrollType->developer_id= $request->developer_id;
                $enrollType->point_type_title= $request->point_type_title;
                $enrollType->status= $request->status;                
                
                $result=$enrollType->update();

                if ($result){
                    return  back()->with('status', 'Enroll type updated successfully!');                        
                    }else{
                    return  back()->with('status', 'Something Went Wrong!');
                    }
            }else{
                return  back()->with('status', 'Enroll type not found!');
            }
            
    }

    public function delete_enrolled_type(Request $request,$id){
        $model=Enrolled_point_type::find($id);
        $model->delete();
        return  back()->with('status', 'Enroll type deleted successfully!');
    }

    



    public function add_enrollpoints_type(Request $request){
        //p($request->post());die;
        $request->validate([
            'developer_id' => ['required'],
            'point_type_title' => ['required'],
            'status' => ['required'],
        ]);           

            $ept = new Enrolled_point_type;
            $ept->developer_id= $request->developer_id;
            $ept->point_type_title= $request->point_type_title;            
            $ept->status= $request->status;
            $result=$ept->save();
            if ($result){
             return  back()->with('status', 'Record add successfully!');
                
            }else{
               return  back()->with('status', 'Something Went Wrong!');
            }
    }

    public function add_weekly_points(Request $request){
        //p($request->post()); die;         
        $request->validate([
            'developer_id' => ['required'],
            'point_type_title'=>['required'],
            'status' => ['required'],
        ]);
         
            $wt = new Week_type;
            $wt->developer_id= $request->developer_id;
            $wt->enrolled_point_type_id= $request->enrolled_point_type_id;
            $wt->point_type_title= $request->point_type_title;
            $wt->status= $request->status;
            $result=$wt->save();
            if ($result){
             return  back()->with('status', 'Week type added successfully!');
            }else{
               return  back()->with('status', 'Something Went Wrong!');
            }
    }

    public function add_owenership_level(Request $request){
    //    dd($request->all());
        $request->validate([
            'developer_id' => ['required'],
            // 'max_points' => ['required'],
            'ownership_type'=>['required'],
            'status' => ['required'],
        ]);
         
            $developer = new Owenership_level;
            $developer->developer_id= $request->developer_id;
            $developer->enroll_type_id= $request->enroll_type_id;
            $developer->weekly_type_id= $request->weekly_type_id;
            $developer->min_points= $request->min_points;            
            $developer->max_points= $request->max_points;
            $developer->ownership_type= $request->ownership_type;
            $developer->enroll_point_type_id= $request->enroll_type_id;
            $developer->status= $request->status;
            // p($developer);    die;    
            $result=$developer->save();
            if ($result){
             return  back()->with('status', 'Record add successfully!');
            }else{
               return  back()->with('status', 'Something Went Wrong!');
            }
    }
    public function get_enroll_points_by_id($id){
        $enroll = Enrolled_point_type::where('developer_id',$id)->get();
        return response()->json(([
            "status" => true,
            "enroll" =>$enroll,                  
            
        ]));
    }

    

    public function get_weekly_type_by_id($id){
        $enrollid = Enrolled_point_type::where('developer_id',$id)->get();
        return response()->json(([
            "status" => true,
            "enrollid" =>$enrollid,                  
            
        ]));
    }
	
	public function developer_detail($id){
		$data['page_title']="Developer Enroll Details";
        $data['developer_id']= $id;
        $developer=Developer::all();
        $enrolled_point_type = Enrolled_point_type::where('developer_id',$id)->get();
		return view('admin.developer-enroll-type',['enrolled_point_type'=>$enrolled_point_type,'developers'=>$developer,'page_data'=>$data]);
    }
	public function week_type_detail($developer_id,$enroll_id){
		$data['page_title']=" Developers Week Points Type";
        $data['developer_id']=$developer_id;
        $data['enroll_id']=$enroll_id;
        $developer=Developer::all();
        $week_point_type = Week_type::where('developer_id',$developer_id)->where('enrolled_point_type_id',$enroll_id)->get();
        $enroll_type = Enrolled_point_type::where('developer_id',$developer_id)->get();
        //p($week_point_type); die;
		return view('admin.week-type-details',['week_point_type'=>$week_point_type,'developers'=>$developer,'enroll_type'=>$enroll_type,'page_data'=>$data]);
    }

    public function edit_week_type($id){
        //$enroll= Enrolled_point_type::find($id);
        $week=Week_type::join('developers', 'developers.id', '=', 'week_types.developer_id')
        ->join('enrolled_point_types', 'enrolled_point_types.id', '=', 'week_types.enrolled_point_type_id')
		->where('week_types.id',$id)->get(['week_types.*', 'developers.name as developer_name','enrolled_point_types.point_type_title as enroll_name']);
            return response()->json([
                "status" => true,
                "weektype" =>$week,                  
            
            ]);
    }


    public function update_week_type(Request $request)
    { 
      
            $rules = array(
                'week_id' => 'required',
                'developer_id' => 'required',
                'enrolled_point_type_id' => 'required',
                'point_type_title' => 'required',                            
                'status' => 'required',
                
            );
            $validator= Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages()
                ]);
            }
            $id=  $request->input('week_id');
           // p($id);die;
            $weekType= Week_type::find($id);
            if($weekType){
                $weekType->developer_id= $request->developer_id;
                $weekType->enrolled_point_type_id= $request->enrolled_point_type_id;
                $weekType->point_type_title = $request->point_type_title;
                $weekType->status= $request->status;                
                
                $result=$weekType->update();

                if ($result){
                    return  back()->with('status', 'Week type updated successfully!');                        
                    }else{
                    return  back()->with('status', 'Something Went Wrong!');
                    }
            }else{
                return  back()->with('status', 'Enroll type not found!');
            }
            
    }

    public function delete_week_type(Request $request,$id){
        $model=Week_type::find($id);
        $model->delete();
        return  back()->with('status', 'Week type deleted successfully!');
    }
    
    



	public function ownership_type_detail($developer_id,$enroll_id,$week_id){
		$developer=Developer::all();
        $data['page_title']="Developer Details";
        $data['developer_id']=$developer_id;
        $data['enroll_id']=$enroll_id;
        $data['week_id']=$week_id;
		$owenership_level=Owenership_level::join('developers', 'developers.id', '=', 'owenership_levels.developer_id')
		->leftJoin('week_types', 'week_types.id', '=', 'owenership_levels.weekly_type_id')
		->leftJoin('enrolled_point_types', 'enrolled_point_types.id', '=', 'owenership_levels.enroll_type_id')
		->where('owenership_levels.developer_id',$developer_id)->where('owenership_levels.enroll_type_id',$enroll_id)->where('owenership_levels.weekly_type_id',$week_id)->get(['owenership_levels.*', 'developers.name as developer_name','week_types.point_type_title','enrolled_point_types.point_type_title']);
		//p($owenership_level);die;
        return view('admin.developer-owenership',['owenership_level'=>$owenership_level,'developers'=>$developer,'page_data'=>$data]);
    }


    
    
}