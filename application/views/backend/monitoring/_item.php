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
?>
<style>
    .data:hover {
        cursor: pointer;
        background-color: #F7F7F7;
        border-radius: 30px;
    }

    .read_more {
        color: #3E97FF;
        font-weight: bold;
    }

    .read_more:hover {
        opacity: 0.5;
    }

    .btn-detail-item:hover {
        opacity: 2;
    }

    .text-title {
        font-style: normal;
        font-weight: 500;
        font-size: 10px;
        line-height: normal;
        letter-spacing: -0.01em;
        color: #7F8089;

    }
</style>
<div class="d-flex justify-content-center card my-5 p-3">
    <div class="portlet-body" id="chats">
        <div class="d-flex flex-stack flex-grap row">
            <div class="d-flex justify-content-between">
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
                                    <img style="width: 72px; height: 72px;" class="avatar rounded-circle border border-primary border-3 <?= $classBorder ?> " alt="" src="https://cmu-cdn.vinfast.vn/2023/08/450bb39b-2debaaea-51b7-4cf1-ad81-ff163874d683.jpeg">
                                    <span style="position: absolute; top: 0; right: -6px;" class="channel-icon"><img src="<?= $iconImage ?>" width="27"></span>
                                </div>
                            </a>
                        </span>

                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="">
                            <h5 class="clearfix title-type">
                                <a target="_blank" style="color: #000000" href="<?= $socialLink ?>">
                                    <div class="d-flex justify-content-between">
                                        <b class="title_social fs-2"><?= $item->social_name ?></b>
                                    </div>
                                    <br>
                                    <span>
                                        <span style="color: #B5B5C3;"><?= date('j M Y \a\t H:ia ', strtotime($item->craw_date)) ?></span>
                                    </span>
                                </a>
                            </h5>
                            <div class="d-flex flex-column  ">
                                <div class="d-flex flex-column">
                                    <p class="text text-justify-betwen item-content-read-less _items-post-content content-item" style="margin-bottom:0;overflow: hidden;word-break: break-word;font-size: 13px;">
                                        <?= html_entity_decode($item->content) ?></p>
                                    <a target="_blank" href="<?= $linkDetail ?>" id="read_more" class="read_more">Read more</a>
                                </div>
                                <div class="d-flex d-flex justify-content-between clearfix mt-5 list-post-keywords">
                                    <div class="col-md-8 col-xs-7">
                                        <!-- <span class="post_keywords no-padding" data-keyword="">
                                            <?php
                                            // $indexColor = 0;
                                            // $bg_color = '';
                                            // $text_color = '';
                                            // foreach ($keywords as $index => $keyword) :
                                            //     if ($keyword) :
                                            //         $slug = url_title(convert_accented_characters($keyword), '-', TRUE);

                                            //         if (!empty($keywordsColor[$slug])) {
                                            //             $color = $keywordsColor[$slug];
                                            //         } else {
                                            //             if ($indexColor > 4) {
                                            //                 $indexColor = 0;
                                            //             }
                                            //             $bg_color = $colorBg[$indexColor];
                                            //             $text_color = $colorText[$indexColor];
                                            //             $color = $colorBg[$indexColor];
                                            //             $keywordsColor[$slug] = $color;
                                            //             $indexColor++;
                                            //         }

                                            ?>
                                                    <a href="#" class="border rounded-pill p-1 fw-bold" data-keyword="<?= $keyword ?>" style="color:<?= $text_color ?>;background-color:<?= $bg_color ?>"> <?= sprintf('%s', $keyword) ?></a>
                                            <?php //endif;
                                            //endforeach; 
                                            ?>
                                        </span> -->
                                        <span class="post_keywords col-md-8 col-xs-7 no-padding" data-keyword="">
                                            <?php
                                            $count = count($colorBg);
                                            $indexColor = 0;
                                            $colorKey = "";
                                            $colorBgKey = "";
                                            foreach ($keywords as $index => $keyword) :
                                                if ($keyword) :
                                                    $slug = url_title(convert_accented_characters($keyword), '-', TRUE);
                                                    if ($indexColor > 4) {
                                                        $indexColor = 0;
                                                    }
                                                    $colorKey = $colorText[$indexColor];
                                                    $colorBgKey = $colorBg[$indexColor];
                                                    ++$indexColor;

                                            ?>
                                                    <i data-keyword="<?= $keyword ?>" style="color:<?= $colorKey ?>;border: 1px solid <?= $colorBgKey ?> !important;padding:3px"> <?= sprintf('%s', $keyword) ?></i>
                                            <?php endif;
                                            endforeach; ?>
                                        </span>
                                    </div>
                                    <div class="col-xs-4 col-md-4">
                                        <span class="no-padding">
                                            <a class="btn btn-sm fw-bold btn-primary text-uppercase pull-right btn-detail-item" target="_blank" href="<?= $linkDetail ?>">View detail </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" data rounded clearfix">
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
                </div>

            </div>
        </div>

    </div>
</div>