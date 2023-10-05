<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Developer;
use App\Models\User_developer_contract;
use App\Models\Contracts_anniversary_date;
use Validator;
use DB;

class UserDeveloperContractsController extends Controller
{
/*#########################################################################
    // Dev name : ramkishor
    // function for add COntract With multiple anniversary and multiple Points according to anniversary date.
############################################################*/	
    public function add_contract(Request $request)
    {
		$userid=auth('sanctum')->user()->id;
        $rules = array(
            'userid' => 'required',
            'developer_id' => 'required',
            'developer_name'=>'required',
            'year'=>'required',
            'offer_status' => 'required',
            //'points'=>'required'
        );

        $validator= Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json($validator->messages(),400);
        }else{

            $contract = new User_developer_contract();
            $contract->userid= $userid;
            $contract->developer_id = $request->developer_id;
            $contract->developer_name = $request->developer_name;
            $contract->year = $request->year;
            $contract->price_per_point = $request->price_per_point;
            //$contract->points = $request->points;
            $contract->name   = $request->name;
            $contract->email  = $request->email;
            $contract->mobile = $request->mobile;
            $contract->status = 1;
            $contract->offer_status = $request->offer_status;
            $contract->referral_code = $request->referral_code;
            $contract->created_date = $request->created_date;
            $contract->modified_date = $request->modified_date;
            $contract->created_by = $request->created_by;                   
            $result=$contract->save();
			
			$contractId = $contract->id;
			//$contractId = 1;
			//p($request->all()); die;	
			
			if($contractId){
				$aniversdetails=array();
               $anniversies = $request['userdetails'];
               //print_r($anniversies); die;
                //p($anniversies['anniversary_start_date']);die;			
                			
                //$i=0;          
				 for($i=0; $i < count($anniversies['anniversary_start_date']); $i++)				
				{
					$anniversydate = new Contracts_anniversary_date();
					$anniversydate->contract_id = $contractId;
			   
					$anniversydate->anniversary_start_date =$anniversies['anniversary_start_date'][$i];
					$anniversydate->anniversary_end_date = $anniversies['anniversary_end_date'][$i];
					$anniversydate->anniversary_points = $anniversies['anniversary_point'][$i];
					$data= $anniversydate->save();
							
				}
					
					
            }
			
            if($result) {
            return response()->json([
                    "status" => true,
                    "msg" => "Contract  added successfully!",
					"contract_id"=>$contractId
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
	/*
	###########################
	Start of All developers  with  enroll types Weekly Points, and owenership Level data .
	Developer-Ram
	###########################
	*/
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
	/*
	###########################
	Start of All developers  with  enroll types Weekly Points, and owenership Level data .
	Developer-Ram
	###########################
	*/
	public function sign_contract_agreement(Request $request){
		$data= $request->all();
		$userid=auth('sanctum')->user()->id;
		if($userid==$data['user_id']){  
			$rules = array(
				'user_id' => 'required',
				'contract_id' => 'required',
				'agreementwith'=>'required',
				'valid_days'=>'required',
			);

			$validator= Validator::make($request->all(),$rules);
			if ($validator->fails()) {
				return response()->json([
					'status'=>false,
					'errors'=>$validator->messages()
				]);
			}
			
			$contract_id=  $request->input('contract_id');
			$contract= User_developer_contract::where('id',$contract_id)->where('userid',$userid)->first();
			//p($contract->userid); die;
			if($contract){			
					$contract->offer_status= 1;
					$contract->agreement_date= date("m/d/y");
					$contract->agreementwith= $request->agreementwith;
					$contract->valid_days= $request->valid_days;
					$contract->paypal_email= $request->paypal_email;
					$contract->paypal_password= $request->paypal_password; 
					$contract->paypal_password= $request->paypal_password; 
					$contract->check_code= $request->check_code;
					$contract->check_firstname= $request->check_firstname;
					$contract->check_lastname= $request->check_lastname;
					$contract->street_address= $request->street_address;
					$contract->city_address= $request->city_address;
					$contract->check_email= $request->check_email;
					$contract->developer_login_username= $request->developer_login_username;
					$contract->developer_login_password= $request->developer_login_password;
					//$contract->date= $request->date;
					$contract->Account1= $request->Account1;
					$contract->Account2= $request->Account2;
					

				
				 if($request->hasFile('signature')) {                                     
					$file=$request->file('signature');
					$signatureext= $file->getClientOriginalExtension();
					$signaturefilename= 'signature-'.time().'.'.$signatureext;
					$file->storeAs('public/user_signature',$signaturefilename);
					$contract->signature = $signaturefilename;
				  }
				 if($request->hasFile('points_screenshot')) {
					$file=$request->file('points_screenshot');
					$points_screenshotext= $file->getClientOriginalExtension();
					$points_screenshotname= 'screenshot-'.time().'.'.$points_screenshotext;
					$file->storeAs('public/points_screenshot',$points_screenshotname);
					$contract->points_screenshot = $points_screenshotname;
				  }
				//echo $contract->offer_status; die;
				$result=$contract->update();

				if ($result){
						return response()->json(["status" => true,"message" => "contract signed  successfully."]);					
					}else{
						return response()->json(["status" => false,"message" => "contract not found."]);
					}
			}else{
				return response()->json(["status" => false,"message" => "Invalid contract."]);
			}
		}else{
				return response()->json(["status" => false,"message" => "Invalid user."]);
		}	
            
    }
	
	/*
	###########################
	Start of All developers  with  enroll types Weekly Points, and owenership Level data .
	Developer-Ram
	###########################
	*/
	public function user_contracts(){
		
		$rejected_contracts[]=0;
		 $userid=auth('sanctum')->user()->id;
		//$data['signed_contracts'] = ::where('offer_status',1)->get();
		$getsigndata = DB::table('user_developer_contracts')
		 ->join('developers', 'user_developer_contracts.developer_id', '=', 'developers.id')
		 ->where('user_developer_contracts.offer_status',1)->where('userid',$userid)
		 ->get(['user_developer_contracts.*','developers.logo as developer_logo','developers.developer_image as developer_photo','developers.valid_days']);
		 $countsigndata = DB::table('user_developer_contracts')
		 ->join('developers', 'user_developer_contracts.developer_id', '=', 'developers.id')
		 ->where('user_developer_contracts.offer_status',1)->where('userid',$userid)
		 ->count();
		 
         $accepted_contracts = DB::table('user_developer_contracts')
		 ->join('developers', 'user_developer_contracts.developer_id', '=', 'developers.id')
		 ->where('user_developer_contracts.offer_status',2)->where('userid',$userid)
		 ->get(['user_developer_contracts.*','developers.logo as developer_logo','developers.developer_image as developer_photo','developers.valid_days']);
		 $rejected_contracts = DB::table('user_developer_contracts')
		 ->join('developers', 'user_developer_contracts.developer_id', '=', 'developers.id')
		 ->where('user_developer_contracts.offer_status',3)->where('userid',$userid)
		 ->get(['user_developer_contracts.*','developers.logo as developer_logo','developers.developer_image as developer_photo','developers.valid_days']); 
		//$signed_contracts[]=0;
		 //echo $countsigndata;die;
		 
			 
			$data=array();
			 foreach($getsigndata as $signlist){
				 if($signlist->developer_logo){
					 $developerlogo= url('storage/app/public/developors_logo/'.$signlist->developer_logo);					 
				 }
				 if($signlist->developer_photo){
					 $developerphoto=$ddprofilepath= url('storage/app/public/developer_profile_image/'.$signlist->developer_photo);
				 }else{
					 $developerlogo=  $noimage= url('storage/app/public/no-image.png');
					 $developerphoto= $noimage= url('storage/app/public/no-image.png');
				 }
				 //p($signlist);
				 
				 
					//echo 
					$data['signed_contracts'][]=array(
					"id"=>				$signlist->id,
					 "userid"=> 		$signlist->userid,
					"developer_id"=>	$signlist->developer_id,
					"developer_name"=>  $signlist->developer_name,
					"price_per_point"=>	number_format($signlist->price_per_point,2),
					"valid_days"=>		$signlist->valid_days,
					"name"=> 			$signlist->name,
					"offer_status"=> 	$signlist->offer_status,
					"developer_logo"=> 	$developerlogo,
					"developer_photo"=> $developerphoto,
				  );
				 
			 }
		 
		 
		  
			 foreach($accepted_contracts as $acceptlist){
				 if($acceptlist->developer_logo){
					 $developerlogo= url('storage/app/public/developors_logo/'.$acceptlist->developer_logo);					 
				 }
				 if($acceptlist->developer_photo){
					 $developerphoto=$ddprofilepath= url('storage/app/public/developer_profile_image/'.$acceptlist->developer_photo);
				 }else{
					 $developerlogo=  $noimage= url('storage/app/public/no-image.png');
					 $developerphoto= $noimage= url('storage/app/public/no-image.png');
				 }
				 $data['accepted_contracts'][]=array(
					"id"=> 			$acceptlist->id,
					"userid"=> 		$acceptlist->userid,
					"developer_id"=>$acceptlist->developer_id,
					"price_per_point"=>number_format($acceptlist->price_per_point,2),
					"points"=>$acceptlist->points,
					"valid_days"=>	$acceptlist->valid_days,
					"amount"=>$acceptlist->amount,
					"developer_name"=>  $acceptlist->developer_name,
					"name"=> $acceptlist->name,
					"offer_status"=> $acceptlist->offer_status,
					"developer_logo"=> $developerlogo,
					"developer_photo"=> $developerphoto
				 );
			 }
		 
		 
		
			 foreach($rejected_contracts as $rejectlist){
				 if($rejectlist->developer_logo){
					 $developerlogo= url('storage/app/public/developors_logo/'.$rejectlist->developer_logo);					 
				 }
				 if($rejectlist->developer_photo){
					 $developerphoto=$ddprofilepath= url('storage/app/public/developer_profile_image/'.$rejectlist->developer_photo);
				 }else{
					 $developerlogo=  $noimage= url('storage/app/public/no-image.png');
					 $developerphoto= $noimage= url('storage/app/public/no-image.png');
				 }
				 $data['rejected_contracts'][]=array(
					"id"=> 			$rejectlist->id,
					"userid"=> 		$rejectlist->userid,
					"developer_id"=>$rejectlist->developer_id,
					"developer_name"=>  $rejectlist->developer_name,
					"price_per_point"=>number_format($rejectlist->price_per_point,2),
					"valid_days"=>	$rejectlist->valid_days,
					"name"=> $rejectlist->name,
					"offer_status"=> $rejectlist->offer_status,
					"developer_logo"=> $developerlogo,
					"developer_photo"=> $developerphoto
				 );
			 }
		 
		 
		if($data){
			return response()->json(["status" => true, "message" => "contract get  successfully.", "data"=>$data]);
		}
		
	}

}
