<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\DeveloperController;
use App\Http\Controllers\api\UserDeveloperContractsController;
use App\Http\Controllers\api\HelpSupportsController;
use App\Http\Controllers\api\CouponController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
//Route::get('admin/color',[ColorController::class,'index']);
// });
//  Route::get('/test',function(){

//     p('working');
//  });
 Route::post('users/register', [UserController::class,'register']);
 Route::post('users/registered', [UserController::class,'registered']);
 Route::post('users/sendotp', [UserController::class,'send_otp']);
 Route::post('users/verifyotp', [UserController::class,'verifiedOtp']);
 Route::post('users/resendotp', [UserController::class,'resendOtp']);
 Route::post('users/changepassword', [UserController::class,'changepassword']);
 Route::post('users/login', [UserController::class,'login']);
 Route::post('users/socialLogin', [UserController::class,'socialLogin']);
 Route::get('developers/all-developers', [DeveloperController::class,'all_developers']);
 

 Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('users/check-login', [UserController::class,'check_session']);
    Route::post('users/logout', [UserController::class,'logout']);   
    
    
    Route::get('users/profile/{id}', [UserController::class,'profile']);
    Route::post('users/update_profile', [UserController::class,'update_profile']);
    Route::post('users/points_calculator', [UserController::class,'points_calculator']);
    Route::get('users/all', [UserController::class,'all']);
    
    Route::post('developers/add-developer', [DeveloperController::class,'add_developer']);
    Route::get('developers/users_all-developers', [DeveloperController::class,'users_all_developers']);
   
    Route::get('developers/all-developersdata', [DeveloperController::class,'all_developersdata']);
    

    Route::post('developercontracts/add-contract', [UserDeveloperContractsController::class,'add_contract']);
	Route::get('developercontracts/get-contracts', [UserDeveloperContractsController::class,'user_contracts']);
	Route::post('developercontracts/sign-contract-agreement', [UserDeveloperContractsController::class,'sign_contract_agreement']);
    Route::get('developercontracts/get-last-contractId', [UserDeveloperContractsController::class,'user_contract_lastId']);

    Route::post('coupon-validate', [CouponController::class,'check_coupon']);

    Route::get('users/app-menu', [UserController::class,'app_menus']);
    Route::get('help-and-supports', [HelpSupportsController::class,'index']);
    Route::post('support/new-query', [HelpSupportsController::class,'create']);

    Route::get('videos', [UserController::class,'allvideos']);
    
    

    
});

 
 
 
