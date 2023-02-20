@extends('admin')
@section('title','Profile')
@section('content')
 <div class="container">
    @if ($errors->any())
    <ul>
        {!! implode('',$errors->all('<li>:message</li>'))!!}
    </ul>
    @endif

<form method="POST" action="{{url('profile_edit/'.$user->id)}}">

<input type="hidden" name="_token" value="<?=csrf_token()?>"/>
    <!-- csrf token is to avoid hacking post data -->
  <div class="form-group m-2">
    <label for="name" class="mb-2">Name</label>
    <input type="text" class="form-control"  name="name" id="name" value="{{$user->name}}">
  </div>
  <div class="form-group m-2">
    <label for="mail_id" class="mb-2">E-mail</label>
    <input type="email" class="form-control" name="mail_id" id="mail_id" value="{{$user->mail_id}}">
  </div>
   <div class="form-row row">
    <div class="form-group col-md-6 ">
      <label for="inputPassword4" class="mb-2">New Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword5" class="mb-2"> Confirm Password</label>
      <input type="password" name="password_confirmation" class="form-control" id="inputPassword5" placeholder="Password">
    </div>


  <button type="submit" class="btn btn-primary m-2">Update Profile</button>
</form>
 </div>
@endsection
