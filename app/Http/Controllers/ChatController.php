<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{

     public function index(){
        $chat =Employee::where('reference', Auth::user()->id)->get(['id','name']);
         return view('/chat_box',['chat'=>$chat]);
     }

     public function chat($id){

      $login_id=Auth::user()->id;
      $name =User::where('id', $id)->get('name');
      $chat =Employee::where('reference', Auth::user()->id)->get(['id','name']);
      //$msgs =DB::select(DB::raw("SELECT * FROM `chats` where (from_id=$login_id and to_id=$id) or (from_id=$id and to_id=$login_id)"));

      $msgs = Chat::where(['from_id' =>  Auth::user()->id , 'to_id' =>$id])
     ->orWhere(['from_id' => $id , 'to_id' =>Auth::user()->id])
     ->get();

      return view('chat',['to_id'=>$id,'from_id'=>$login_id,'user'=>$name,'chat'=>$chat,'msgs'=>$msgs]);

 }
   public function check(Request $request){
     if($request->ajax()){
        $send=new Chat;
        $send->to_id=$request->to_id;
        $send->message=$request->message;
        $send->from_id=$request->from_id;
        $send->save();
       // $msgs =DB::select(DB::raw("SELECT * FROM `chats` where (from_id=$request->from_id and to_id=$request->to_id) or (from_id=$request->to_id and to_id=$request->from_id)"));
         $msgs = Chat::where(['from_id' =>  $request->from_id, 'to_id' =>$request->to_id])
                ->orWhere(['from_id' => $request->to_id , 'to_id' =>$request->from_id])
                ->get();

        $response['data'] = $msgs;

        return view('ajaxData',['msgs'=>$msgs,'to_id'=>$request->to_id]);

     }

   }
 public function conversation(Request $request){
     if($request->ajax()){
        $send=new Chat;
        $send->to_id=$request->to_id;
        $send->from_id=$request->from_id;
        //$msgs =DB::select(DB::raw("SELECT * FROM `chats` where (from_id=$request->from_id and to_id=$request->to_id) or (from_id=$request->to_id and to_id=$request->from_id)"));
        $msgs = Chat::where(['from_id' =>  $request->from_id, 'to_id' =>$request->to_id])
                ->orWhere(['from_id' => $request->to_id , 'to_id' =>$request->from_id])
                ->get();

        $response['data'] = $msgs;
        return view('ajaxData',['msgs'=>$msgs,'to_id'=>$request->to_id]);
     }
    }
}

