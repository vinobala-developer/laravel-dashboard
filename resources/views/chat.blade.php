@extends('chat_box')


@section('name')
       @foreach ($user as $user)
            <h3>{{$user->name}}</h3>
       @endforeach
       <hr class="mx-3">
@endsection
@section('msg_content')
   {{-- @error('message') <span class="error">{{ $message }}</span> @enderror --}}
    <div id="conversation">
        <ul class="list-unstyled chat_list">
        @foreach($msgs as $msg)
         @if( $msg->to_id == $to_id)
         <div class="r_msg m-2">
         <li class="right text-end p-2 m-2">{{$msg->message}}</li>
         </div>
            @else
            <div class="l_msg m-2">
         <li class="left p-2 m-2">{{$msg->message}}</li>
            </div>
          @endif
        @endforeach
    </ul>
  </div>

@endsection
@section('chat_script')

<script>


let to_id =JSON.parse('{!! json_encode($to_id) !!}');
let from_id =JSON.parse('{!! json_encode($from_id) !!}');

setInterval(function() {chat();}, 3000);

$('#form_msg').submit("click",function(event){
    event.preventDefault();
     let msg=$('#message').val();

    $.ajax({
        type:'POST',
        url:'/send',
        data:{
            'to_id':to_id,
            'from_id':from_id,
            'message':msg
            },
        success:function(response){

             $('#message').val('');
             $('#conversation').html(response);

                 }

    });

});
 function chat(){

    $.ajax({
        type:'GET',
        url:'/conversation',
        data:{
            'to_id':to_id,
            'from_id':from_id
            },
        success:function(response){

             $('#message').val('');
             $('#conversation').html(response);
        }

    });

    }
</script>
@endsection






