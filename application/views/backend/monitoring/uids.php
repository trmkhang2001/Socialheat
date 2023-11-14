<?php
$name = array("Ensure Gold", "#ensureGold", "#ensurevietnam", "#ensuregoldvietnam", "#suaensure");
/**
 * @var $total
 * @var $totalSocial
 * @var $item
 * @var $interactions
 * @var $userInfo
 * @var $totalKeywords
 */
?>
<style>
    .header {
        height: 0px;
    }

    .img {
        width: 72px;
        height: 72px;
    }

    .tgray {
        color: gray;
    }
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-fluid" id="kt_content_container">
        <h1 class="mb-7">Monitoring</h1>
        <!--begin::Row-->
        <div class="row g-5 g-xl-10 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xxl-8">
                <!--begin::Chart widget 38-->
                <?php $this->load->view('/backend/monitoring/_item_fb_post', ['item' => $content, 'key' => $content['post_id']]) ?>
                <!--end::Chart widget 38-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xxl-4">
                <!--begin::Engage widget 1-->
                <div class="row h-md-100 d-flex justify-content-center" dir="ltr">
                    <div class="card col-5 me-3 mb-3 p-10">
                        <img class="img" src="/assets/images/icon-total-audience.png" alt="">
                        <span class="tgray mt-3 fw-bold">Total Profile</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($content['count_d']); ?></div>
                    </div>
                    <div class="card col-5 mb-3 p-10">
                        <img class="img" src="/assets/images/icon_total_mail.png" alt="">
                        <span class="tgray mt-3 fw-bold">Total Email</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['email_count']) ?></div>
                    </div>
                    <div class="card col-5 me-3 p-10">
                        <img class="img" src="/assets/images/icon_location.png" alt="">
                        <span class="tgray mt-3 fw-bold">Location</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['relationship_count']) ?></div>
                    </div>
                    <div class="card col-5 p-10">
                        <img class="img" src="/assets/images/icon_relationship.png" alt="">
                        <span class="tgray mt-3 fw-bold">Relationship</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['relationship_count']) ?></div>
                    </div>
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col-->
        </div>
        <!-- end::Row -->
        <!-- begin::Row -->
        <div class="row">
            <!--begin::Col-->
            <div class="col-xxl">
                <div class="card" style="height: 1000px;">
                    <!--end::Col-->
                </div>
            </div>
        </div>
        <!-- end::Row -->
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>