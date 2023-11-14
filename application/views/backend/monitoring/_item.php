<?php

/**
 * @var $item
 * @var $types
 * @var $colorBg
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
        -webkit-line-clamp: 3;
        /* number fs-1 p-3  of lines to show */
        line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .chats {
        display: inline-flex;
    }

    .text-title {
        font-weight: bold;
        text-transform: uppercase;
        color: #B5B5C3;
    }

    .number {
        font-weight: bold;
    }

    ul {
        margin-top: 10px;
        margin-left: 15px;
    }

    li {
        list-style: none;
    }

    .item {
        margin: 2px;
    }
</style>
<div class="card my-5 p-3">
    <div class="portlet light bordered <?php echo !empty($is_animation) ? 'animation' : '' ?>">
        <div class="portlet-body" id="chats">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
                <div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                    <div class="d-flex flex-stack flex-grap row">
                        <div class="d-flex">
                            <?php

                            $image = $item->image;
                            if (!$image) {
                                $image = '/assets/images/icon.jpg';
                            }
                            $keywords = explode(',', $item->keywords);
                            ?>
                            <div class="d-flex message clearfix ">
                                <div class="item-thumbnail">
                                    <span class="text-center">
                                        <a target="_blank" href="<?= $socialLink ?>">
                                            <div style="position: relative; margin-right: 15px;">
                                                <img style="width: 72px; height: 72px;" class="avatar rounded-circle  <?= $classBorder ?> " alt="" src="<?= site_url($image) ?>">
                                                <span style="position: absolute; top: 0; right: -6px;" class="channel-icon"><img src="<?= $iconImage ?>" width="27"></span>
                                            </div>
                                        </a>
                                    </span>

                                </div>
                                <div class="d-flex justify-content-center flex-stuck">
                                    <div class="">
                                        <h5 class="clearfix title-type" style="position: relative;">
                                            <a style="color: #000000" href="<?= $socialLink ?>">
                                                <div>
                                                    <b class="fs-1"><?= $item->social_name ?></b>
                                                </div>
                                                <br>
                                                <span>
                                                    <b style="position: absolute; top:0px; right:10px; color:#6993FF;background-color:#CCFFFF; padding:5px;" class="rounded text-uppercase"><?= $typeInfo['name'] ?></b>
                                                    <span style="color: #B5B5C3;"><?= date('j M Y \a\t H:ia ', strtotime($item->craw_date)) ?></span>
                                                </span>
                                            </a>
                                        </h5>
                                        <div class="">
                                            <p class="text text-justify item-content-read-less _items-post-content content-item" style="margin-bottom:0;overflow: hidden;word-break: break-word;font-size: 13px;">
                                                <?= html_entity_decode($item->content) ?></p>
                                            <a href="#" id="read_more" class="read_more">Read more</a>
                                            <div class="d-flex justify-content-en clearfix mt-5 list-post-keywords">
                                                <span class="post_keywords col-md-8 col-xs-7 no-padding" data-keyword="">
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
                                                                $keywordsColor[$slug] = $color;
                                                                ++$indexColor;
                                                            }

                                                    ?>
                                                            <i data-keyword="<?= $keyword ?>" style="color:<?= $color ?>;border: 1px solid <?= $color ?> !important"> <?= sprintf('%s', $keyword) ?></i>
                                                    <?php endif;
                                                    endforeach; ?>
                                                </span>
                                                <span class="col-xs-5 col-md-4 no-padding">
                                                    <a class="btn btn-primary text-uppercase pull-right btn-detail-item" target="_blank" href="<?= $linkDetail ?>">View detail </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="rounded clearfix">
                                        <div class="d-flex justify-content-center text-center interaction visible-xl visible-lg hidden-xs hidden-sm hidden-md p-5">
                                            <div class="item p-3 <?= $class ?>">
                                                <span class="img"><img src="/assets/images/like_icon.png"></span><br>
                                                <div class="number fs-1 p-3 mt-3 "><?= $item->total_like ?></div><br>
                                                <span class="text-title">LIKE</span>
                                            </div>
                                            <div class="item p-3 <?= $class ?>">
                                                <span class="img"><img src="/assets/images/comment_icon.png"></span><br>
                                                <div class="number fs-1 p-3 mt-3"><?= $item->total_comment ?></div><br>
                                                <span class="text-title">COMMENT</span>
                                            </div>
                                            <div class="item p-3 <?= $class ?>">
                                                <span class="img"><img src="/assets/images/share_icon.png"></span><br>
                                                <div class="number fs-1 p-3 mt-3"><?= $item->total_share ?></div><br>
                                                <span class="text-title"><?= $channel_type === CHANNEL_TYPE_TWITTER ? 'Retweet' : 'Share' ?></span>
                                            </div>
                                            <?php if ($item->channel_type === CHANNEL_TYPE_FACEBOOK) : ?>
                                                <div class="item p-3 <?= $class ?> ">
                                                    <span class="img"><img src="/assets/images/like_share_icon.png"></span><br>
                                                    <div class="number fs-1 p-3 mt-3"><?= $item->count_like_share ?: 0 ?></div><br>
                                                    <span class="text-title">DATA LIKE & SHARE</span>
                                                </div>
                                                <div class="item p-3 <?= $class ?>">
                                                    <span class="img"><img src="/assets/images/comment_icon.png"></span><br>
                                                    <div class="number fs-1 p-3 mt-3"><?= $item->count_comment ?></div><br>
                                                    <span class="text-title">DATA COMMENT</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <!-- <ul class="clearfix list-inline interaction-mobile hidden-lg hidden-xl  ">
                                            <li><span class="text-title"><?= $item->total_like ?></span> Like</li>
                                            <li><span class="text-title"><?= $item->total_comment ?></span> Comment</li>
                                            <li>
                                                <span class="text-title"><?= $item->total_share ?> </span><?= $channel_type === CHANNEL_TYPE_TWITTER ? 'Retweet' : 'Share' ?>
                                            </li>
                                            <?php if ($channel_type === CHANNEL_TYPE_FACEBOOK) : ?>

                                                <li><span class="text-title"><?= $item->count_like_share ?: 0 ?></span> Data
                                                    like &
                                                    share
                                                </li>
                                                <li><span class="text-title"><?= $item->count_comment ?></span> Data comment
                                                </li>
                                            <?php endif; ?>
                                        </ul> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>