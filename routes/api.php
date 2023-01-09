<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertsController;

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

Route::post('register_expert',[ExpertsController::class,'register_expert']);
Route::post('verify_pnumber',[ExpertsController::class,'verify_pnumber']);
Route::post('edit_basic_profile',[ExpertsController::class,'edit_basic_profile']);
Route::post('get_profile_details',[ExpertsController::class,'get_profile_details']);
Route::post('update_business_details',[ExpertsController::class,'update_business_details']);
Route::post('add_branch',[ExpertsController::class,'add_branch']);
Route::post('branches_payload',[ExpertsController::class,'branches_payload']);
Route::post('add_award',[ExpertsController::class,'add_award']);
Route::post('awards_payload',[ExpertsController::class,'awards_payload']);
Route::post('update_experience',[ExpertsController::class,'update_experience']);
Route::get('get_specializations',[ExpertsController::class,'get_specializations']);
Route::post('update_career',[ExpertsController::class,'update_career']);
Route::get('get_experts',[ExpertsController::class,'get_experts']);
Route::post('post_review',[ExpertsController::class,'post_review']);
Route::post('get_reviews',[ExpertsController::class,'get_reviews']);
Route::post('review_count',[ExpertsController::class,'review_count']);
Route::post('get_avg',[ExpertsController::class,'get_avg']);
Route::post('clear_reviews_count',[ExpertsController::class,'clear_reviews_count']);
Route::post('post_job',[ExpertsController::class,'post_job']);
Route::post('display_jobs',[ExpertsController::class,'display_jobs']);
Route::post('verify_applicant',[ExpertsController::class,'verify_applicant']);
Route::post('register_fcm_token',[ExpertsController::class,'register_fcm_token']);
Route::post('register_email_token',[ExpertsController::class,'register_email_token']);
Route::post('verify_email',[ExpertsController::class,'verify_email']);
Route::get('display_all_jobs',[ExpertsController::class,'display_all_jobs']);
Route::post('update_location',[ExpertsController::class,'update_location']);
Route::post('search_expert',[ExpertsController::class,'search_expert']);
Route::post('post_reply',[ExpertsController::class,'post_reply']);
Route::post('display_replies',[ExpertsController::class,'display_replies']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
