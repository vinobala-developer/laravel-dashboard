<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function authenticate(Request $request){
       $request->validate([
        'mail_id'=>'required',
        'password'=>'required'
    ]);
 $mail_id=$request->input('mail_id');
 $password=$request->input('password');


 if(Auth::attempt(['mail_id' => $mail_id , 'password' => $password,'active_status'=>0]))
 {
    $user = User::where('mail_id',$mail_id)->first();
    Auth::login($user);

     $timestamp = Carbon::now('America/Toronto');
     //$date= $timestamp->toDayDateTimeString();
      $date= $timestamp->toDateString();

    $activity_log=[
        'emp_id'=>Auth::user()->id,
        'name'=>Auth::user()->name,
        'role'=>Auth::user()->role,
        'log_in'=>$date
    ];

    DB::table('userlogs')->insert($activity_log);

    if($user->role == 'user')
    {
      return redirect('/home');
    }
    else{
        return redirect('/admin');
    }

 }
 else{
    return back()->withErrors(['Invalid Credentials']);
 }
    }

    public function logout(){

     $timestamp = Carbon::now('America/Toronto');
     $date= $timestamp->toDateString();

    $activity_log=[
        'emp_id'=>Auth::user()->id,
        'name'=>Auth::user()->name,
        'role'=>Auth::user()->role,
        'log_out'=>$date
    ];

    DB::table('userlogs')->insert($activity_log);
        Auth::logout();
        return redirect('/login');
    }
}
