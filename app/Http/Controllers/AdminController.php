<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

      public function profile($id){
        $user=User::find($id);
         return view('profile',['user'=>$user]);

    }
    public function profile_edit(Request $request,$id){
        $request->validate([    //method from request class
        'name'=>'required',
        'mail_id'=>'required',
        'password'=>'required|confirmed', // password confirmation

     ]);

        $edit=User::find($id);
        $edit->name=$request->input('name');
        $edit->mail_id=$request->input('mail_id');
        $edit->password=Hash::make($request->input('password'));
        $edit->save();//update data in database
       return redirect('/admin');
    }

    public function display(){
        $display_data=Employee::join("users","employees.reference","=","users.id")
                     ->select("employees.*","users.mail_id as reference_mail")
                     ->paginate(5);

        return view('/table',['lists'=>$display_data]);
    }

    public function insert(Request $request){

        $request->validate([    //method from request class
        'name'=>'required',
        'mail_id'=>'required',
        'designation'=>'required',
        'salary'=>'required',
        'role'=>'required'
         ]);

        $data=$request->only(['name','mail_id','designation','salary','role']);
        $data["reference"]=Auth::user()->id;
        $employee=Employee::create($data);

        //return $employee->name." User Created";
        return redirect('/admin')->with('success', $employee->name.' created successfully');
    }

    public function edit($id){
         $user=Employee::find($id);
         return view('edit',['user'=>$user]);

    }
    public function update(Request $request,$id){

        $edit=Employee::find($id);
        $edit->name=$request->input('name');
        $edit->mail_id=$request->input('mail_id');
        $edit->designation=$request->input('designation');
        $edit->salary=$request->input('salary');
        $edit->reference=Auth::user()->id;
        $edit->save();//update data in database

       return redirect('/admin')->with('success', 'updated successfully');
    }
    public function delete($id){
        $user=Employee::find($id);
        $user->delete();
      return redirect('/admin')->with('success', $user->name.' deleted successfully');

    }
    public function chart(){

       $user=DB::select(DB::raw("SELECT COUNT(*) as emp_created,u.name from employees as e join users as u on e.reference=u.id GROUP by u.name"));
       return view('/chart',['user'=>$user]);

       }
 public function emp_details(){
     $chat =Employee::where('reference', Auth::user()->id)->get(['id','name']);
    return view('add_employee',['chat'=>$chat]);
 }



}
