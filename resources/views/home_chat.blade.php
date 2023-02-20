@extends('home')
@section('title','Message Box')

@section('content')

<div class="container d-flex row">
<div id="user_list" class="col-3 p-1">
<ul class="list-unstyled px-2">
    @foreach ($admin as $admin)
        <li  class="px-3 py-2" > <a href="/homechat/{{$admin->id}}" class="text-decoration-none"><i class="fa fa-comments p-2"></i>{{$admin->name}}</a></li>
       @endforeach
        </ul>
    <hr class="h-color mx-3">
    <ul class="list-unstyled px-2">
       @foreach ($chat as $chat)
        <li  class="px-3 py-2" > <a href="/homechat/{{$chat->id}}" class="text-decoration-none"><i class="fa fa-comments p-2"></i>{{$chat->name}}</a></li>
       @endforeach
    </ul>
</div>
<div class="container col-9 msgs">
         @yield('name')

     <div class="d-flex align-items-end msg_box">
        @yield('msg_content')

    <div class="form">
      <form class="form-inline row" id="form_msg" action="" >
      <div class="form-group col-xs-2 col-lg-10">
        <input class="form-control input-lg" id="message" type="text" name="message" placeholder="Type Here.." />
     </div>
      <div class="form-group col">
        <button type="submit"  id="send" class="btn send_btn">Send</button>
     </div>
     </form>
    </div>
     </div>
</div>
</div>
@endsection

@section('home_chat_style')
<style>
    #user_list{
        border:2px solid rgb(82, 156, 147);
        height:500px;
       background-color: rgb(114, 176, 169);
        overflow-y: scroll;
        overflow-x: hidden;
    }
    #user_list a{
        color:white;
    }
    .msgs{
        border:2px solid rgb(82, 156, 147);
        height:500px;
    }
    .msg_box{
        height:420px;
        flex-wrap: wrap;
    }
   #conversation{
        overflow: scroll;
        overflow-x:hidden;
          height:360px;
          width:100%;
    }
    .form{
         width:100%;
    }
    #message{
         width:100%;
    }
    .r_msg{
        color:red;
    }
    .send_btn{
         background-color:rgb(96, 92, 92);
         color:white;
    }
    /* .r_msg{
border:2px solid red;
display:flex;
justify-content: flex-end;
    }
    .right{
  background-color:rgb(45, 159, 240);
  width:fit-content;
    }
    .left{
  background-color:rgb(242, 239, 156);
    } */
</style>

@endsection

