@extends('admin')
@section('title','Admin Chart')
@section('content')
 <div class="container w-50">

  <canvas id="polarChart"></canvas>
  <canvas id="birdsChart" width="600" height="550"></canvas>
</div>
@endsection
@section('script')
<script>
 let admin = [];
 let emp = [];

let x =JSON.parse('{!! json_encode($user) !!}');

x.forEach(function(data) {
      admin.push(data.name)
    });
console.log(admin);
x.forEach(function(data) {
      emp.push(data.emp_created)
    });
console.log(emp);

var ctx = document.getElementById("polarChart").getContext('2d');
					var myChart = new Chart(ctx, {
						type:  'polarArea',
						data: {
							labels: admin,
							datasets: [{
                                label: 'No.of.Employees Created',
								backgroundColor: [
									"#2ecc71",
									"#3498db",
									"#95a5a6",
									"#9b59b6",
									 "#f1c40f",
									 "#e74c3c",
									 "#34495e"
								],
								data: emp,
							}]
						},

					});
    </script>

@endsection
