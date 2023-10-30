<?php
/**
 * @var $items
 * @var $pagination
 * @var $total
 *
 */

$params = $this->config->config['params'];
$listStatus = $params['list_status'];
$types = $params['types'];
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="">
				<form method="get" action="">
					<div class="form-inline">
						<div class="form-group">
							<label class="text-system">Post Id</label>
							<div class="form-inline">
								<input type="text" name="post_id" class="form-control " value=""
									   placeholder="Uid">
							</div>
						</div>
						<div class="form-group">
							<label class="text-system">Name</label>
							<div class="form-inline">
								<input type="text" name="keyword" class="form-control " value=""
									   placeholder="Email">
							</div>
						</div>
						<div class="form-group">
							<label class="text-system">Types</label>
							<div class="form-inline">
								<select name="type" class="form-control">
									<option value="">Chọn</option>
									<?php foreach ($types as $type): ?>
										<option value="<?= $type['value'] ?>"><?= $type['name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="text-system">Status</label>
							<div class="form-inline">
								<select name="status" class="form-control">
									<option value="">Chọn</option>
									<?php foreach ($listStatus as $status): ?>
										<option value="<?= $status['value'] ?>"><?= $status['name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="text-system"> &nbsp;</label>
							<div class="form-inline">
								<button type="submit" class="btn btn-default "><i class="fa fa-filter"></i> Lọc dữ liệu
								</button>

							</div>
						</div>
						<div class="form-group pull-right">
							<label class="text-system"> &nbsp;</label>
							<div class="form-inline">
								<a href="/backend/items/create" class="btn btn-primary btn-default ">Thêm bài viết</a>

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
				<span>Tổng số post: <b><?= number_format($total)?></b></span>
				<br>
				<br>
				<table class="table table-hover table-bordered">
					<thead>
					<tr class="active ">
						<th>Name</th>
						<th>Post Id</th>
						<th>Type</th>
						<th>Image</th>
						<th>Craw date</th>
						<th>Updated date</th>
						<th>Status</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($items as $item):
						$type = $types[$item->type];
						$status = $listStatus[$item->status];
						?>
						<tr>
							<td><?php echo $item->name ?></td>
							<td><a target="_blank" href="https://www.facebook.com/<?php echo $item->post_id?>">
									<?php echo $item->post_id?></a></td>
							<td><?php echo $type['name'] ?></td>
							<td>
								<?php if($item->image_url):?>
									<img src="<?= site_url($item->image_url)?>" height="150" width="auto">
								<?php endif;?>
							</td>
							<td><?php echo $item->craw_date ?></td>
							<td><?php echo $item->updated_date ?></td>

							<td><span class="<?php echo $status['class'] ?>"><?php echo $status['name'] ?></span></td>

							<td class="actions">
								<ul class="list-inline">
									<li><a data-toggle="tooltip" data-title="Updated"
										   href="/backend/items/update/<?php echo $item->id ?>"
										   class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
									<li><a data-toggle="tooltip" data-title="Deleted"
										   href="/backend/items/delete/<?php echo $item->id ?>"
										   class="btn btn-delete btn-danger"><i class="fa fa-trash-o"></i></a></li>
									<?php if((int)$item->status ===  STATUS_ACTIVE):?>
										<li><a data-toggle="tooltip" data-title="DeActive"
											   href="/backend/items/deactive/<?php echo $item->id ?>"
											   class="btn btn-warning "><i class="fa fa-pause"></i></a></li>
									<?php else:?>
										<li><a data-toggle="tooltip" data-title="Active"
											   href="/backend/items/active/<?php echo $item->id ?>"
											   class="btn btn-warning "><i class="fa fa-play"></i></a></li>
									<?php endif;?>
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
<?php $this->load->view('backend/layout/submit_form',array('method' => 'saveMultipleLetter'))?>
