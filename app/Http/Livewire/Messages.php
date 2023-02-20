<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;

class Messages extends Component
{
     public $from_id,$message,$to_id;
     public $chats;
    protected $rules=[
        'message'=>'required',
    ];

    public function mount($post){
        $this->to_id=$post;
        $this->from_id=auth()->user()->id;

    }
    public function submit()
    {
        $this->validate();

        // Execution doesn't reach here if validation fails.

        Chat::create([
            'from_id' => $this->from_id,
            'to_id' => $this->to_id,
            'message' => $this->message
        ]);

       $this->message='';
       // $this->resetInputFields();
    }
    // private function resetInputFields(){
    //     $this->message='';
    // }
    public function render()
    {
        //$this->chats=Chat::where(['to_id' => $this->to_id , 'from_id' => $this->from_id ])->orWhere(['to_id' => $this->from_id , 'from_id' => $this->to_id ])->get(['to_id','message','from_id']);

        $this->chats=DB::select(DB::raw("SELECT * FROM `chats` where (from_id=$this->from_id and to_id=$this->to_id) or (from_id=$this->to_id and to_id=$this->from_id)"));
        return view('livewire.messages');
    }
}
