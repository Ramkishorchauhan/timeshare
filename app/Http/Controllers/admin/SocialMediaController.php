<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Social_media_link;
use Validator;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
// dd($request->all());        
        $request->validate([
                'mname' => 'required|unique:social_media_links,social_media_name',
                'mslug' => 'required',
                'icon'=>'required|max:2048'
            ]);
       
            $menu = new Social_media_link;
            $menu->social_media_name = $request->mname;
            $menu->social_media_slug = $request->mslug;
            $menu->status = '1';
            
                $icon=$request->icon;
                $logoName= $icon->getClientOriginalExtension();
                $filename='icon_'.time().'.'.$logoName;
                 $icon->storeAs('public/menu_icon',$filename);
                 $menu->icon= $filename;
                       
            $result=$menu->save();

            if ($result){
             return  back()->with('status', 'New menu add successfully!');
                
            }else{
               return  back()->with('status', 'Something Went Wrong!');
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
        $appmenus= Social_media_link::find($id);
        return response()->json([
            "status" => true,
            "appmenus" =>$appmenus               
            
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
            'name' => 'required',
            'slug' => 'required'
        );
        $validator= Validator::make($request->all(),$rules);
        
        if ($validator->fails()) {
           
            return back()->with('error', 'Something went wrong');
        }else{
            
            $menu_id=  $request->input('menu_id');
            $menu= Social_media_link::find($menu_id);
            if($menu){
                $menu->social_media_name= $request->name;
                $menu->social_media_slug= $request->slug;
                $menu->status= $request->status;
 
                $path = 'public/menu'.$request->icon;
                if(File::Exists($path)){
                    File::delete($path);
                }


                  if ($request->hasFile('icon')) {                                     
                    $file=$request->file('icon');
                    $logoext= $file->getClientOriginalExtension();
                    $logofilename= 'icon-'.time().'.'.$logoext;
                    $file->storeAs('public/menu_icon',$logofilename);
                    $menu->icon = $logofilename;
                  }
        
                $result=$menu->update();

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
        $model=Social_media_link::find($id);
        $model->delete();
        return  back()->with('success', 'Record Deleted successfully!');
    }
}
