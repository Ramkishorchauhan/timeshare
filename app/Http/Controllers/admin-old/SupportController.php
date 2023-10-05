<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\User;
use App\Models\Help_and_support;
use DB;
use Validator;
use Illuminate\Http\Request;


class SupportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allhelpuser = DB::table('help_and_supports')
        ->leftJoin('users', 'help_and_supports.user_id', '=', 'users.id')
        ->orderBy('id', 'DESC')
        ->get(['help_and_supports.id', 'help_and_supports.name', 'help_and_supports.email', 'help_and_supports.contact', 'help_and_supports.message', 'help_and_supports.past_response', 'help_and_supports.admin_status', 'help_and_supports.created_at', 'users.profile_img']);

        return view('admin.help-and-supports',compact('allhelpuser'));
    }

    public function help_support_search(Request $request){
        // dd($request->all());
        $search = $request->input('search');
        $ipdate = $request->input('ipdate');
        $status = $request->input('status');
        $query = DB::table('help_and_supports');
        $query->leftJoin('users', 'help_and_supports.user_id', '=', 'users.id');
        if($request->ajax()){
            if(isset($ipdate)){
                $query->whereDate('help_and_supports.created_at', $ipdate);
            }
            if(isset($status)){
                $query->where('help_and_supports.admin_status', $status);
            }
            if(isset($search)){
                $query->where(function ($query) use($search) {
                $query->where('help_and_supports.name', 'like', '%'.$search.'%');
                $query->orWhere('help_and_supports.email', 'like', '%'.$search.'%');
                });
            }
        }
        $query->orderBy('id', 'DESC');
        $allhelpuser = $query->get(['help_and_supports.id', 'help_and_supports.name', 'help_and_supports.email', 'help_and_supports.contact', 'help_and_supports.message', 'help_and_supports.past_response', 'help_and_supports.admin_status', 'help_and_supports.created_at', 'users.profile_img']);

        return view('admin.help-and-support-search', compact('allhelpuser'))->render();

    }

    public function allqueries()
    {
        $allqueries = Help_and_support::paginate(2);
        return view('admin.all-queries',[
            'allqueries' => $allqueries,

            ]);
    }

    public function all_queries_search(Request $request){
        $allqueries = Help_and_support::query()->paginate(2);
        $query = $request->search;
        $select_id = $request->admin_status;
        if($request->ajax())
        {
            $allqueries = Help_and_support::query();
            if (!empty($query)) {
                $allqueries = $allqueries->where('name', 'like', '%'.$query.'%')->orWhere('email', 'like', '%'.$query.'%');
            }
            if (!empty($select_id)) {
                $allqueries = $allqueries->where('admin_status', $select_id);
            }
            if (!empty($select_id) && !empty($query)) {
                $allqueries = $allqueries->where('name', 'like', '%'.$query.'%')
                ->where('admin_status',  'like', '%'.$select_id.'%');
                //->orWhere('email', 'like', '%'.$query.'%')
                
            }
          //  DB::enableQueryLog();
            $allqueries = $allqueries->paginate(2);

          //  p(DB::getQueryLog());die;
            return view('admin.all-query-search', compact('allqueries'))->render();

        }else{
            $allqueries = Help_and_support::where('name', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')
            ->andWhere('admin_status', 'like', '%'.$select_id.'%')
            // ->orWhere('created_at', 'like', '%'.$choosedate.'%')
            // ->orderBy('id','asc')
            ->paginate(2);
        }     

        return view('admin.all-queries', compact('allqueries'));

    }

    
    public function create(Request $request)
    {
        $rules = array(
            'message' => 'required',
        );

        $validator= Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages()
                ]);
            }else{
            $help_id=  $request->user_id;
            $point= Help_and_support::where(['id'=>$help_id])->first();
            if($point){
                $point->past_response= $request->message;        
                $result=$point->update();

                if ($result){
                    return  back()->with('status', 'Message has been sent successfully!');                    
                    }else{
                    return  back()->with('status', 'Something Went Wrong!');
                    }
            }else{
                return  back()->with('status', 'Something Went Wrong!');
            }
        }
    }

    public function admin_reply($id){
        $adminreply= Help_and_support::find($id);
        return response()->json([
            "status" => true,
            "adminreply" =>$adminreply,                  
            
        ]);
    }

    public function send_reply($id){
        $sendreply= Help_and_support::find($id);
        return response()->json([
            "status" => true,
            "sendreply" =>$sendreply,                  
            
        ]);
    }

    public function admin_status(Request $request){
        // dd($request->all());
        $rules = array(
            'adminstatus' => 'required',
        );

        $validator= Validator::make($request->all(),$rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages()
                ]);
            }else{
            $id = $request->user_id;
            $res_status = $request->adminstatus;
            $point = Help_and_support::where(['id'=>$id])->first();
            if($point){
                $point->admin_status= $res_status;        
                $result=$point->update();

                if ($result){
                    return  back()->with('status', 'Message has been sent successfully!');                    
                    }else{
                    return  back()->with('error', 'Something Went Wrong!');
                    }
            }else{
                return  back()->with('error', 'Something Went Wrong!');
            }
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
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function show(Support $support)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function edit(Support $support)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Support $support)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Support  $support
     * @return \Illuminate\Http\Response
     */
    public function destroy(Support $support)
    {
        //
    }
}
