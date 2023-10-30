<?php
/**
 * @var $items
 * @var $pagination
 * @var $filterStatus
 * @var $comment
 *
 */

$params = $this->config->config['params'];
$types = $params['types'];
$listStatus = $params['comment_report_status'];
$channelTypes  = $params['channel_types'];
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}
	.btn-custom {
		padding: 6px 6px;
		font-size: 0px;
	}
	table{
		word-break: break-word;
	}
	.channel-post-number li {
		display: inline-flex;
		height: 27px;
		line-height: 27px;
		padding: 0 5px;
	}
	.read_more {
		font-size: 12px;
	}
	.read-less {
		max-height: 60px;
	}
</style>
<div class="m-content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="">
					<form method="get" action="">
						<div class="form-inline">
							<div class="form-group  margin-right-10">
								<label class="text-system" style="display: block;text-align: left">Status</label>
								<div class="form-inline">
									<select name="status" class="form-control">
										<option value="">Chọn</option>
										<?php foreach ($listStatus as $status):
											$selected  = '';
											if($status['value'] === $filterStatus){
												$selected = 'selected';
											}
											?>
											<option <?= $selected?> value="<?php echo $status['value']?>"><?php echo $status['name']?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="text-system"> &nbsp;</label>
								<div class="form-inline">
									<button type="submit" class="btn btn-default "><i class="fa fa-filter"></i> Lọc dữ liệu</button>

								</div>

							</div>
						</div>

					</form>

				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="">
					<div class="clearfix">
						<ul style="padding-left: 15px">
							<li><b>Comment Id:</b> <?= $comment->id?>
							</li>
							<li style="word-break: break-word">
							<b>Nội dung comment:</b> <?=  nl2br($comment->comment)?>
							</li>
							<li><b class="margin-bottom-5">Keywords:</b>
								<div class="clearfix form_filters_post" style="margin-top: 10px">
									<?php $this->load->view('/backend/clients/item_keywords', ['keywords' => explode(',', $comment->keywords)]); ?>
								</div>
							</li>
						</ul>
					</div>

					<table class="table table-hover table-bordered text-center">
						<thead>
						<tr class="active ">
							<th width="5%" >Id</th>
							<th >Post Id</th>
							<th >Channel Type</th>
							<th>Type</th>
							<th>Ngày Comment</th>
							<th width="10%">Status</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($items as $item):
							$status = $listStatus[$item->status];
							$socialLink = 'https://facebook.com/' . $item->post_id;
							$channelInfo = $channelTypes[$item->channel_type];
							$iconImage = $channelInfo['icon_image'];
							$channel_type = $item->channel_type;
							if ($channel_type !== CHANNEL_TYPE_FACEBOOK)
							{
								$class = 'margin-left-100';
								$socialLink = $item->post_url;
								$linkDetail = $socialLink;
							}
							$type = $types[$item->type]
							?>
							<tr>
								<td><?= $item->id?></td>
								<td><a target="_blank" href="<?= $socialLink?>"><?= $item->post_id?></a></td>
								<td><?= $channelInfo['name']?></td>
								<td><?= $type['name']?></td>
								<td> <?= $item->comment_date?> </td>
								<td class="<?= $status['class']?>"><b><?= $status['name']?></b></td>
							</tr>
						<?php endforeach; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<?php echo $pagination ?>
		</div>
	</div>
</div>
