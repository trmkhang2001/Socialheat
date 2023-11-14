<?php
$name = array("Ensure Gold", "#ensureGold", "Ensure Gold", "#ensurevietnam", "#ensuregoldvietnam", "#suaensure", "#suaensure", "#suaensure", "#suaensure", "#suaensure");
/**
 * @var $total
 * @var $totalSocial
 * @var $item
 * @var $interactions
 * @var $userInfo
 * @var $totalKeywords
 * @var $topKey
 */
?>
<style>
    .header {
        height: 0px;
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
            <div class="row mb-5">
                <div class="col-sm mb-4">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex align-items-center flex-row-fluid">
                            <img class="me-3" src="/assets/images/icon-total-mentions.png" alt="">
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Follower-->
                                <div class="m-0 mb-3">
                                    <span class="fw-semibold fs-6 text-gray-500 fw-bold">
                                        Total Mentions </span>

                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= number_format($totalSocial['Total Mentions']) ?></span>
                                <!--end::Number-->
                            </div>
                            <!--end::Section-->
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-4">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex align-items-center flex-row-fluid">
                            <img class="me-3" src="/assets/images/icon-total-audience.png" alt="">
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Follower-->
                                <div class="m-0 mb-3">
                                    <span class="fw-semibold fs-6 text-gray-500 fw-bold">
                                        Total Audience </span>

                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= number_format($totalSocial['Total Audience']) ?></span>
                                <!--end::Number-->
                            </div>
                            <!--end::Section-->
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-4">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex align-items-center flex-row-fluid">
                            <img class="me-3" src="/assets/images/icon-total-keywords.png" alt="">
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Follower-->
                                <div class="m-0 mb-3">
                                    <span class="fw-semibold fs-6 text-gray-500 fw-bold">
                                        Total Keywords </span>

                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= number_format($totalSocial['Total Keywords']) ?></span>
                                <!--end::Number-->
                            </div>
                            <!--end::Section-->
                        </div>
                    </div>
                </div>
                <div class="col-sm mb-4">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex align-items-center flex-row-fluid">
                            <img class="me-3" src="/assets/images/icon-total-user-engage.png" alt="">
                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Follower-->
                                <div class="m-0 mb-3">
                                    <span class="fw-semibold fs-6 text-gray-500 fw-bold">
                                        Total User Engage </span>

                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?= number_format($totalSocial['Total User Engage']) ?></span>
                                <!--end::Number-->
                            </div>
                            <!--end::Section-->
                        </div>
                    </div>
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
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">Số lượng bài post và user</span>
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
                                    <th class="min-w-500px">Audience Name</th>
                                    <th class="min-w-150px">Post</th>
                                    <th class="min-w-150px">Engage</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($topKey as $key) {
                                    $i++ ?>
                                    <tr>
                                        <td>
                                            <span><?php echo number_format($i) ?>.</span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-start flex-column">
                                                <span class="text-dark fw-bold text-hover-primary fs-6"><?php echo $key['key'] ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold text-hover-primary d-block"><?php echo number_format($key['count']) ?></span>

                                        </td>
                                        <td>
                                            <span class="text-muted me-2 fs--7 fw-bold "><?php echo number_format($key['engage']) ?></span>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
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