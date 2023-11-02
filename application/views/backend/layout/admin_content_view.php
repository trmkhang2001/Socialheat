<!-- -------------- Content -------------- -->
<?php
$items = array("Total Mentions", "Total Audience", "Total Keywords", "Total User Engage");
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-fluid" id="kt_content_container">
        <!-- begin::Row -->
        <div class="row">
            <?php foreach ($items as $value) {
            ?>
                <div class="col-sm mb-4">
                    <div class="card h-lg-100">
                        <div class="card-body d-flex align-items-center flex-row-fluid">
                            <!--begin::Icon-->
                            <div class="m-0 me-5">
                                <i class="ki-outline ki-compass fs-2hx text-gray-600"></i>

                            </div>
                            <!--end::Icon-->

                            <!--begin::Section-->
                            <div class="d-flex flex-column my-7">
                                <!--begin::Follower-->
                                <div class="m-0">
                                    <span class="fw-semibold fs-6 text-gray-500">
                                        <?php echo $value ?> </span>

                                </div>
                                <!--end::Follower-->
                                <!--begin::Number-->
                                <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">123</span>
                                <!--end::Number-->
                            </div>
                            <!--end::Section-->


                        </div>
                    </div>
                </div>
            <?php
            } ?>
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
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column flex-center">
                        <!--begin::Heading-->
                        <div class="mb-2">
                            <!--begin::Title-->
                            <h1 class="fw-semibold text-gray-800 text-center lh-lg">Try out our
                                <br />new
                                <span class="fw-bolder">Invoice Manager</span>
                            </h1>
                            <!--end::Title-->
                            <!--begin::Illustration-->
                            <div class="py-10 text-center">
                                <img src="assets/media/svg/illustrations/easy/2.svg" class="theme-light-show w-200px" alt="" />
                                <img src="assets/media/svg/illustrations/easy/2-dark.svg" class="theme-dark-show w-200px" alt="" />
                            </div>
                            <!--end::Illustration-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Links-->
                        <div class="text-center mb-1">
                            <!--begin::Link-->
                            <a class="btn btn-sm btn-primary me-2" data-bs-target="#kt_modal_new_address" data-bs-toggle="modal">Try Now</a>
                            <!--end::Link-->
                            <!--begin::Link-->
                            <a class="btn btn-sm btn-light" href="#">Learn More</a>
                            <!--end::Link-->
                        </div>
                        <!--end::Links-->
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
<!-- -------------- End Content -------------- -->