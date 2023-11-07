<script>
    /* chart.js chart examples */

    // chart colors
    var colors = ['#3E97FF', '#E1E3EA'];
    /* bar chart */
    var chBar = document.getElementById("chBar");
    if (chBar) {
        new Chart(chBar, {
            type: 'bar',
            data: {
                labels: ["29/10", "30/10", "01/11", "02/11", "03/11", "04/11"],
                datasets: [{
                        data: [200, 300, 400, 500, 600, 3000],
                        backgroundColor: colors[0]
                    },
                    {
                        data: [1200, 600, 1400, 800, 2200, 4000],
                        backgroundColor: colors[1]
                    }
                ]
            },
            options: {
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        categoryPercentage: 0.5
                    }]
                }
            }
        });
    }
    //doughnut
    var ctxD = document.getElementById("doughnutChart").getContext('2d');
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Fanpage", "Profile", "Group"],
            datasets: [{
                data: [64, 10, 26],
                backgroundColor: ["#0B0044", "#FF5E5E", "#33DB9E"],
                hoverBackgroundColor: ["#0B0044", "#FF5E5E", "#33DB9E"]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            responsive: true
        }
    });
</script>