
<div wire:poll>

    {{-- Current time: {{ now() }} --}}
 @error('message') <span class="error">{{ $message }}</span> @enderror

 {{-- {{$this->to_id}} --}}
<ul class="list-unstyled chat_list">
        @foreach($chats as $chat)
         @if( $chat->to_id == $this->to_id)
         <div class="right m-2">
       <li class=" text-end p-2 m-2">{{$chat->message}}</li>
         </div>

            @else
         <li class="left p-2 m-2">{{$chat->message}}</li>
          @endif
        @endforeach
    </ul>
    <form wire:submit.prevent="submit" class="form-inline row" >
      <div class="form-group col">
        <input wire:model="message" class="form-control input_msg" type="text" name="message" placeholder="Type Here.." />
     </div>
     {{-- <div class="form-group col">
        <input wire:model="to_id" class="form-control" type="text" name="to_id"  />
     </div> --}}
    <div class="form-group col">
        <button type="submit" class="btn btn-primary send_btn">Send</button>
    </div>

  </form>

</div>















