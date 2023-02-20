let admin = [];
let emp = [];
let x = JSON.parse("{!! json_encode($user) !!}");

for (j = 0; j < x.length; j++) {
    admin[j] = x[j].name;
}
console.log(admin);
for (j = 0; j < x.length; j++) {
    emp[j] = x[j].emp_created;
}
console.log(emp);
//name[]=x[0].name;
var ctx = document.getElementById("polarChart").getContext("2d");
var myChart = new Chart(ctx, {
    type: "polarArea",
    data: {
        labels: admin,
        datasets: [
            {
                backgroundColor: [
                    "#2ecc71",
                    "#3498db",
                    "#95a5a6",
                    "#9b59b6",
                    "#f1c40f",
                    "#e74c3c",
                    "#34495e",
                ],
                data: emp,
            },
        ],
    },
});
