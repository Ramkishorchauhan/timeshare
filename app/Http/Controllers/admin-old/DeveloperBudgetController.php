<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Developer_budget;
use Illuminate\Http\Request;

class DeveloperBudgetController extends Controller
{
    
    public function index()
    {
       
    }

   
    public function add_budget(Request $request){
        //return $request->input(); die;
       $request->validate([
            'developer_id' => 'required',
            'budget' => 'required',
            'from_date'=>'required',
            'to_date'=>'required',
            'status'=>'required',
        ]);           

        $budget = new Developer_budget;
        $budget->developer_id= $request->developer_id;
        $budget->budget= $request->budget;
        $budget->from_date= $request->from_date;
        $budget->to_date= $request->to_date;        
        $budget->status= $request->status;
        $result=$budget->save();

        //$token = $user->createToken('Timeshare_token')->plainTextToken;
        if ($result){
            return  back()->with('status', 'Budget add successfully!');
            
        }else{
            return  back()->with('status', 'Something Went Wrong!');
        }
    }
    

    
    public function show(Developer_budget $developer_budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Developer_budget  $developer_budget
     * @return \Illuminate\Http\Response
     */
    public function edit(Developer_budget $developer_budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Developer_budget  $developer_budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Developer_budget $developer_budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Developer_budget  $developer_budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Developer_budget $developer_budget)
    {
        //
    }
}
