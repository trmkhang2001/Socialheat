<?php

/**
 * @var $interact
 */
?>
<script>
    /* chart.js chart examples */
    <?php if (isset($interact)) { ?>
        // chart colors
        var colors = ['#3E97FF', '#E1E3EA'];
        /* bar chart */
        var chBar = document.getElementById("chBar");
        if (chBar) {
            new Chart(chBar, {
                type: 'bar',
                data: {
                    labels: ["<?php echo $interact[5]['date'] ?>", "<?php echo $interact[4]['date'] ?>", "<?php echo $interact[3]['date'] ?>", "<?php echo $interact[2]['date'] ?>", "<?php echo $interact[1]['date'] ?>", "<?php echo $interact[0]['date'] ?>"],
                    datasets: [{
                            label: 'User',
                            data: [<?= $interact[5]['count_user'] ?>, <?= $interact[4]['count_user'] ?>, <?= $interact[3]['count_user'] ?>, <?= $interact[2]['count_user'] ?>, <?= $interact[1]['count_user'] ?>, <?= $interact[0]['count_user'] ?>],
                            backgroundColor: colors[0]
                        },
                        {
                            label: 'Post',
                            data: [<?= $interact[5]['count_post'] ?>, <?= $interact[4]['count_post'] ?>, <?= $interact[3]['count_post'] ?>, <?= $interact[2]['count_post'] ?>, <?= $interact[1]['count_post'] ?>, <?= $interact[0]['count_post'] ?>],
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
    <?php } ?>
    //doughnut
    var ctxD = document.getElementById("doughnutChart");
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
    var ctxD = document.getElementById("doughnutChartGender");
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Male", "Female", "None"],
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
    var ctxD = document.getElementById("doughnutChartAge");
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["18-30", "30-40", "40-60"],
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
    var ctxD = document.getElementById("doughnutChartRelationship");
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["Single", "Married", "Other"],
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
    var ctxD = document.getElementById("doughnutChartFriends");
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["0-2000", "2000-4000", "4000+"],
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
    var ctxD = document.getElementById("doughnutChartFollows");
    var myLineChart = new Chart(ctxD, {
        type: 'doughnut',
        data: {
            labels: ["0-3000", "3000-6000", "6000+"],
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