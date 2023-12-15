<?php

/**
 * @var $item
 * @var $types
 * @var $channel_type
 * @var $iconImage
 * @var $channelTypes
 */
$socialLink = 'https://facebook.com/' . $item->post_id;
$typeInfo = $types[$item->type];
$link_image = '/assets/images/avartar_group.png';
if ($typeInfo['name'] != 'Group')
    $link_image = 'https://graph.facebook.com/' . $item->post_owner_id . '/picture?type=square&access_token=' . FB_TOKEN;
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
$colorBg = ['#ffd6cc', '#ccf2ff', '#ccffee', '#FFE000', '#ffd6cc'];
$colorText = ['#FF5E5E', '#3633DB', '#33DB9E', '#F6C000', '#FF5E5E'];
$user_id = $item->post_id;
$access_token = FB_TOKEN;
$keywords = explode(',', $item->keywords);
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

    .type_name {
        margin-right: 15px;
        padding: 3px;
        text-align: center;
        background: rgba(54, 51, 219, 0.05);
        color: #3633DB;
    }

    .data {
        background-color: #5E6278;
    }
</style>
<?php
$count = count($colorBg);
$indexColor = 0;
$colorKey = "";
$colorBgKey = "";
foreach ($keywords as $index => $keyword) :
    if ($keyword && !($keyword === 'datalytis')) :
        $slug = url_title(convert_accented_characters($keyword), '-', TRUE);
        if ($indexColor > 4) {
            $indexColor = 0;
        }
        $colorKey = $colorText[$indexColor];
        $colorBgKey = $colorBg[$indexColor];
        ++$indexColor;
        if ($keyword != " ") {
?>
            <div class="card my-5 pe-5">
                <div class="card-body row">
                    <div class="col-xxl-8">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex">
                                <div class="item-thumbnail">
                                    <span class="text-center">
                                        <a target="_blank" href="<?= $socialLink ?>">
                                            <div style="position: relative; margin-right: 15px;">
                                                <img style="width: 72px; height: 72px;" class="avatar rounded-circle <?= $classBorder ?> " alt="" src="<?= $link_image ?>">
                                                <span style="position: absolute; top: 0; right: -6px;" class="channel-icon"><img src="<?= $iconImage ?>" width="27"></span>
                                            </div>
                                        </a>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <a class="fw-bold title_social fs-2" target="_blank" style="color: #000000" href="<?= $socialLink ?>">
                                            <?= $item->social_name ?>
                                        </a>
                                        <span>
                                            <span style="color: #B5B5C3;"><?= date('j M Y \a\t H:ia ', strtotime($item->craw_date)) ?></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php if ($typeInfo['value'] == 2) {
                                $class_type = 'badge py-3 px-4 fs-3 badge-light-success fw-bold';
                            } else {
                                $class_type = 'badge py-3 px-4 fs-3 badge-light-primary fw-bold';
                            } ?>
                            <div class="">
                                <span style="padding: 5px;" class="<?= $class_type ?>"> <?= $typeInfo['name'] ?></span>
                            </div>
                        </div>
                        <div class=" d-flex flex-column mt-5 d-flex justify-content-end">
                            <div class="d-flex flex-column">
                                <p class="fs-7 fw-bold text text-justify-betwen item-content-read-less _items-post-content content-item" style="margin-bottom:0;overflow: hidden;word-break: break-word;font-size: 13px; color:#5E6278;">
                                    <?= html_entity_decode($item->content) ?></p>
                                <a target="_blank" href="<?= $linkDetail ?>" id="read_more" class="read_more">Read more</a>
                            </div>
                            <div class="d-flex d-flex justify-content-between clearfix mt-5 list-post-keywords">
                                <div class="col-md-8 col-xs-7">
                                    <span class="post_keywords col-md-8 col-xs-7 no-padding" data-keyword="">
                                        <span data-keyword="<?= $keyword ?>" style="color:<?= $colorKey ?>;border: 1px solid <?= $colorBgKey ?> !important;padding:3px"> <?= sprintf('%s', $keyword) ?></span>
                                    </span>
                                </div>
                                <div class="col-xs-4 col-md-4 d-flex justify-content-end">
                                    <span class="no-padding me-3">
                                        <a class="btn btn-sm fw-bold btn-primary text-uppercase pull-right btn-detail-item" style="background-color: #3633DB;" target="_blank" href="<?= $linkDetail ?>">View detail </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4">
                        <div class="d-flex justify-content-between text-center interaction visible-xl visible-lg hidden-xs hidden-sm hidden-md p-5">
                            <div class="item p-2 d-flex align-items-center">
                                <?php $none = true;
                                foreach ($brands as $brand) {
                                    if ($item->id == $brand->item_id && $keyword == $brand->keywords) {
                                        $none = false;
                                        if ($brand->rate === POSITIVE) {
                                ?>
                                            <div class="number fs-1 p-3 mt-3 text-primary">POSITIVE</div>
                                        <?php
                                            break;
                                        } elseif ($brand->rate === NEGATIVE) {
                                        ?>
                                            <div class="number fs-1 p-3 mt-3 text-danger">NEGATIVE</div>
                                        <?php
                                            break;
                                        } elseif ($brand->rate === NEUTRAL) { ?>
                                            <div class="number fs-1 p-3 mt-3 text-warning">NEUTRAL</div>
                                    <?php
                                            break;
                                        }
                                    } else {
                                        $none = true;
                                    }
                                }
                                if ($none) {
                                    ?>
                                    <div class="number fs-1 p-3 mt-3 text-info">UNKNOWN</div>
                                <?php
                                } ?>
                            </div>
                            <div class=""></div>
                            <div class="item p-2 <?= $class ?> ">
                                <div class="number fs-1 p-3 mt-3 "><?= ($item->total_like + $item->total_comment + $item->total_share) ?: 0 ?></div><br>
                                <span class="text-title fs-1 fw-bold text-success">ENGAGE</span>
                            </div>
                            <?php if ($item->channel_type === CHANNEL_TYPE_FACEBOOK) : ?>
                                <div class="item p-2 <?= $class ?> ">
                                    <div class="number fs-1 p-3 mt-3"><?= $item->count_d ?: 0 ?></div><br>
                                    <span class="text-title fs-1 fw-bold text-success">DATA</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
<?php }
    endif;
endforeach; ?>