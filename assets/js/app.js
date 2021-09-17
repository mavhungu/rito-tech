var ctx = document.getElementById("chartjs_bar").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:<?php echo json_encode($months); ?>,
datasets: [{
    backgroundColor: [
        "#5969ff",
        "#ff407b",
        "#25d5f2",
        "#ffc750",
        "#2ec551",
        "#7040fa",
        "#ff004e"
    ],
    data:<?php echo json_encode($total_Cost); ?>,
label: 'Total cost',


}]
},
options: {
    responsive: true,
        plugins: {
        legend: {
            position: 'top',
        },
        title: {
            display: true,
                text: 'Chart.js Bar Chart'
        }
    }
    /*plugins: {
        legend: {
            display: true,
            position: 'bottom',
            text: 'Chart.js Bar Chart',

            labels: {
                fontColor: '#71748d',
                fontFamily: 'Circular Std Book',
                fontSize: 14,
                text: 'Chart.js Bar Chart'
            },
        },
    }*/


}
});