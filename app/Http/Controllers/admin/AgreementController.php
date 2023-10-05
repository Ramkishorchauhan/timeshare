<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User_developer_contract;
use Illuminate\Support\Facades\DB;
use Validator;
use PDF;

class AgreementController extends Controller
{

    // Dev name : Ramksihor
    // function for view agreement page

    public function index(Request $request,$userid,$contractid){
		
        $contract_details= User_developer_contract::where('userid',$userid)->where('id',$contractid)->where('offer_status',1 )->get()->toArray();		
		if($contract_details){
		 $user= User::where('id',$userid)->get()->toArray();		 
		//$developer_points=DB::table('user_developer_contracts')->where('id',$contractid)->where('offer_status',1)->get()->toArray();
			if($user){ 
				// if($request->has('download'))
				// 	{
				// 		$pdf = PDF::loadView('agreement',compact(array('contract_id','user_id','user','contract_details')));
				// 		return $pdf->download('users_pdf_example.pdf');
				// 	}
				return view('agreement',compact(array('user','contract_details')));
				
					
				//$pdf = PDF::loadView('agreement', compact(array('user','contract_details'))); //load view page
    			//return $pdf->stream('sign-contract.pdf');
				
			}else{
				echo "User not found";
			}
		}else{
			echo "No incomplete contracts availble";
		}
    }
	public function save_agreement(Request $request){
		$pdf = PDF::loadView('agreement'); //load view page
    	return $pdf->download('test.pdf');
	         
    }
	
	public function agreement_status(Request $request){		
			echo " Contract updated successfully!";		
    }

}
