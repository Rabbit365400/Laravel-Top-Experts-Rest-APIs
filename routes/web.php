<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpertsController;

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


Route::view('welcome','welcome');
Route::view('apply_job/{job_id}/{applicant}','apply_job');
Route::view('add_photo/{user_id}','add_photo');
Route::post('post_cv',[ExpertsController::class,'post_cv']);
Route::post('post_photo',[ExpertsController::class,'post_photo']);
