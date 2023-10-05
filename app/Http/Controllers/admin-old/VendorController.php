<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\vendor;
use App\Models\User;
use App\Models\Developer;
use App\Models\User_developer_contract;
use App\Models\Help_and_support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Validator;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;


class VendorController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.login');
    }


    //  Vendor Authentication

    public function auth(Request $request)
    {
        $email= $request->post('email');
        $password= $request->post('password');
        $result= vendor::where(['email'=>$email])->first();
        if( $result){
            if(Hash::check($password,$result->password)){
                if(isset($result->id)){
                    $request->session()->put('USER_LOGIN',true);
                    $request->session()->put('USER_ID',$result->id);
                    return redirect('admin/dashboard');
        
                }
            }else{
                $request->session()->flash('error','Please enter correct password');
                return redirect('login');
            }
        }else{
            $request->session()->flash('error','Please enter correct login details');
                return redirect('login');
        }

    }

    public function dashboard()
    {
        $users = User::count();
        $totalbudget = DB::select("SELECT budget FROM developer_budgets");
        $helpsupports = DB::table('help_and_supports')
        ->leftJoin('users', 'help_and_supports.user_id', '=', 'users.id')
        ->take(10)
        ->orderBy('id', 'desc')
        ->get(['help_and_supports.id', 'help_and_supports.name', 'help_and_supports.email', 'help_and_supports.contact', 'help_and_supports.message', 'help_and_supports.past_response', 'help_and_supports.admin_status', 'help_and_supports.created_at', 'users.profile_img']);

        //echo "Welcom to the dashboard";
       return view('admin.dashboard',['users' => $users, 'helpsupports' => $helpsupports, 'totalbudget' => $totalbudget]);
    }

    public function contracts(){
        //$developer = Developer::all();
        return view('admin.contracts');
    }
    public function users()
    {

            $users = User::paginate(5);
            $developer = Developer::all();
        return view('admin.users',[
            'users' => $users,
            'developer' => $developer
            ]);
            // return view('vendor.pagination.custom',[
            //     'users' => $users
            //     ]);
    }

    public function usersearch(Request $request){
        $developer = Developer::all();
        $users = User::query()->paginate(5);
        if($request->ajax()){
            // if(!empty($request->input('search')) && !empty($request->input('devid'))){

            // }
            if(!empty($request->input('search'))){
                $users = DB::table('users')
                ->where('name', 'like', '%'.$request->input('search').'%')
                ->orWhere('email', 'like', '%'.$request->input('search').'%')
                ->paginate(5);
            }
            if(!empty($request->input('devid'))){
                $users = DB::table('users')
                ->where('name', 'like', '%'.$request->input('search').'%')
                ->orWhere('email', 'like', '%'.$request->input('search').'%')
                ->leftJoin('developer_registration', 'developer_registration.user_id', '=', 'users.id')
                ->where('developer_id', '=', $request->input('devid'))
                ->distinct()
                ->paginate(5);
            }
            return view('admin.user-seach', compact('users'))->render();
        }

        $users = DB::table('users')
        ->where('name', 'like', '%'.$request->input('search').'%')
        ->orWhere('email', 'like', '%'.$request->input('search').'%')
        ->leftJoin('developer_registration', 'developer_registration.user_id', '=', 'users.id')
        ->where('developer_id', '=', $request->input('devid'))
        ->distinct()
        ->paginate(5);

        return view('admin.users', compact('users','developer'));

    }


    public function user_details($id){
        $user= User::find($id);
        $developers = Developer::all();
        $contract_details = DB::table('user_developer_contracts')
        ->leftjoin('developers', 'user_developer_contracts.developer_id', '=', 'developers.id')
        ->leftjoin('users', 'user_developer_contracts.userid', '=', 'users.id')
        ->where('users.id','=', $id)
        ->get();
        
        // User_developer_contract::with('developer_id')
        // ->join('developers', 'developers.id', '=', 'user_developer_contracts.developer_id')
        // ->where('user_developer_contracts.userid', '=', $user->id)
        // ->get('user_developer_contracts.*');
        
        // DB::table('user_developer_contracts')
                            
                            
        //                     ->leftJoin('developers', 'developers.id', '=', 'user_developer_contracts.developer_id')
        //                     ->where('user_developer_contracts.userid',$id)
        //                     // ->where('user_developer_contracts.developer_id', 'developers.id')
        //                     ->get(['user_developer_contracts.developer_id', 'user_developer_contracts.developer_name', 'user_developer_contracts.points', 'developers.id', 'developers.name']);
        return view('admin.users-details',compact('user', 'contract_details', 'developers'));
    }


    public function manage_developers()
    {
        //echo "Welcom to the dashboard";
        $developer = Developer::orderBy("id", 'desc')->get();
        $enrolled_point_types = DB::table('enrolled_point_types')->get();
        //dd($enrolled_point_types);
        $week_types = DB::table('week_types')->get();
        return view('admin.manage-developers',['developers' => $developer,'week_types'=>$week_types, 'enrolled_point_types'=>$enrolled_point_types]);
    }
    
    public function manage_video()
    {
        $allvideos = DB::select("SELECT * FROM videos");
         //$developer = Developer::all();
        return view('admin.manage-video',['allvideos' => $allvideos]);
    }

    public function add_video(Request $request)
    {
        $rules = array(
            'video_title' => 'required',
            'video_url' => 'required',
            'video_description' => 'required'
        );

        $validator= Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->messages()
            ]);
        }else{
            $user_id = $request->session()->all();
            $video['title'] = $request->video_title;
            $video['link'] = $request->video_url;
            $video['description'] = $request->video_description;
            $video['created_by'] = $user_id['USER_ID'];
            $video['created_at'] = DB::raw('CURRENT_TIMESTAMP');
            $queryState = DB::table('videos')->insert($video);
            if($queryState) {
                return  back()->with('status', 'Video created successfully!');
            } else {
                return  back()->with('error', 'Something Went Wrong!');
            }
        }
    }
    
    public function developer_registration(Request $request){
        
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:App\Models\Developer,name',
            'location' => 'required',
            'logo'=>'required|max:2048',
            'pdf'=>'required|mimes:pdf|max:2048',
            'status' => 'required',
            'created_by'=>'required'
        ]);

           

            $developer = new Developer;
            $developer->name= $request->name;
            $developer->location= $request->location;
            $developer->status= $request->status;
            $developer->created_by= $request->created_by;
            
                $logoImg=$request->logo;
                $logoName= $logoImg->getClientOriginalExtension();
                $filename='logo_'.time().'.'.$logoName;
                 $logoImg->storeAs('public/developors_logo',$filename);
                 $developer->logo= $filename;
            
                $pdfImg=$request->pdf;
                $pdfName=$pdfImg->getClientOriginalExtension();
                $pdffilename='pdf_'.time().'.'.$pdfName;
                 $pdfImg->storeAs('public/developors_pdf',$pdffilename);
                 $developer->pdf= $pdffilename;
            
            //$developer->pdf = $request->file('pdf')->store('public/developors_pdf');            
            $result=$developer->save();

            //$token = $user->createToken('Timeshare_token')->plainTextToken;
            if ($result){
             return  back()->with('status', 'Record add successfully!');
                
            }else{
               return  back()->with('status', 'Something Went Wrong!');
            }
          
    }
        
    
    public function edit_developer($id){
        $developers= Developer::find($id);
        return response()->json([
            "status" => true,
            "developers" =>$developers,                  
            
        ]);
    }


    public function update_developer(Request $request)
    { 
            $rules = array(
                'name' => 'required',
                'location' => 'required',
                //'logo'=>'required|max:2048',
                //'pdf'=>'required|mimes:pdf|max:2048',
                'status' => 'required',
                'created_by'=>'required'
            );

            $validator= Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages()
                ]);
            }
            
            $developer_id=  $request->input('id');
            $developer= Developer::find($developer_id);
            if($developer){
                $developer->name= $request->name;
                $developer->location= $request->location;
                $developer->status= $request->status;
                $developer->created_by= $request->created_by;

                $path = 'public/developors_logo'.$developer->logo;
                if(File::Exists($path)){
                    File::delete($path);
                }

                $path = 'public/developors_pdf'.$developer->pdf;
                if(File::Exists($path)){
                    File::delete($path);
                }
                  if ($request->hasFile('logo')) {                                     
                    $file=$request->file('logo');
                    $logoext= $file->getClientOriginalExtension();
                    $logofilename= 'logo-'.time().'.'.$logoext;
                    $file->storeAs('public/developors_logo',$logofilename);
                    $developer->logo = $logofilename;
                  }
                  if ($request->hasFile('pdf')) {
                    $file=$request->file('pdf');
                    $pdfext= $file->getClientOriginalExtension();
                    $pdfname= 'pdf-'.time().'.'.$pdfext;
                    $file->storeAs('public/developors_pdf',$pdfname);
                    $developer->pdf = $pdfname;
                  }
                
                $result=$developer->update();

                if ($result){
                    return  back()->with('status', 'Record updated successfully!');
                        
                    }else{
                    return  back()->with('status', 'Something Went Wrong!');
                    }
            }else{
                return  back()->with('status', 'Developer not found!');
            }
            
    }

    
    public function manage_budget(){
        $totalbudget = DB::select("SELECT budget FROM developer_budgets");
        return view('admin.manage-budget',compact('totalbudget'));
    }

   // Check Vender email

    public function checkemail(Request $request){
        $email= $request->post('email');
        $result= vendor::where(['email'=>$email])->first();
        $id = $result->id;
        if($result){ 
            return view('admin.forgotpassword', compact('email','id'));
        }else{ 
            $request->session()->flash('error','Please enter valid email');
            return redirect('login');
        }
    }

    // Forgot Vender password

    public function forgotpassword(Request $request){
        $pwd= $request->post('password');
        $email = $request->post('email');
        $id = $request->post('id');
        $cpwd= $request->post('confirmpassword');

        if($pwd == $cpwd){
            $usr = vendor::find($id);
            $usr->password = Hash::make($request->input('password'));
            $usr->update();
            return redirect('login')->with('status','Password Updated Successfully');
        }else{
            return redirect('login')->with('error','Password does not same');
        }
    }

}
