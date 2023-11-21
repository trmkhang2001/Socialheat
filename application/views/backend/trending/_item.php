<?php

/**
 * @var $item
 * @var $types
 * @var $channel_type
 * @var $iconImage
 * @var $channelTypes
 */
$socialLink = 'https://facebook.com/' . $item->post_id;
$channelInfo = $channelTypes[$item->channel_type];
$iconImage = $channelInfo['icon_image'];
$channel_type = $item->channel_type;
$class = '';
$linkDetail = base_url('backend/monitoring/detail/' . $item->post_id);
$classBorder  = '';
if ($channel_type !== CHANNEL_TYPE_FACEBOOK) {
    $class = 'margin-left-100';
    $socialLink = $item->post_url;
    $linkDetail = $socialLink;
}
if ($channel_type === CHANNEL_TYPE_TWITTER) {
    $classBorder = 'border-twitter ';
}
if ($channel_type === CHANNEL_TYPE_INSTAGRAM) {
    $classBorder = 'border-instagram ';
}
$typeInfo = $types[$item->type];
$colorBg = ['#ffd6cc', '#ccf2ff', '#ccffee', '#FFE000', '#ffd6cc'];
$colorText = ['#FF5E5E', '#3633DB', '#33DB9E', '#F6C000', '#FF5E5E'];
$user_id = $item->post_id;
$access_token = FB_TOKEN;
?>
<style>
    .title_span {
        background-color: #F4D6D6;
        color: #D2A68D;
        padding: 5px;
    }

    .fw-bold i {
        color: #6993FF;
        margin-right: 3px;
    }
</style>
<div class="col-xl-4 mb-5 mb-xl-10">
    <!--begin::Chart widget 30-->
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header pt-7 mb-7">
            <!--begin::Title-->
            <div class="row">
                <div class="col-4">
                    <img class="rounded-circle" style="width: 72px; height: 72px;" src="/assets/images/no_avatar.png" alt="">
                </div>
                <div class="col-8">
                    <div class="align-items-start flex-column">
                        <span class="fw-bold text-gray-800 fs-3"><?= $item->social_name ?></span>
                        <br>
                        <span class="rounded text-gray-500 mt-2 fw-semibold fs-6 title_span">Sponspor</span>
                    </div>
                </div>
            </div>
            <!--end::Title-->
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body d-flex justify-content-between flex-column">
            <!--begin::Items-->
            <div class="d-flex flex-column">
                <img class="rounded" src="https://as2.ftcdn.net/v2/jpg/05/49/86/39/1000_F_549863991_6yPKI08MG7JiZX83tMHlhDtd6XLFAMce.jpg" alt="">
            </div>
            <div class="d-flex flex-column mt-3">
                <p class="text text-justify-betwen item-content-read-less fs-4"><?= html_entity_decode($item->content) ?></p>
                <a target="_blank" href="<?= $linkDetail ?>" id="read_more" class="read_more fw-bold">Read more</a>
            </div>
            <!--end::Items-->
            <div class="d-flex justify-content-between flex-row mt-2">
                <span class="fs-4 fw-bold">Catagory</span>
                <span class="text-muted">Oto</span>
            </div>
            <div class="d-flex justify-content-between flex-row mt-2">
                <span class="fs-4 fw-bold">Hasttag</span>
                <span class="text-muted">#pti,#mic</span>
            </div>
            <div class="d-flex justify-content-between flex-row mt-2">
                <span class="fs-4 fw-bold">Country</span>
                <span class="text-muted">Viet Nam</span>
            </div>
            <div class="d-flex justify-content-start flex-row mt-2">
                <span class="fw-bold me-5"> <i class="fa-solid fa-thumbs-up pe-2"></i><?= $item->total_like ?></span>
                <span class="fw-bold me-5"><i class="fa-solid fa-comment pe-2"></i><?= $item->total_comment ?></span>
                <span class="fw-bold"><i class="fa-solid fa-users pe-2"></i><?= $item->count_like_share ?: 0 ?> </span>
            </div>
            <div class="d-flex justify-content-between align-items-center flex-row mt-2">
                <span class="text-muted">Update: <?php echo date('d/m/Y', strtotime($item->craw_date)); ?></span>
                <a href="" class="btn btn-primary">Add Analytis</a>
            </div>
        </div>

        <!--end::Body-->
    </div>
    <!--end::Chart widget 30-->
</div>