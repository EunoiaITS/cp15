
// pie chart
var randomScalingFactor = function() {
    return Math.round(Math.random() * 50);
};

var config = {
    type: 'pie',
    data: {
        labels: ["Supplier-1", "Supplier-2", "Supplier-3"],
        datasets: [{
            data: [300, 600, 1800],
            backgroundColor: [
                '#365A86',
                '#fff',
                '#4876AD'
            ],
            borderWidth: [5,5,5],
            borderColor: ['#1031a5','#1031a5','#1031a5']
        }],
    },
    options: {
        responsive: true,
        legend: {
            display: true,
            position: 'bottom'
        },
    }
};

window.onload = function() {
    var ctx = document.getElementById("chart-area").getContext("2d");
    window.myPie = new Chart(ctx, config);

    var ctxt = document.getElementById("chart-area2").getContext("2d");
    window.myPie = new Chart(ctxt, config);

    var ctxts = document.getElementById("chart-area3").getContext("2d");
    window.myPie = new Chart(ctxts, config);

    var ctxtt = document.getElementById("chart-area4").getContext("2d");
    window.myPie = new Chart(ctxtt, config);
};