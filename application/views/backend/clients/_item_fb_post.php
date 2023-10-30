<?php
/**
 * @var $item
 * @var  $key
 * @var  $user_id
 */
$ri = 0;
$count = (int)$item['count'];
$d_count = (int)$item['count_d'];
if ($count > 0 && $d_count > 0)
{
	$ri = number_format(($d_count / $count) * 100, 2);
}
$item['from_name'] = word_limiter($item['from_name'], 9, ' ...');
$item['image_url'] = 'https://storage.googleapis.com/' . $item['image_url'];
?>
<div class="col-md-4 col-xs-12 _items-post">
	<div class="m-portlet">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<?php if (isset($item['from'])) : ?>
					<div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon">
                            <img style="height: 50px; border-radius: 50%;" class="m-widget19__img"
								 src="https://graph.facebook.com/<?php echo $item['from']; ?>/picture?type=normal"
								 alt="">
                        </span>
						<h3 class="m-portlet__head-text" style="font-size: 17px;  height: 50px;  display: block;">
							<div class="clearfix">
								<a class="_items-post-title  _items-post-title_<?= $key ?>"
								   data-class="_items-post-title_<?= $key ?>" style="color: #575962" target="_blank"
								   href="<?php echo base_url('uid/group/' . $key); ?>">
									<?= $item['from_name'] ?>
								</a>

								<span style="float: right" class="icon_fb">
<!--									<a data-post-id="--><?//= $key ?><!--" class="add-favourite post-favourite---><?//= $key?><!--"-->
<!--									   href="javascript::void()"-->
<!--									   style="float: left;margin-right: 5px">-->
<!--										<i class="far  fa-heart" style="font-size: 21px"></i>-->
<!--									</a>-->
									<a target="_blank" style="float: left;margin-right: 6px"
									   href="https://facebook.com/<?php echo $key; ?>">
										<i style="color:#1883d9;font-size: 20px;" class="fab fa-facebook"></i>
									</a>
									<?php if (empty($is_page_detail)): ?>
										<a data-post-id="<?= $key ?>"
										   style="float: left; margin-top: 2px;margin-right: 5px" title="Refresh post"
										   class="refresh-post <?= $item['status'] === '9' ? 'not-active' : '' ?>"
										   href="javascript::void()">
											<i class="fas fa-sync-alt " style="color: #5867dd;font-size: 17px;"></i>
										</a>
										<a data-post-id="<?= $key ?>" class="report-post" href="javascript::void()"
										   style="float: left; margin-top: 2px;" title="Report post">
											<i class="fas fa-flag" style="color: red;font-size: 17px"></i>
										</a>
									<?php endif; ?>
								</span>
							</div>
							<span class="sponsor">Sponsored  </span>

							<?php if (isset($item['created_date'])) : ?>
								<span style="padding-left:5px;margin-top: 0" class="fb-post-block-time">
										<?php echo date('M , d Y', strtotime($item['created_date'])); ?>
									</span>
							<?php endif; ?>
						</h3>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="m-portlet__body m--margin-top-10">

			<div class="content">
				<p class="read-less _items-post-content"
				   style="margin-bottom:0;overflow: hidden;word-break: break-word;font-size: 13px;">
					<?= html_entity_decode($item['content']) ?></p>
				<a href="#" class="read_more">Read more</a>
			</div>
			<div class="clearfix category-list ">
				<ul class="list-unstyled">
					<li>Keywords:

						<?php
						$keywords = explode(',', $item['keywords']);

						foreach ($keywords as $index => $keyword):
							$slug = url_title(convert_accented_characters($keyword), '-', TRUE);
							$color = '#' . substr(md5($index . time()), 0, 6);
							$keywordsColor[$slug] = $color;

							?>
							<a	style="background: <?= $color ?> ;border: 1px solid <?= $color ?> !important;border-radius: 7px !important;color: #000000;
									line-height: 30px;height: 30px;font-weight: 400;padding:0 10px" href="<?= site_url('backend/clients?keyword[]=' . $keyword) ?>"><?= $keyword ?></a>

						<?php endforeach; ?>
					</li>
				</ul>
			</div>
			<?php
			$total_like = (int)$item['total_like'];
			$total_share = (int)$item['total_share'];
			$total_comment = (int)$item['total_comment'];
			?>
			<div class="m-demo__preview text-center" style=" margin: 0 auto; margin-top: 20px;">
				<ul class="m-nav m-nav--inline list-icon">
					<li class="m-nav__item">
						<a style="font-weight: 500" href="" class="fb-post-icon-interaction m-nav__link">
							<span class="text ">RI</span>
							<span><?php echo $ri ?>%</span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="" class="m-nav__link">
							<i class=" fb-post-icon-thumbs-up m-nav__link-icon fas fa-thumbs-up"></i>
							<span><?php echo number_format($total_like + $total_share) ?></span>
							<span class="m-nav__link-badge"></span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="" class="m-nav__link">
							<i class="fb-post-icon-comment m-nav__link-icon fas fa-comment-alt"></i>
							<span><?php echo number_format($total_comment) ?></span>
						</a>
					</li>
					<li class="m-nav__item">
						<a href="" class="m-nav__link">
							<img src="/assets/images/reaction_icon.png" width="22" height="auto" style="margin-right: 5px">
							<span><?php echo number_format($item['count']) ?></span>
						</a>
					</li>
					<li class="m-nav__item " style="float: right;margin-right: 0">
						<a href="" class="m-nav__link">
							<span class="update_time">Update: <?php echo date('d/m/Y', strtotime($item['updated_date'])); ?></span>

						</a>
					</li>
				</ul>
			</div>
		</div>


	</div>
</div>

