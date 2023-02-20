<canvas id="polarChart" width="600" height="300"></canvas>

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

var ctx = document.getElementById("polarChart").getContext('2d');
					var myChart = new Chart(ctx, {
						type:  'bar',
						data: {
							labels: admin,
							datasets: [{
                                label: 'No.of.login',
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
                         options: {
                 plugins: {
                       title: {
                              display: true,
                              text: 'Users Activity Log (Weekly Report)'
                              }
                             }
                         }
					});
</script>
