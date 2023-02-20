@extends('admin')
@section('title','Employee Details')
@section('content')

<div class="row">
<a class="fs-5 d-flex justify-content-end text-decoration-none mb-3" href="add_employee"><button class="btn btn-primary" >Add Employee</button></a>
 @if (session('success'))
 <div class="alert alert-primary" role="alert">
    <?=session('success')?>
 </div>
  @endif
<div class="table-responsive">
<table class="table table-striped text-center">
    <thead>
        <th>S.No</th>
        <th>Name</th>
        <th>Mail_id</th>
        <th>Designation</th>
        <th>Salary</th>
        <th>Role</th>
        <th>Reference</th>
        <th>Eidt/Delete</th>
    </thead>
    <tbody>
        <?php $id=1; ?>
        @foreach($lists as $data)
        <tr>
        {{-- <td>{{$data->id}}</td> --}}
         <td>{{$id++}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->mail_id}}</td>
        <td>{{$data->designation}}</td>
        <td>{{$data->salary}}</td>
         <td>{{$data->role}}</td>
        <td>{{$data->reference_mail}}</td>
        <td><a class="me-2" href="edit/{{$data->id}}"><button class="btn btn-primary ">edit</button></a><a href="delete/{{$data->id}}"><button class="btn btn-danger" >delete</button></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12">
{!! $lists->links() !!}
</div>

</div>

</div>

@endsection
