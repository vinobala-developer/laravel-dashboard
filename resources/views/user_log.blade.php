@extends('super_admin')
@section('content')
<div class="container row text-center m-3">
<div class="col-3">
<select class="form-select" name="employees" id="employees" aria-label="Default select example">
  <option value="">Employees</option>
   @foreach($emp as $emp)
  <option value={{$emp->id}}>{{$emp->name}}</option>
  @endforeach
</select>
</div>

<div class="col-3">
 <select class="form-select" name="role" id="role" aria-label="Default select example">
  <option value="">Role</option>
  <option value="admin">admin</option>
  <option value="user">user</option>
</select>
</div>

<div class="col-3">
    <input type="date" name="date" id="date" class="form-control">

</div>
<div class="col-3">
    <button type="button" name="filter" id="log_filter" class="btn btn-primary">Filter</button>
</div>
</div>
 <div class="container w-50">
    <canvas id="polarChart" width="600" height="300"></canvas>
    {{-- <canvas id="polarChart1" width="600" height="300"></canvas> --}}
</div>
<hr>
<div class="container row text-center m-1">
<div class="row">
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
        <th>Emp_id</th>
        <th>Role</th>
        <th>Log_in_Time</th>
        <th>Log_out_Time</th>
    </thead>
    <tbody id="tbody">
        <?php $id=1; ?>
        @foreach($lists as $data)
        <tr>
        {{-- <td>{{$data->id}}</td> --}}
         <td>{{$id++}}</td>
        <td>{{$data->name}}</td>
        <td>{{$data->emp_id}}</td>
         <td>{{$data->role}}</td>
        <td>{{$data->log_in}}</td>
        <td>{{$data->log_out}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="col-md-12">
{!! $lists->links() !!}
</div>

</div>

</div>
</div>
@endsection
@section('script')
<script>

let admin = [];
let emp = [];
let x =JSON.parse('{!! json_encode($user) !!}');

x.forEach(function(data) {
      admin.push(data.name);
    });
console.log(admin);
x.forEach(function(data) {
      emp.push(data.no_of_log_in);
    });
console.log(emp);

// chart(admin,emp);

// function chart(admin,emp){
var ctx = document.getElementById("polarChart").getContext('2d');
					var myChart = new Chart(ctx, {
						type:  'bar',
						data: {
							labels: admin,
							datasets: [{
                                label: 'No.of.login',
                                data: emp,
								backgroundColor: [
									"#2ecc71",
									"#3498db",
									"#95a5a6",
									"#9b59b6",
									 "#f1c40f",
									 "#e74c3c",
									 "#34495e"
								],

							}]
						},
                         options: {
                 plugins: {
                       title: {
                              display: true,
                              text: 'Users Activity Log (Weekly Report)'
                              }
                             }
                         }
					});

// }


        $("#log_filter").on('click',function(){
            let emp=$('#employees').val();
             let role=$('#role').val();
              let date=$('#date').val();
            console.log(emp+" "+role+" "+date);

        $.ajax({
        type:'GET',
        url:'/filter',
        data:{
            emp:emp,
            role:role,
            date:date
            },
        success:function(response){
            console.log(response);
            let html='';
            if(response[0].length > 0){
               for(let i=0;i<response[0].length;i++)
               {
                html+= '<tr>\
                    <td>'+(i+1)+'</td>\
                    <td>'+response[0][i].name+'</td>\
                    <td>'+response[0][i].emp_id+'</td>\
                    <td>'+response[0][i].role+'</td>\
                    <td>'+response[0][i].log_in+'</td>\
                    <td>'+response[0][i].log_out+'</td>\
                    </tr>';
               }
            }else{
                html+='<tr>\
                    <td colspan="6" class="no_data">No Data Found</td>\
                    </tr>';
            }
             $('#tbody').html(html);


let admin1 = [];
let emp1 = [];


response[1].forEach(function(data) {
      admin1.push(data.name);
    });

response[1].forEach(function(data) {
     emp1.push(data.no_of_log_in);
    });
console.log(admin1);
console.log(emp1);

myChart.data.datasets[0].data=emp1;
myChart.data.labels=admin1;
myChart.update();


        }

        });

        });
    </script>
@endsection
