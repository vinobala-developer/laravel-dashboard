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

class HomeController extends Controller
{

      public function index(){

        //   $login_id=Auth::user()->id;
       //  $chat=DB::select(DB::raw("SELECT * FROM `users` where not id= $login_id and role='user' "));
         $chat = User::where('role', '=', 'user')
         ->where('id', '!=', Auth::user()->id)->select('*')->get();

          //$admin=DB::select(DB::raw("SELECT e.reference FROM employees e join users u on e.id= $login_id"));
          $admin=Employee::where('id','=',Auth::user()->id)->select('reference')->get();

           foreach ($admin as $admin) {
            $admin_id = $admin->reference;
            }

           //$admin_data=DB::select(DB::raw("SELECT name,id FROM `users` where id=$admin_id"));
           $admin_data=User::where('id', '=', $admin_id)->select(['id','name'])->get();
        return view('/home_chat',['chat'=>$chat,'admin'=>$admin_data]);
     }




      public function chat($id){

      $login_id=Auth::user()->id;
       $name =User::where('id', $id)->get('name');
       $chat = User::where('role', '=', 'user')->where('id', '!=', Auth::user()->id)->select('*')->get();
       $admin=Employee::where('id','=',Auth::user()->id)->select('reference')->get();
           foreach ($admin as $admin) {
            $admin_id = $admin->reference;
            }
      $admin_data=User::where('id', '=', $admin_id)->select(['id','name'])->get();

      //$msgs =DB::select(DB::raw("SELECT * FROM `chats` where (from_id=$login_id and to_id=$id) or (from_id=$id and to_id=$login_id)"));
     $msgs = Chat::where(['from_id' =>  Auth::user()->id , 'to_id' =>$id])
     ->orWhere(['from_id' => $id , 'to_id' =>Auth::user()->id])
     ->get();

      return view('home_chatbox',['to_id'=>$id,'from_id'=>Auth::user()->id,'user'=>$name,'chat'=>$chat,'admin'=>$admin_data,'msgs'=>$msgs]);

 }

 public function check(Request $request){
     if($request->ajax()){
        $send=new Chat;
        $send->to_id=$request->to_id;
        $send->message=$request->message;
        $send->from_id=$request->from_id;
        $send->save();

        $msgs = Chat::where(['from_id' =>  $request->from_id, 'to_id' =>$request->to_id])
                ->orWhere(['from_id' => $request->to_id , 'to_id' =>$request->from_id])
                ->get();

         $response['data'] = $msgs;

        return view('ajaxData',['msgs'=>$msgs,'to_id'=>$request->to_id]);
     }
    }


    public function change_notify(Request $request){

         if($request->ajax()){
         $status= Chat::where('to_id', Auth::user()->id)->update(["read_status" => 1]);
         }
    }
    public function notify(Request $request){
         if($request->ajax()){

             $login_id=Auth::user()->id;
           // $unread_msg=DB::select(DB::raw("SELECT u.name,c.message FROM chats c join users u where u.id=c.from_id and to_id=$login_id AND read_status=0"));
            $unread_msg=Chat::join("users","chats.from_id","=","users.id")
                            ->where(['to_id' => Auth::user()->id,'read_status'=> 0])
                            ->select(['name','message'])->get();
            return $unread_msg;
         }
    }
}
