<?php

/**
 * @var $totalMentions
 * @var $topKeywords
 * @var $totalKeyword
 * @var $totalAudience
 * @var $totalMentions
 * @var $totalEngage
 * @var $totalData
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
                <h1 class="d-flex flex-column text-dark fw-bold my-0 fs-1">Dashboard
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
            <div class="d-flex justify-content-between mb-5">
                <div class="card w-50 p-5 me-3">
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
                            <span class="fw-bold total_number text-gray-800"><?= number_format($totalMentions) ?></span>
                            <!--end::Number-->
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="card w-50 p-5 me-3">
                    <div class="d-flex">
                        <div class="">
                            <img class="me-3" src="/assets/images/icon-total-audience.png" alt="">
                            <!--begin::Section-->
                        </div>
                        <div class="">
                            <!--begin::Follower-->
                            <div class="">
                                <span class="fw-bold fs-6 text-gray-500 fw-bold"> Total Audience </span>
                            </div>
                            <!--end::Follower-->
                            <!--begin::Number-->
                            <span class="fw-bold total_number text-gray-800"><?= number_format($totalAudience) ?></span>
                            <!--end::Number-->
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="card w-50 p-5 me-3">
                    <div class="d-flex">
                        <div class="">
                            <img class="me-3" src="/assets/images/icon-total-keywords.png" alt="">
                            <!--begin::Section-->
                        </div>
                        <div class="">
                            <!--begin::Follower-->
                            <div class="">
                                <span class="fw-bold fs-6 text-gray-500 fw-bold"> Total Keywords </span>
                            </div>
                            <!--end::Follower-->
                            <!--begin::Number-->
                            <span class="total_number fw-bold text-gray-800"><?= number_format($totalKeyword) ?></span>
                            <!--end::Number-->
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="card w-50 p-5 me-3">
                    <div class="d-flex">
                        <div class="">
                            <img class="me-3" src="/assets/images/icon-total-user-engage.png" alt="">
                            <!--begin::Section-->
                        </div>
                        <div class="">
                            <!--begin::Follower-->
                            <div class="">
                                <span class="fw-bold fs-6 text-gray-500 fw-bold"> Total User Engage </span>
                            </div>
                            <!--end::Follower-->
                            <!--begin::Number-->
                            <span class="fw-bold total_number text-gray-800"><?= number_format($totalEngage) ?></span>
                            <!--end::Number-->
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
                <div class="card w-50 p-5 me-3">
                    <div class="d-flex">
                        <div class="icon_total">
                            <i style="color:#6392e3" class="fa-solid fa-database blue me-3 "></i>
                            <!--begin::Section-->
                        </div>
                        <div class="">
                            <!--begin::Follower-->
                            <div class="">
                                <span class="fw-bold fs-6 text-gray-500 fw-bold"> Total Data </span>
                            </div>
                            <!--end::Follower-->
                            <!--begin::Number-->
                            <span class="fw-bold total_number text-gray-800"><?= number_format($totalData) ?></span>
                            <!--end::Number-->
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
                                <span class="card-label fw-bold text-gray-800">Tương tác theo ngày</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-6">Số lượng bài post và user</span>
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
                                <span class="card-label fw-bold text-gray-800">Tương tác</span>
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
            <!-- begin::Row -->
            <!--begin::Tables Widget 9-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Top 10 KeyWord of the week</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th class="w-25px">
                                        NO.
                                    </th>
                                    <th class="min-w-500px">Keywords Name</th>
                                    <th class="min-w-150px">Post</th>
                                    <th class="min-w-150px">Engage</th>
                                    <th class="min-w-150px">Data</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <?php

                                foreach ($topKeywords as $index =>  $keyword) :
                                ?>
                                    <tr>
                                        <td>
                                            <span><?php echo number_format($index + 1) ?>.</span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="/backend/monitoring">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6"><?php echo $keyword->keywords ?></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold text-hover-primary d-block"><?php echo number_format($keyword->number_keyword) ?></span>

                                        </td>
                                        <td>
                                            <span class="text-muted me-2 fs--7 fw-bold "><?php echo number_format($keyword->total_engage) ?></span>
                                        </td>
                                        <td>
                                            <span class="text-muted me-2 fs--7 fw-bold "><?php echo number_format($keyword->total_data ?? 0) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 9-->
            <!-- end::Row -->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>
<script>
    /* chart.js chart examples */
    <?php if (!empty($chartPosts)) { ?>
        // chart colors
        var colors = ['#3E97FF', '#E1E3EA', '#70FD8A'];
        /* bar chart */
        var chBar = document.getElementById("chBar");
        if (chBar) {
            new Chart(chBar, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($chartPosts['label']) ?>,
                    datasets: [{
                            label: 'User',
                            data: <?= json_encode($chartPosts['data']) ?>,
                            backgroundColor: colors[0]
                        },
                        {
                            label: 'Post',
                            data: <?= json_encode($chartPosts['items']) ?>,
                            backgroundColor: colors[1]
                        },
                        {
                            label: 'Engage',
                            data: <?= json_encode($chartPosts['engage']) ?>,
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
    <?php if (!empty($chartInteractions)) : ?>
        var ctxD = document.getElementById("doughnutChart");
        var myLineChart = new Chart(ctxD, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($chartInteractions['label']) ?>,
                datasets: [{
                    data: <?= json_encode($chartInteractions['data']) ?>,
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