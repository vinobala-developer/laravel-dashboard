<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request){
    $request->validate([    //method from request class
        'name'=>'required',
        'mail_id'=>'required',
        'password'=>'required|confirmed', // password confirmation
        'role'=>'required'
    ]);
 $user = new User; // new user object for User model
 $user->name=$request->input('name');
 $user->mail_id=$request->input('mail_id');
 $user->password=Hash::make($request->input('password'));
 $user->role=$request->input('role');;

 $user->save(); //save function saves the data in database

 Auth::login($user); // login is Auth facade static function
 if($user->role == 'user')
    {
      return redirect('/home');
    }
    else{
        return redirect('/admin');
    }

    }
}
