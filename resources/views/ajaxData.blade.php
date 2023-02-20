 <ul class="list-unstyled chat_list">
        @foreach($msgs as $msg)
         @if( $msg->to_id == $to_id)
         <div class="right m-2">
       <li class=" text-end p-2 m-2">{{$msg->message}}</li>
         </div>
            @else
         <li class="left p-2 m-2">{{$msg->message}}</li>
          @endif
        @endforeach
    </ul>
