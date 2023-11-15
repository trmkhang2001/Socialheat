<?php

/**
 * @var $item
 * @var  $key
 * @var  $user_id
 */
$ri = 0;
$count = (int)$item['count'];
$d_count = (int)$item['count_d'];
if ($count > 0 && $d_count > 0) {
    $ri = number_format(($d_count / $count) * 100, 2);
}
$item['from_name'] = word_limiter($item['from_name'], 9, ' ...');
$item['image_url'] = 'https://storage.googleapis.com/' . $item['image_url'];
$total_like = (int)$item['total_like'];
$total_share = (int)$item['total_share'];
$total_comment = (int)$item['total_comment'];
$colorBg = ['#ffd6cc', '#ccf2ff', '#ccffee', '#ffffcc', '#ffd6cc'];
$colorText = ['#FF5E5E', '#3633DB', '#33DB9E', '#F6C000', '#FF5E5E'];
?>
<style>
    .footer-item-post {
        position: relative;
    }

    .item-footer {
        position: absolute;
        right: 0px;
        font-weight: bold;
        color: gray;
    }

    .text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 10;
        /* number fs-1 p-3  of lines to show */
        line-clamp: 10;
        -webkit-box-orient: vertical;
    }

    .text-id {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        max-width: 250px;
    }

    .post_link {
        text-decoration: none;
    }
</style>
<div class="card card-flush">
    <!--begin::Header-->
    <div class="card-header pt-3 justify-content-start">
        <div class="" style="position: relative;">
            <img class="border border-primary border-3 rounded-circle" style="width: 72px; height: 72px;" src="https://cmu-cdn.vinfast.vn/2023/08/450bb39b-2debaaea-51b7-4cf1-ad81-ff163874d683.jpeg" alt="">
            <a target="_blank" style="position: absolute; top: 0; right: -6px; float: left;margin-right: 6px" href="https://facebook.com/<?php echo $key; ?>">
                <span style="position: absolute; top: 0; right: -6px;" class="channel-icon"><img src="/assets/images/icon-fb.png" width="27"></span>
            </a>
        </div>
        <!--begin::Title-->
        <div class="card-title align-items-start flex-column" style="margin-left: 15px;">
            <a target="_blank" href="https://facebook.com/<?php echo $key; ?>" class="card-label fs-1 fw-bold text-gray-800"><span>POST DETAIL</span></a>
            <span class="text-gray-400 mt-1 fw-semibold fs-6 text-id"><?= $item['created_post_date'] ?> | <a target="_blank" class="post_link" href="https://facebook.com/<?php echo $key; ?>"> <span class="text-gray-400 mt-1 fw-semibold fs-6 text-id">ID: <?= $item['post_id'] ?></span></a> </span>
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body px-0" style="padding-top: 0px; margin-top:0px">
        <!--begin::Chart-->
        <div class="w-100 min-h-auto">
            <div class="card-body">
                <p class="text" style="font-size: medium;"><?= html_entity_decode($item['content']) ?></p>
            </div>
        </div>
        <!--end::Chart-->
    </div>
    <!--end: Card Body-->
    <div class="card-footer">
        <div class="d-flex">
            <?php
            $keywords = explode(',', $item['keywords']);
            $indexColor = 0;
            $bg_color = '';
            $text_color = '';
            foreach ($keywords as $index => $keyword) :
                $slug = url_title(convert_accented_characters($keyword), '-', TRUE);
                if ($indexColor > 4) {
                    $indexColor = 0;
                }
                $bg_color = $colorBg[$indexColor];
                $text_color = $colorText[$indexColor];
                $indexColor++;
            ?>
                <a href="#" class="rounded-pill fw-bold" style="line-height: 30px;height: 30px;font-weight: 400;padding:0 10px;margin:3px; color: <?= $text_color ?>;background: <?= $bg_color ?>;"><?= $keyword ?></a>

            <?php endforeach; ?>
        </div>
        <div class="d-flex footer-item-post mt-3">
            <div class="d-flex">
                <div class="mx-7"><img src="/assets/images/ri_icon.png" width="27" height="auto" class="me-3"><span class="align-middle fw-bold"><?= $ri ?></span></div>
                <div class="me-7"><img src="/assets/images/like_icon.png" width="27" height="auto" class="me-3"><span class="align-middle fw-bold"><?= $total_like ?></span></div>
                <div class="me-7"><img src="/assets/images/comment_icon.png" width="27" height="auto" class="me-3"><span class="align-middle fw-bold"><?= $total_comment ?></span></div>
            </div>
            <div class="item-footer"><span>Update: <?php echo date('d/m/Y', strtotime($item['updated_date'])); ?></span></div>
        </div>
    </div>
</div>