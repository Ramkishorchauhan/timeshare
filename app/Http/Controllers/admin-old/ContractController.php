<?php

namespace App\Http\Controllers\admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User_developer_contract;
use App\Models\Developer;

class ContractController extends Controller
{
    public function contracts(){
        $data['developers'] = Developer::all();
        $data['contracts'] = User_developer_contract::all();
        return view('admin.contracts',$data);
     }

     public function contractsearch($searchContract=''){
        $getdata =$searchContract;
        //p($getdata);die;
        $builder = User_developer_contract::query();
        if(isset($getdata)){
            $contracts = $builder->where('name','LIKE','%'.$getdata.'%')->get();
            
        if($contracts){            
            return response()->json([
                "status" => true,
                "contracts"=>$contracts,
            ]);

        }else{
            $developers = Developer::all();
            $contracts = User_developer_contract::all();
            //return view('admin.contracts',$data);
            return response()->json([
                "status" =>false,
                "contracts" => $contracts,
                "developer"=>$developers
            ]);
        }
        
        }else{
            //$users = User::paginate(3);
            return redirect('admin.users');
        }
    }

}
