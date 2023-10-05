<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\App_menu;
use App\Models\Social_media_link;
use Validator;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Http\Request;

class AppMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_app_menu = App_menu::all();
        $social_media_link = Social_media_link::all();
        return view('admin.app-menu', compact('all_app_menu','social_media_link'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $request->validate([
                'name' => 'required|unique:app_menus,menu_title',
                'slug' => 'required',
                'icon'=>'required|max:2048|dimensions:width=200,height=200'
            ]);
       
            $menu = new App_menu;
            $menu->menu_title = $request->name;
            $menu->menu_slug = $request->slug;
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
        $appmenu= App_menu::find($id);
        return response()->json([
            "status" => true,
            "appmenu" =>$appmenu               
            
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
            $menu= App_menu::find($menu_id);
            if($menu){
                $menu->menu_title= $request->name;
                $menu->menu_slug= $request->slug;
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
        $model=App_menu::find($id);
        $model->delete();
        return  back()->with('success', 'Record Deleted successfully!');
    }
}
