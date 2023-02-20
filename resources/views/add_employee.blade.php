@extends('admin')
@section('title','Add Employee Details')
@section('content')
 <div class="container">
    @if ($errors->any())
    <ul>
        {!! implode('',$errors->all('<li>:message</li>'))!!}
    </ul>
    @endif

<form method="POST" action="/add">


<input type="hidden" name="_token" value="<?=csrf_token()?>"/>
    <!-- csrf token is to avoid hacking post data -->
  <div class="form-group m-2">
    <label for="name" class="mb-2">Name</label>
    <input type="text" class="form-control"  name="name" id="name" placeholder="Employee Name">
  </div>
  <div class="form-group m-2">
    <label for="mail_id" class="mb-2">E-mail</label>
    <input type="email" class="form-control" name="mail_id" id="mail_id" placeholder="Employee Mail_id">
  </div>
  <div class="form-group m-2">
    <label for="designation" class="mb-2">Designation</label>
    <input type="text" class="form-control" name="designation" id="designation" placeholder="Employee Designation">
  </div>
   <div class="form-group m-2">
    <label for="salary" class="mb-2">Salary</label>
    <input type="text" class="form-control" name="salary" id="salary" placeholder="Employee Salary">
  </div>
   <div class="form-group m-2">
    <label for="role" class="mb-2">Role</label>
    <input type="text" class="form-control" name="role" id="role" placeholder="Employee Role">
  </div>


  <button type="submit" class="btn btn-primary m-2">Add Details</button>
</form>
</div>
@endsection
