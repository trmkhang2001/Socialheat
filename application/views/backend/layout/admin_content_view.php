<!-- -------------- Content -------------- -->
<?php
$items = array("Total Mentions", "Total Audience", "Total Keywords", "Total User Engage");
?>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-fluid" id="kt_content_container">
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
    </div>
    <!--end::Container-->
</div>
<!--end::Content-->
<!-- -------------- End Content -------------- -->