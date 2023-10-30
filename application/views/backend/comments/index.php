<?php
/**
 * @var $items
 * @var $pagination
 *
 */

$params = $this->config->config['params'];
$listStatus = $params['list_status'];
$channelTypes = $params['channel_types'];
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}

	.btn-custom {
		padding: 6px 6px;
		font-size: 0px;
	}

	table {
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
								<label class="text-system"> &nbsp;</label>
								<div class="form-inline">
									<a href="/backend/comments/create" class="btn btn-primary ">Thêm Comment</a>
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

					<table class="table table-hover table-bordered text-center">
						<thead>
						<tr class="active ">
							<th width="5%">id</th>
							<th width="20%">Comment</th>
							<th>Keywords</th>
							<th width="10%">Created date</th>
							<th width="15%">Total post</th>
							<th width="5%">Send</th>
							<th width="5%">Error</th>
							<th width="7%">Pending</th>
							<th width="150px"></th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($items as $item):
							$total = json_decode($item->total_post, FALSE);
							?>
							<tr>
								<td><a target="_blank"
								       href="<?= base_url('backend/comments/detail/' . $item->id) ?>"><?= $item->id ?></a>
								</td>
								<td class="text-left ">
									<a target="_blank"
									   href="<?= base_url('backend/comments/detail/' . $item->id) ?>">
									<p class="item-content-read-less clearfix">
										<?php echo $item->comment ?>
									</p>
									</a>
									<a href="#" class="read_more  clearfix">Read more</a>

								</td>
								<td class="form_filters_post text-left ">
									<div class="clearfix item-content-read-less">
										<?php $this->load->view('/backend/clients/item_keywords', ['keywords' => explode(',', $item->keywords)]); ?>
									</div>
									<a href="#" class="read_more clearfix">Read more</a>

								</td>
								<td><span style="cursor: pointer" data-toggle="tooltip"
								          data-title="<?php echo $item->created_date ?>">
										<?php echo date('Y-m-d', strtotime($item->created_date)) ?>
									</span></td>
								<td class="text-center">
									<ul class="list-unstyled channel-post-number ">
										<?php if ($total):
											foreach ($total as $type => $t):
												$channelInfo = $channelTypes[$type];
												?>
												<li><img src="<?= $channelInfo['icon_image'] ?>"><?= $t ?></li>
											<?php endforeach; endif; ?>
									</ul>
								</td>
								<td><?= $item->number_success ?></td>
								<td> <?= $item->number_error ?> </td>
								<td> <?= $item->number_pending ?></td>
								<td class="actions">
									<ul class="list-inline">
										<li><a data-toggle="tooltip" data-title="Updated"
										       href="/backend/comments/update/<?php echo $item->id ?>"
										       class="btn btn-primary btn-custom"><i class="fa fa-edit"></i></a></li>
										<li><a data-toggle="tooltip" data-title="Deleted"
										       href="/backend/comments/delete/<?php echo $item->id ?>"
										       class="btn btn-delete btn-danger btn-custom"><i class="fa fa-trash"></i></a>
										</li>
										<?php if ((int)$item->status === STATUS_ACTIVE): ?>
											<li><a data-toggle="tooltip" data-title="DeActive"
											       href="/backend/comments/deactive/<?php echo $item->id ?>"
											       class="btn  btn-success btn-custom"><i class="fa fa-pause"></i></a>
											</li>
										<?php else: ?>
											<li><a data-toggle="tooltip" data-title="Active"
											       href="/backend/comments/active/<?php echo $item->id ?>"
											       class="btn btn-success btn-custom"><i class="fa fa-play"></i></a>
											</li>
										<?php endif; ?>
									</ul>
								</td>
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

<script>
	$('.item-content-read-less').each(function(idx, $element) {
		var height = this.clientHeight;
		console.log(height);
		if (height <= 60) {
			$(this).parent().find('.read_more').addClass('hidden');
		} else {
			$(this).addClass('read-less');
			$(this).parent().find('.read_more').removeClass('hidden');

		}
	});
</script>