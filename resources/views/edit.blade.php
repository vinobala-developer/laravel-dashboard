@extends('admin')
@section('title','Edit Employee Details')
@section('content')
 <div class="container">
    @if ($errors->any())
    <ul>
        {!! implode('',$errors->all('<li>:message</li>'))!!}
    </ul>
    @endif
<h3 class="m-2">{{$user->name}}</h3>
<form method="POST" action="{{url('update/'.$user->id)}}">


<input type="hidden" name="_token" value="<?=csrf_token()?>"/>
    <!-- csrf token is to avoid hacking post data -->
  <div class="form-group m-2">
    <label for="name" class="mb-2">Name</label>
    <input type="text" class="form-control"  name="name" id="name" value="{{$user->name}}">
  </div>
  <div class="form-group m-2">
    <label for="mail_id" class="mb-2">E-mail</label>
    <input type="email" class="form-control" name="mail_id" id="mail_id" value="{{$user->mail_id}}" readonly>
  </div>
  <div class="form-group m-2">
    <label for="designation" class="mb-2">Designation</label>
    <input type="text" class="form-control" name="designation" id="designation" value="{{$user->designation}}">
  </div>
   <div class="form-group m-2">
    <label for="salary" class="mb-2">Salary</label>
    <input type="text" class="form-control" name="salary" id="salary" value="{{$user->salary}}">
  </div>
   <div class="form-group m-2">
    <label for="role" class="mb-2">Role</label>
    <input type="text" class="form-control" name="role" id="role"value="{{$user->role}}">
  </div>
  <button type="submit" class="btn btn-primary m-2">Update</button>
</form>
</div>
@endsection

