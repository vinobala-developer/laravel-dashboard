@extends('super_admin')

@section('content')
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" action="/inactive_status">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Change Confirmation</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="user_id" id="user_id" value=""/>
       Do You Want change the status of<p id="confirmation"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form method="POST" action="/active_status">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Status Change Confirmation</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="activeuser_id" id="activeuser_id" value=""/>
       Do You Want change the status of<p id="confirmation1"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit"  class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>
<div class="table-responsive m-1">
    @if (session('success'))
 <div class="alert alert-primary" role="alert">
    <?=session('success')?>
 </div>
  @endif
<table class="table table-striped text-center">
    <thead>
        <th>S.No</th>
        <th>Name</th>
        <th>Emp_id</th>
        <th>Role</th>
        <th>Active_Status</th>
        <th>Active/In_Active</th>
    </thead>
    <tbody id="tbody">
        <?php $id=1; ?>
        @foreach($lists as $data)
        <tr>
        {{-- <td>{{$data->id}}</td> --}}
         <td>{{$id++}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->id}}</td>
        <td>{{$data->role}}</td>
        <td>{{$data->active_status}}</td>
        @if ($data->active_status == 0)
        <td>

                <button class="btn btn-primary inactive" value="{{$data->id}}">In_Active</button>

        </td>
        @else
             <td><button class="btn btn-primary active" value="{{$data->id}}">Active</button></td>
        @endif

        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12">
{!! $lists->links() !!}
</div>

</div>


@endsection
@section('script')
<script>

 $(".inactive").on('click',function(e){
e.preventDefault();
let id=$(this).val();
$('#confirmation').html(id);
$('#user_id').val(id);
 $('#exampleModal').modal('show')

 });

 $(".active").on('click',function(e){
e.preventDefault();
let id=$(this).val();
$('#confirmation1').html(id);
$('#activeuser_id').val(id);
 $('#exampleModal1').modal('show')

 });



</script>
@endsection
