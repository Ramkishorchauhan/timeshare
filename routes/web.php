<?php
//URL::forceScheme('https');
use App\Http\Controllers\admin\TestController;
use App\Http\Controllers\admin\VendorController;
use App\Http\Controllers\admin\DeveloperPointsController;
use App\Http\Controllers\admin\DeveloperBudgetController;
use App\Http\Controllers\admin\SupportController;
use App\Http\Controllers\admin\PointsEstimationController;
use App\Http\Controllers\admin\CouponController;
use App\Http\Controllers\admin\NotificationController;
use App\Http\Controllers\admin\SocialMediaController;
use App\Http\Controllers\admin\ContractController;
use App\Http\Controllers\admin\AppMenuController;
use App\Http\Controllers\admin\AgreementController;

use App\Http\Controllers\admin\DeveloperManagebuttonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/', function () {
		return view('welcome');
	});
	Route::get('/clear-cache', function () {
		$cacheCommands = array(
				'event:clear',
				'view:clear',
				'cache:clear',
				'route:clear',
				'config:clear',
				'clear-compiled',
				'optimize:clear'
			);
			foreach ($cacheCommands as $command) {
				Artisan::call($command);
			}
		return "Cache cleared successfully";
	});
	Route::get('login',[VendorController::class,'index']);
	Route::get('test',[TestController::class,'index'])->name('test');
	Route::post('adduser',[TestController::class,'add_user'])->name('adduser');

	Route::post('checkemail',[VendorController::class,'checkemail'])->name('login.checkemail');
	Route::post('forgotpassword',[VendorController::class,'forgotpassword'])->name('login.forgotpassword');
	Route::post('login/auth',[VendorController::class,'auth'])->name('login.auth');

	Route::get('agreement/{userid}/{contractid}', [AgreementController::class,'index']);
	Route::post('save-agreement',[AgreementController::class,'save_agreement'])->name('save_agreement');
	Route::get('agreement-status',[AgreementController::class,'agreement_status'])->name('agreement-status');

