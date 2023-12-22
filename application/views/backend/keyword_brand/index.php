<?php

/**
 * @var $total
 */
?>
<style>
    .header {
        height: 0px;
    }

    .total_number {
        font-size: 30px;
    }

    .icon_total i {
        font-size: 60px;
    }
</style>
<!-- Dashboard -->
<div class="content d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header mt-0 mt-lg-0 pt-lg-0" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{lg: '300px'}">
        <!--begin::Container-->
        <div class="container d-flex flex-stack flex-wrap gap-4 ms-0" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-10 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="d-flex flex-column text-dark fw-bold my-0 fs-1">Privia
                </h1>
                <!--end::Heading-->
            </div>
            <!--end::Page title=-->
            <!--begin::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <!-- -------------- /Header  -------------- -->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <!-- begin::Row -->
            <div class="row mb-xl-10 justify-content-between">
                <div class="col-xxl me-2 mb-2">
                    <div class="card p-3">
                        <div class="d-flex">
                            <div class="">
                                <img class="me-3" src="/assets/images/icon-total-mentions.png" alt="">
                                <!--begin::Section-->
                            </div>
                            <div class="">
                                <!--begin::Follower-->
                                <div class="">
                                    <span class="fw-bold fs-6 text-gray-500 fw-bold"> Total Mentions </span>
                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="fw-bold total_number text-gray-800"><?= number_format($total['totalMentions']) ?></span>
                                <!--end::Number-->
                            </div>
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="col-xxl me-2 mb-2">
                    <div class="card p-3">
                        <div class="d-flex">
                            <div class="">
                                <img class="me-3" src="/assets/images/icon-total-audience.png" alt="">
                                <!--begin::Section-->
                            </div>
                            <div class="">
                                <!--begin::Follower-->
                                <div class="">
                                    <span class="fw-bold fs-6 text-gray-500 fw-bold"> Total Engage </span>
                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="fw-bold total_number text-gray-800"><?= number_format($total['totalEngage']) ?></span>
                                <!--end::Number-->
                            </div>
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="col-xxl me-2 mb-2">
                    <div class="card p-3">
                        <div class="d-flex">
                            <div class="">
                                <img class="me-3" src="/assets/images/icon-total-keywords.png" alt="">
                                <!--begin::Section-->
                            </div>
                            <div class="">
                                <!--begin::Follower-->
                                <div class="">
                                    <span class="fw-bold fs-6 text-gray-500 fw-bold"> Active User </span>
                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="total_number fw-bold text-gray-800"><?= number_format($total['totalData']) ?></span>
                                <!--end::Number-->
                            </div>
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
            </div>
            <!-- begin::Row -->
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Chart widget 38-->
                    <div class="card card-flush h-md-100">
                        <!--begin::Header-->
                        <div class="card-header">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Last 7 days</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">Sentit</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex align-items-end px-0 pt-3 pb-5">
                            <!--begin::Chart-->
                            <div class="w-100 min-h-auto pe-6">
                                <div class="card-body">
                                    <canvas id="chBar"></canvas>
                                </div>
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Chart widget 38-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-4">
                    <!--begin::Engage widget 1-->
                    <div class="card h-md-100" dir="ltr">
                        <!--begin::Header-->
                        <div class="card-header">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Sentiment</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 1-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>
<script>
    /* chart.js chart examples */
    <?php if (!empty($chartRate)) { ?>
        // chart colors
        var colors = ['#3E97FF', '#E1E3EA', '#70FD8A'];
        /* bar chart */
        var chBar = document.getElementById("chBar");
        if (chBar) {
            new Chart(chBar, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($chartRate['label']) ?>,
                    datasets: [{
                            label: 'POSITIVE',
                            data: <?= json_encode($chartRate['positive']) ?>,
                            backgroundColor: colors[0]
                        },
                        {
                            label: 'NEGATIVE',
                            data: <?= json_encode($chartRate['negative']) ?>,
                            backgroundColor: colors[1]
                        },
                        {
                            label: 'NEUTRAL',
                            data: <?= json_encode($chartRate['neutral']) ?>,
                            backgroundColor: colors[2]
                        },
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
    <?php if (!empty($chartSentiment)) : ?>
        var ctxD = document.getElementById("doughnutChart");
        var myLineChart = new Chart(ctxD, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($chartSentiment['label']) ?>,
                datasets: [{
                    data: <?= json_encode($chartSentiment['data']) ?>,
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
    <?php endif; ?>
</script>