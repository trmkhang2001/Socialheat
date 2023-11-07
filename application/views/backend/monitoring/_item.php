<?php

/**
 * @var $item
 * @var $types
 * @var $colorBg
 * @var $channel_type
 * @var $iconImage
 * @var $channelTypes
 */
$colorText = ['#FF5E5E', '#3633DB', '#33DB9E', '#F6C000', '#FF5E5E'];
$socialLink = 'https://facebook.com/' . $item->post_id;
$channelInfo = $channelTypes[$item->channel_type];
$iconImage = $channelInfo['icon_image'];
$channel_type = $item->channel_type;
$class = '';
$linkDetail = base_url('backend/clients/detail/' . $item->post_id);
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
?>
<style>
    .margin-left-100 {
        margin-left: 100px !important;
    }

    .border-instagram {
        border: 3px solid #f7504f;
    }

    .border-twitter {
        border: 3px solid #1da1f1;
    }

    .text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        /* number of lines to show */
        line-clamp: 2;
        -webkit-box-orient: vertical;
    }
</style>
<ul class="card pb-3">
    <li class="flex-row card m-0">
        <?php

        $image = $item->image;
        if (!$image) {
            $image = '/assets/images/icon.jpg';
        }
        $keywords = explode(',', $item->keywords);
        ?>
        <div class="row">
            <div class="col flex-wrap">
                <div class="row ">
                    <div class="col col-lg-2">
                        <div class="pt-3">
                            <span class="text-center" style="display:block;position: relative;">
                                <a target="_blank" href="<?= $socialLink ?>">
                                    <img class="avatar <?= $classBorder ?> " alt="" src="<?= site_url($image) ?>">
                                    <span class="channel-icon"><img src="<?= $iconImage ?>" width="27"></span>
                                </a>
                            </span>

                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start flex-wrap">
                                <div class="col-6">
                                    <div class="row">
                                        <h5 class="mt-5">
                                            <a style="color: #000000" href="<?= $socialLink ?>"><b><?= $item->social_name ?></b>
                                            </a>
                                            <span class="rounded-pill p-2" style="background: #ccf2ff; color: #3633DB;"><?= $typeInfo['name'] ?></span>
                                        </h5>
                                    </div>
                                    <div class="row">
                                        <span style="color: #888C9F; font-size: 11px"><?= date('j M Y \a\t H:ia ', strtotime($item->craw_date)) ?></span>
                                    </div>
                                </div>
                                <p class="text text-justify fw-bold item-content-read-less _items-post-content content-item pt-2" style="margin-bottom:0;overflow: hidden;word-break: break-word;font-size: 14px;">
                                    <?= html_entity_decode($item->content) ?></p>
                                <a href="#" class="read_more">Read more</a>
                                <div class="mt-5">
                                    <div class="d-flex bd-highlight">
                                        <span class="post_keywords p-2 flex-grow-1 bd-highlight" data-keyword="">
                                            <?php
                                            $count = count($colorBg);
                                            $indexColor = 0;
                                            foreach ($keywords as $index => $keyword) :
                                                if ($keyword) :
                                                    $slug = url_title(convert_accented_characters($keyword), '-', TRUE);

                                                    if (!empty($keywordsColor[$slug])) {
                                                        $color = $keywordsColor[$slug];
                                                    } else {
                                                        if ($indexColor > 4) {
                                                            $indexColor = 0;
                                                        }
                                                        $color = $colorBg[$indexColor];
                                                        $text_color = $colorText[$indexColor];
                                                        $keywordsColor[$slug] = $color;
                                                        ++$indexColor;
                                                    }

                                            ?>
                                                    <i class="rounded-pill p-2" data-keyword="<?= $keyword ?>" style="color:<?= $text_color ?>;border: 1px solid <?= $color ?> !important"> <?= sprintf('%s', $keyword) ?></i>
                                            <?php endif;
                                            endforeach; ?>
                                        </span>
                                        <span class="flex-shrink-1 bd-highlight">
                                            <a class="btn btn-primary btn-detail-item" target="_blank" href="<?= $linkDetail ?>">View detail </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col d-flex flex-wrap mt-2">
                <div class="flex-pill rounded  py-3 px-4  mb-3 text-center">
                    <div class="img pb-20">
                        <img src="/assets/images/like_icon.png" alt="">
                    </div>
                    <div class="fw-bold">
                        <span>LIKE</span>
                    </div>
                    <div class="fw-bold">
                        <span><?= $item->total_like ?></span>
                    </div>
                </div>
                <div class="  py-3 px-4  mb-3 text-center">
                    <div class="img pb-20"><img src="/assets/images/comment_icon.png" alt=""></div>
                    <div class="fw-bold">
                        <span>COMMENT</span>
                    </div>
                    <div class="fw-bold">
                        <span><?= $item->total_comment ?></span>
                    </div>
                </div>
                <div class="  py-3 px-4  mb-3 text-center">
                    <div class="img pb-20"><img src="/assets/images/share_icon.png" alt=""></div>
                    <div class="fw-bold">
                        <span><?= $channel_type === CHANNEL_TYPE_TWITTER ? 'Retweet' : 'Share' ?></span>
                    </div>
                    <div class="fw-bold">
                        <span><?= $item->total_share ?></span>
                    </div>
                </div>
                <div class="  py-3 px-4  mb-3 text-center">
                    <div class="img pb-20"><img src="/assets/images/like_share_icon.png" alt=""></div>
                    <div class="fw-bold">
                        <span>DATA LIKE & SHARE</span>
                    </div>
                    <div class="fw-bold">
                        <span><?= $item->count_like_share ?: 0 ?></span>
                    </div>
                </div>
                <div class="  py-3 px-4  mb-3 text-center">
                    <div class="img pb-20"><img src="/assets/images/data_commnet_icon.png" alt=""></div>
                    <div class="fw-bold">
                        <span>DATA COMMENT</span>
                    </div>
                    <div class="fw-bold">
                        <span><?= $item->count_comment ?></span>
                    </div>
                </div>
            </div>
        </div>
    </li>

</ul>