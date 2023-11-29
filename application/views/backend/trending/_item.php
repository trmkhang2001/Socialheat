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
$link_image = '/' . $item->image_url;
$link_avt = '/assets/images/avartar_group.png';
if ($typeInfo['name'] != 'Group')
    $link_avt = 'https://graph.facebook.com/' . $item->post_owner_id . '/picture?type=square&access_token=' . FB_TOKEN;
// var_dump($item);
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

    a {
        color: black;
    }

    a:hover {
        color: #6993FF;
        cursor: pointer;
    }
</style>
<div class="col-xl-4 mb-5 mb-xl-10">
    <!--begin::Chart widget 30-->
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <!-- <div class="card-header pt-7 mb-7">
            <div class="row">
                <div class="col-4">
                    <img class="rounded-circle" style="width: 72px; height: 72px;" src="/assets/images/no_avatar.png" alt="">
                </div>
                <div class="col-8">
                    <div class="align-items-start flex-column">
                        <a class="fw-bold fs-3"><?= $item->social_name ?></a>
                        <br>
                        <span class="rounded text-gray-500 mt-2 fw-semibold fs-6 title_span">Sponspor</span>
                    </div>
                </div>
            </div>
        </div> -->
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body d-flex flex-column">
            <!--begin::Items-->
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <!--begin::avatar-->
                <div class="me-12px" style="padding-right: 20px">
                    <div class="symbol symbol-58px symbol-lg-60px symbol-fixed position-relative">

                        <a target="_blank" href="https://facebook.com/102136945917952">
                            <img data-src="https://graph.facebook.com/102136945917952/picture?type=normal" width="60" height="60" class="lazy loaded" style="border: solid 1px #d0d0d0;border-radius: .475rem" alt="image" loading="lazy" src="<?= $link_avt ?>" data-ll-status="loaded">

                        </a>
                    </div>
                </div>
                <!--end::avatar-->
                <!--begin::RightGroup-->
                <div class="flex-grow-1 col-8 col-xxl-9">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::title-->
                        <div class="d-flex flex-column" style="width: 70%">
                            <a href="#" class="text-gray-900 text-hover-primary fs-3 fw-bold me-1 text-limit-length" style="width: 100%"><?= $item->social_name ?></a>
                            <div class="card-toolbar pt-1">
                                <span class="badge badge-light fw-bold me-auto px-4 py-3 text-color-D2A68D bg-AE7929">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_193_1305)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.856563 9.58334C0.613661 9.58334 0.416748 9.38534 0.416748 9.14111V0.858909C0.416748 0.614668 0.613661 0.416672 0.856563 0.416672H9.1436C9.3865 0.416672 9.58342 0.614668 9.58342 0.858909V9.14111C9.58342 9.38534 9.3865 9.58334 9.1436 9.58334C8.85039 9.58334 6.08804 9.58334 0.856563 9.58334Z" fill="#9EBFFF" stroke="#3E97FF" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.05442 3.72646H7.14731H7.04013C6.75888 3.72646 6.53088 3.95446 6.53088 4.23571V5.25454H8.05442L7.83127 6.78179H6.53088V9.58333H4.85546V6.78179H3.47217V5.25454H4.83758L4.85546 3.80488L4.85046 3.28529C4.84342 2.55161 5.43248 1.95114 6.16615 1.94409C6.1704 1.94405 6.17465 1.94403 6.17892 1.94403H8.05442V3.72646Z" fill="#F8F5FF"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_193_1305">
                                                <rect width="10" height="10" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="uid"></span><a target="_blank" href="https://facebook.com/<?= $item->post_id ?>"><?= $item->post_id ?></a>
                                </span>
                            </div>
                        </div>
                        <!--end::title-->
                        <!--begin::icon-->
                        <div class="d-flex py-2 py-lg-0" style="gap: 10px">
                            <a href="javascript::void()" data-id="IW8Z6B8C" class="action-report">
                                <span class="pe-3px">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="28" height="28" rx="6" fill="#E8FFF3"></rect>
                                        <path d="M17.6834 19.8577L14.5552 18.1342C14.3871 18.0415 14.1968 17.9928 14.0031 17.9928C13.8095 17.9928 13.6191 18.0415 13.4511 18.1342L10.3229 19.8577C10.1554 19.9507 9.96553 19.9998 9.77218 20C9.57883 20.0002 9.38881 19.9516 9.22113 19.859C9.05345 19.7663 8.91398 19.633 8.81669 19.4722C8.7194 19.3114 8.6677 19.1289 8.66675 18.9428V10.6265C8.66837 9.92937 8.95731 9.26132 9.47017 8.76893C9.98304 8.27653 10.6779 8 11.4024 8H16.6039C17.3273 8.00156 18.0206 8.27878 18.5322 8.77101C19.0437 9.26324 19.3318 9.9304 19.3334 10.6265V18.9428C19.3319 19.128 19.28 19.3096 19.1831 19.4695C19.0861 19.6295 18.9473 19.7623 18.7806 19.8547C18.6138 19.9472 18.4249 19.9961 18.2324 19.9966C18.04 19.9971 17.8507 19.9492 17.6834 19.8577Z" fill="#50CD89"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <a href="#" class="action-favorite " data-id="IW8Z6B8C">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                <span class="pe-3px">
                                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="28" height="28" rx="6" fill="#FFF8DD"></rect>
                                        <g clip-path="url(#clip0_193_1315)">
                                            <path d="M15.023 7.15877C14.8295 6.76898 14.4315 6.52287 13.9963 6.52399C13.5612 6.52511 13.1644 6.77326 12.973 7.16404L11.2007 10.7816L7.16907 11.3662C6.73879 11.4286 6.38119 11.7297 6.24647 12.1431C6.11175 12.5565 6.22325 13.0105 6.53414 13.3144L9.45606 16.171L8.75895 20.1356C8.68326 20.5661 8.85971 21.002 9.21351 21.2586C9.56731 21.5153 10.0365 21.5476 10.4222 21.342L13.9993 19.435L17.5773 21.3421C17.9628 21.5475 18.4316 21.5153 18.7854 21.259C19.1391 21.0028 19.3158 20.5673 19.2407 20.137L18.5485 16.171L21.4661 13.3137C21.7764 13.0098 21.8876 12.5561 21.753 12.143C21.6184 11.73 21.2612 11.429 20.8313 11.3663L16.821 10.7816L15.023 7.15877Z" fill="#F7C000"></path>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_193_1315">
                                                <rect width="16" height="16" fill="white" transform="translate(6 6)"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::icon-->
                    </div>
                </div>
                <!--end::RightGroup-->
            </div>
            <div class="d-flex flex-column">
                <a href="">
                    <img class="rounded img-thum" src="<?= $link_image ?>" alt="">
                </a>
            </div>
            <div class="d-flex flex-column my-3">
                <p class="text text-justify-betwen item-content-read-less fs-4"><?= html_entity_decode($item->content) ?></p>
                <a target="_blank" href="<?= $linkDetail ?>" id="read_more" class="read_more fw-bold">Read more</a>
            </div>
            <!--end::Items-->
            <div class="">
                <div class="d-flex justify-content-start flex-row mt-2">
                    <span class="fw-bold me-5"> <i class="fa-solid fa-thumbs-up pe-2"></i><?= $item->total_like ?: 0 ?></span>
                    <span class="fw-bold me-5"><i class="fa-solid fa-comment pe-2"></i><?= $item->total_comment ?: 0 ?></span>
                    <span class="fw-bold"><i class="fa-solid fa-users pe-2"></i><?= $item->count_like_share ?: 0 ?> </span>
                </div>
                <div class="d-flex justify-content-between align-items-center flex-row mt-2">
                    <span class="text-muted">Update: <?php echo date('d/m/Y', strtotime($item->craw_date)); ?></span>
                    <a href="" class="btn btn-primary" style="background-color: #3633DB;">Add Analytis</a>
                </div>
            </div>
        </div>

        <!--end::Body-->
    </div>
    <!--end::Chart widget 30-->
</div>