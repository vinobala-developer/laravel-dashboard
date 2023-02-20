<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Userlog;

class SuperadminController extends Controller
{
    public function index(Request $request ){
        // $user = Auth::user()->active;
        $timestamp = Carbon::now('America/Toronto');
       // return $timestamp->toDayDateTimeString();

        $display_data=Userlog::paginate(5);
        $emp_details=User::get(['name','id']);

       $users = DB::table('userlogs')->selectRaw('count(*) as no_of_log_in, name')
                ->where([
                    ['log_in', '!=', NULL],
                    ['log_in', '>', Carbon::now()->subDays(7)],
                    ])
                ->groupBy('name')->get();


       return view('/user_log',['lists'=>$display_data,'emp'=>$emp_details,'user'=>$users]);
    }

    public function log_filter(Request $request ){

     if($request->ajax()){

       $userlog_where=[];
       if($request->emp != ''){
            $userlog_where["emp_id"]=$request->emp;
       }
        if($request->role != ''){
            $userlog_where["role"]=$request->role;
       }
        if($request->date != ''){
            $userlog_where["log_in"]=$request->date;
       }

        $emp_details=Userlog::where($userlog_where)->get();


        $users = DB::table('userlogs')->selectRaw('count(*) as no_of_log_in, name')
                ->where([
                    ['log_in', '!=', NULL],
                    ['log_in', '>', Carbon::now()->subDays(7)],
                    ])
                ->where($userlog_where)
                ->groupBy('name')->get();
      //  return $emp_details;
        return [$emp_details,$users];
         //return view('ajaxChart',['users'=>$users]);
       // return view('/super_admin',['user'=>$emp_details]);

      }
    }


    public function user_status(){
          $emp_details=User::whereNot('role','super admin')->paginate(10);
           return view('/user_status',['lists'=> $emp_details]);
    }
    public function inactive_status(Request $request){

         User::where('id',$request->user_id)->update(['active_status'=>1]);
         return back()->with('success','User Status Changed to In-Active');


    }
    public function active_status(Request $request){
          User::where('id',$request->activeuser_id)->update(['active_status'=>0]);
          return back()->with('success','User Status Changed to Active');
    }
}