Route::group(['middleware'=>'login_auth'],function(){
    Route::get('admin/dashboard',[VendorController::class,'dashboard'])->name('admin.dashboard');
    Route::get('admin/users',[VendorController::class,'users'])->name('admin.users');
    Route::get('admin/usersearch',[VendorController::class,'usersearch'])->name('admin.usersearch');
    
    Route::get('admin/contracts',[ContractController::class,'contracts'])->name('admin.contracts');
    Route::get('admin/contractsearch',[ContractController::class,'contractsearch'])->name('admin.contractsearch');

    Route::get('admin/manage-budget',[VendorController::class,'manage_budget'])->name('admin.manage-budget');
    Route::get('admin/manage-developers',[VendorController::class,'manage_developers'])->name('admin.manage-developers');
    Route::get('admin/manage-video',[VendorController::class,'manage_video'])->name('admin.manage-video');
    Route::post('admin/add-video',[VendorController::class,'add_video'])->name('admin.add-video');
    Route::post('admin/developer-registration',[VendorController::class,'developer_registration'])->name('admin.developer-registration');

    Route::get('admin/edit-developer/{id}',[VendorController::class,'edit_developer']);
    Route::post('admin/update-developer',[VendorController::class,'update_developer'])->name('admin.update-developer');
	Route::get('admin/developer-details/{id}',[DeveloperManagebuttonController::class,'developer_detail']);

    	 
    Route::get('admin/manage-enrolled-type',[DeveloperManagebuttonController::class,'manage_enrolled_type'])->name('admin.manage-enrolled-type');
    Route::get('admin/edit-enroll/{id}',[DeveloperManagebuttonController::class,'edit_enroll_type']);
    Route::post('admin/update-enrolled-type',[DeveloperManagebuttonController::class,'update_enrolled_type'])->name('admin.update-enrolled-type');
    Route::get('admin/delete-enrolled-type/{id}',[DeveloperManagebuttonController::class,'delete_enrolled_type']);

    
    Route::get('admin/week-type-details/{developerid}/{enroll_id}',[DeveloperManagebuttonController::class,'week_type_detail']);
    Route::get('admin/edit-week-type/{id}',[DeveloperManagebuttonController::class,'edit_week_type']);
    Route::post('admin/update-weektype',[DeveloperManagebuttonController::class,'update_week_type'])->name('admin.update-weektype');   
    
    Route::get('admin/delete-weektype/{id}',[DeveloperManagebuttonController::class,'delete_week_type']);


    Route::get('admin/ownership-type-detail/{developerid}/{enroll_id}/{week_id}',[DeveloperManagebuttonController::class,'ownership_type_detail']);



    Route::post('admin/ownership-registration',[DeveloperManagebuttonController::class,'add_owenership_level'])->name('admin.ownership-registration');
    Route::post('admin/enrollpoints-registration',[DeveloperManagebuttonController::class,'add_enrollpoints_type'])->name('admin.enrollpoints-registration');
    Route::post('admin/weeklyType-registration',[DeveloperManagebuttonController::class,'add_weekly_points'])->name('admin.weeklyType-registration');
    
   

    Route::get('admin/enroll_points_by_id/{id}',[DeveloperManagebuttonController::class,'get_enroll_points_by_id']);
    Route::get('admin/weekly_type_by_id/{id}',[DeveloperManagebuttonController::class,'weekly_type_by_id']);
    Route::get('admin/get_weekly_type_by_id/{id}',[DeveloperManagebuttonController::class,'get_weekly_type_by_id']);

    
    Route::get('admin/users-details/{id}',[VendorController::class,'user_details']);

    Route::get('admin/manage-points',[DeveloperPointsController::class,'manage_points'])->name('admin.manage-points');
    Route::post('admin/add-points',[DeveloperPointsController::class,'add_points'])->name('admin.add-points');
    Route::get('admin/edit-point/{id}',[DeveloperPointsController::class,'edit_point']);
    Route::post('admin/update-point',[DeveloperPointsController::class,'update_point'])->name('admin.update-point');
    Route::get('admin/delete-point/{id}',[DeveloperPointsController::class,'delete']);
    
    Route::get('admin/help-support',[SupportController::class, 'index'])->name('admin.help-support');
    Route::get('admin/help-support-search',[SupportController::class, 'help_support_search'])->name('admin.help-support');
    Route::post('admin/send-reply',[SupportController::class, 'create'])->name('admin.send-reply');
    Route::get('admin/send-reply/{id}',[SupportController::class, 'send_reply']);
    Route::get('admin/admin-reply/{id}',[SupportController::class, 'admin_reply'])->name('admin.admin-reply');
    Route::post('admin/admin-status',[SupportController::class, 'admin_status'])->name('admin.admin-status');
    Route::get('admin/all-queries',[SupportController::class, 'allqueries'])->name('admin.all-queries');
    Route::get('admin/all-queries-search',[SupportController::class,'all_queries_search'])->name('admin.all-queries-search');


    Route::get('admin/points-estimation/',[PointsEstimationController::class, 'index'])->name('admin.points-estimation');

    Route::get('admin/referral-code/',[CouponController::class, 'index'])->name('admin.referral-code');
    Route::post('admin/add-referral/',[CouponController::class, 'create'])->name('admin.add-referral');
    Route::get('admin/edit-coupon/{id}',[CouponController::class, 'edit']);
    Route::post('admin/update-coupon',[CouponController::class,'update'])->name('admin.update-coupon');
    Route::get('admin/delete-coupon/{id}',[CouponController::class,'delete']);

    Route::get('admin/app-menu/',[AppMenuController::class, 'index'])->name('admin.app-menu');
    Route::post('admin/add-app-menu/',[AppMenuController::class, 'create'])->name('admin.add-app-menu');
    Route::get('admin/edit-app-menu/{id}',[AppMenuController::class, 'edit']);
    Route::post('admin/update-app-menu',[AppMenuController::class,'update'])->name('admin.update-app-menu');
    Route::get('admin/delete-app-menu/{id}',[AppMenuController::class,'delete']);

    Route::get('admin/social-media-link/',[SocialMediaController::class, 'index'])->name('admin.social-media-link');
    Route::post('admin/add-social-media-link/',[SocialMediaController::class, 'create'])->name('admin.add-social-media-link');
    Route::get('admin/edit-social-media-link/{id}',[SocialMediaController::class, 'edit']);
    Route::post('admin/update-social-media-link',[SocialMediaController::class,'update'])->name('admin.update-social-media-link');
    Route::get('admin/delete-social-media-link/{id}',[SocialMediaController::class,'delete']);
    
    Route::get('admin/notification/',[NotificationController::class, 'index'])->name('admin.notification');
    Route::post('admin/add-notification/',[NotificationController::class, 'create'])->name('admin.addnotification');
    Route::get('admin/send-notification/',[NotificationController::class, 'send_notification'])->name('admin.sendnotification');
    

    Route::post('admin/add-budget',[DeveloperBudgetController::class,'add_budget'])->name('admin.add-budget');
    Route::get('admin/edit-developer-budget/{id}',[DeveloperBudgetController::class,'edit_developer_budget']);
    Route::post('admin/update-budget/',[NotificationController::class, 'create'])->name('admin.update-budget');
    

    

    Route::get('admin/logout', function () {
        session()->forget('USER_LOGIN');
        session()->forget('USER_ID');
        session()->flash('error','Logout successfully');
        return redirect('login');
    });

    
});
