<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use App\Http\Livewire\Messages;

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

Route::view('register','auth.register')->middleware('guest')->name('login');
Route::post('store',[RegisterController::class,'store']);
Route::view('home','dashboard')->middleware('auth');
//Route::get('/home',[HomeController::class,'display'])->middleware('auth');



Route::view('login','auth.login')->middleware('guest')->name('login');
Route::post('authenticate',[LoginController::class,'authenticate']);
Route::get('logout',[LoginController::class,'logout']);


//Route::get('admin',[AdminController::class,'display'])->middleware('auth');
Route::get('add_employee',[AdminController::class,'emp_details']);
Route::post('add',[AdminController::class,'insert']);
Route::get('delete/{id}',[AdminController::class,'delete']);
Route::get('edit/{id}',[AdminController::class,'edit']);
Route::post('update/{id}',[AdminController::class,'update']);

Route::get('profile/{id}',[AdminController::class,'profile']);
Route::post('profile_edit/{id}',[AdminController::class,'profile_edit']);
Route::get('/admin',[AdminController::class,'display'])->middleware('auth');
Route::get('/chart',[AdminController::class,'chart'])->middleware('auth');


Route::get('/chat_box',[ChatController::class,'index']);
Route::get('/chat/{id}',[ChatController::class,'chat']);
Route::post('/send',[ChatController::class,'check']);
Route::get('/conversation',[ChatController::class,'conversation']);

Route::view('/dashboard','dashboard');
Route::get('/home_chat',[HomeController::class,'index'])->middleware('auth');
Route::get('/homechat/{id}',[HomeController::class,'chat']);
Route::get('/notify',[HomeController::class,'notify']);
Route::get('/change_notify',[HomeController::class,'change_notify']);


Route::get('/super_admin',[SuperadminController::class,'index']);
Route::get('/user_status',[SuperadminController::class,'user_status']);
Route::post('inactive_status',[SuperadminController::class,'inactive_status']);
Route::post('active_status',[SuperadminController::class,'active_status']);
Route::get('/filter',[SuperadminController::class,'log_filter']);
