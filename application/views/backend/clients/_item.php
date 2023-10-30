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
$linkDetail = base_url('backend/clients/detail/' . $item->post_id);
$classBorder  = '';
if ($channel_type !== CHANNEL_TYPE_FACEBOOK)
{
	$class = 'margin-left-100';
	$socialLink = $item->post_url;
	$linkDetail = $socialLink;
}
if($channel_type === CHANNEL_TYPE_TWITTER){
	$classBorder = 'border-twitter ';
}
if($channel_type === CHANNEL_TYPE_INSTAGRAM){
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
</style>
<div class="portlet light bordered <?php echo ! empty($is_animation) ? 'animation' : '' ?>">
	<div class="portlet-body" id="chats">
		<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;">
			<div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1"
				 data-rail-visible1="1" data-initialized="1">
				<ul class="chats">
					<li class="">
						<?php

						$image = $item->image;
						if ( ! $image)
						{
							$image = '/assets/images/icon.jpg';
						}
						$keywords = explode(',', $item->keywords);
						?>
						<div class="message clearfix">
							<div class="item-thumbnail">
								<span class="text-center" style="display:block;position: relative;">
									<a target="_blank" href="<?= $socialLink ?>">
										<img class="avatar <?= $classBorder?> " alt="" src="<?= site_url($image) ?>">
										<span class="channel-icon"><img src="<?= $iconImage ?>" width="27"></span>
									</a>
								</span>

							</div>
							<div class="col-md-12 col-lg-10 col-xl-5 margin-bottom-15">
								<h5 class="clearfix title-type">
									<a style="color: #000000"
									   href="<?= $socialLink ?>"><b><?= $item->social_name ?></b>
										<br>
										<small><b class="text-uppercase"><?= $typeInfo['name']?> - </b><?= date('j M Y \a\t H:ia ', strtotime($item->craw_date)) ?></small>
									</a>
									<span class="pull-right post-id">Post: <a style=" text-decoration: underline;"
																			  target="_blank"
																			  href="<?= $socialLink ?>"><?= $item->post_id ?></a> </span>
								</h5>

								<p class=" text-justify item-content-read-less _items-post-content content-item"
								   style="margin-bottom:0;overflow: hidden;word-break: break-word;font-size: 13px;">
									<?= html_entity_decode($item->content) ?></p>
								<a href="#" class="read_more">Read more</a>
								<div class="clearfix margin-top-10 list-post-keywords">
										<span class="post_keywords col-md-8 col-xs-7 no-padding" data-keyword="">
										<?php
										$count = count($colorBg);
										$indexColor = 0;
										foreach ($keywords as $index => $keyword):
											if($keyword):
											$slug = url_title(convert_accented_characters($keyword), '-', TRUE);

											if ( ! empty($keywordsColor[$slug]))
											{
												$color = $keywordsColor[$slug];
											} else
											{
												if ($indexColor > 4)
												{
													$indexColor = 0;
												}
												$color = $colorBg[$indexColor];
												$keywordsColor[$slug] = $color;
												++$indexColor;
											}

											?>
											<i data-keyword="<?= $keyword ?>"
											   style="color:<?= $color ?>;border: 1px solid <?= $color ?> !important">	<?= sprintf('%s', $keyword) ?></i>
										<?php endif;endforeach; ?>
										</span>
									<span class="col-xs-5 col-md-4 no-padding">
											<a class="btn btn-primary text-uppercase pull-right btn-detail-item"
											   target="_blank"
											   href="<?= $linkDetail ?>">View detail </a>
									</span>
								</div>
							</div>
							<div class=" clearfix col-md-12 col-lg-12 col-xl-6 items-interaction">
								<ul class="list-inline interaction visible-xl visible-lg hidden-xs hidden-sm hidden-md ">
									<li class="<?= $class ?>">
										<span class="img"><img src="/assets/images/like_icon.png"></span><br>
										<span class="number"><?= $item->total_like ?></span><br>
										<span class="text-title">LIKE</span>

									</li>
									<li class="<?= $class ?>">
										<span class="img"><img src="/assets/images/comment_icon.png"></span><br>
										<span class="number"><?= $item->total_comment ?></span><br>
										<span class="text-title">COMMENT</span>
									</li>
									<li class="<?= $class ?>">
										<span class="img"><img src="/assets/images/share_icon.png"></span><br>
										<span class="number"><?= $item->total_share ?></span><br>
										<span class="text-title"><?= $channel_type === CHANNEL_TYPE_TWITTER ? 'Retweet' : 'Share' ?></span>
									</li>
									<?php if ($item->channel_type === CHANNEL_TYPE_FACEBOOK): ?>
										<li>
											<span class="img"><img src="/assets/images/like_share_icon.png"></span><br>
											<span class="number"><?= $item->count_like_share ?: 0 ?></span><br>
											<span class="text-title">DATA LIKE & SHARE</span>
										</li>
										<li>
											<span class="img"><img src="/assets/images/comment_icon.png"></span><br>
											<span class="number"><?= $item->count_comment ?></span><br>
											<span class="text-title">DATA COMMENT</span>
										</li>
									<?php endif; ?>
								</ul>
								<ul class="clearfix list-inline interaction-mobile hidden-lg hidden-xl  ">
									<li><span class="text-title"><?= $item->total_like ?></span> Like</li>
									<li><span class="text-title"><?= $item->total_comment ?></span> Comment</li>
									<li>
										<span class="text-title"><?= $item->total_share ?> </span><?= $channel_type === CHANNEL_TYPE_TWITTER ? 'Retweet' : 'Share' ?>
									</li>
									<?php if ($channel_type === CHANNEL_TYPE_FACEBOOK): ?>

										<li><span class="text-title"><?= $item->count_like_share ?: 0 ?></span> Data
											like &
											share
										</li>
										<li><span class="text-title"><?= $item->count_comment ?></span> Data comment
										</li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</li>

				</ul>
			</div>
		</div>

	</div>
</div>
