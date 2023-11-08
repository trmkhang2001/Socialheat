<?php

/**
 * @var $items
 * @var $pagination
 *
 */

$params = $this->config->config['params'];
$listStatus = $params['list_status'];
$channelTypes = $params['channel_types'];
$types = $params['types'];
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}
</style>
<div class="ms-5">
	<h1 class="mb-7 mx-3">Social Audience</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="card p-3 mx-3">
					<form method="get" action="">
						<div class="d-flex">
							<div class="form-group me-3">
								<label class="text-system">Channel type</label>
								<div class="form-inline">
									<select name="channel_type" class="form-control">
										<option value="">Chọn</option>
										<?php foreach ($channelTypes as $type) : ?>
											<option value="<?= $type['value'] ?>"><?= $type['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group me-3">
								<label class="text-system">Social Id</label>
								<div class="form-inline">
									<input type="text" name="social_id" class="form-control " value="" placeholder="Uid">
								</div>
							</div>
							<div class="form-group me-3">
								<label class="text-system">Name</label>
								<div class="form-inline">
									<input type="text" name="keyword" class="form-control " value="" placeholder="Email">
								</div>
							</div>
							<div class="form-group me-3">
								<label class="text-system">Types</label>
								<div class="form-inline">
									<select name="type" class="form-control">
										<option value="">Chọn</option>
										<?php foreach ($types as $type) : ?>
											<option value="<?= $type['value'] ?>"><?= $type['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group me-3">
								<label class="text-system">Status</label>
								<div class="form-inline">
									<select name="status" class="form-control">
										<option value="">Chọn</option>
										<?php foreach ($listStatus as $status) : ?>
											<option value="<?= $status['value'] ?>"><?= $status['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group me-3">
								<label class="text-system"> &nbsp;</label>
								<div class="form-inline">
									<button type="submit" class="btn btn-default "><i class="fa fa-filter"></i> Filter </button>

								</div>
							</div>
							<div class="form-group pull-right">
								<label class="text-system"> &nbsp;</label>
								<div class="form-inline">
									<a href="/backend/socialItems/create" class="btn btn-primary btn-default ">Create Social Items</a>

								</div>

							</div>
						</div>

					</form>

				</div>

			</div>
		</div>
	</div>

	<div class="card mx-3 mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="d-flex">

						<table class="table table-hover table-bordered">
							<thead>
								<tr class="active ">
									<th>Name</th>
									<th>Post Id</th>
									<th>Channel types</th>
									<th>Type</th>
									<th>Image</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($items as $item) :
									$type = $types[$item->type];
									$status = $listStatus[$item->status];
									$channelInfo = $channelTypes[$item->channel_type];
								?>
									<tr>
										<td><?php echo $item->name ?></td>
										<td><a target="_blank" href="<?php echo $channelInfo['link'] . '/' . $item->social_id ?>"><?php echo $item->social_id ?></a></td>
										<td><?php echo $channelInfo['name'] ?></td>
										<td><?php echo $type['name'] ?></td>
										<td>
											<?php if ($item->image) : ?>
												<img src="<?= site_url($item->image) ?>" height="30" width="auto">
											<?php endif; ?>
										</td>
										<td><span class="<?php echo $status['class'] ?>"><?php echo $status['name'] ?></span></td>

										<td class="actions">
											<ul class="list-inline">
												<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Update"><a href="/backend/socialItems/update/<?php echo $item->id ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
												<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><a href="/backend/socialItems/delete/<?php echo $item->id ?>" class="btn btn-delete btn-danger"><i class="ki-outline ki-trash fa-trash-o"></i></a></li>
												<?php if ((int)$item->status ===  STATUS_ACTIVE) : ?>
													<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="DeActive"><a href="/backend/socialItems/deactive/<?php echo $item->id ?>" class="btn btn-warning "><i class="fa fa-pause"></i></a></li>
												<?php else : ?>
													<li class="list-inline-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Active"><a href="/backend/socialItems/active/<?php echo $item->id ?>" class="btn btn-warning "><i class="fa fa-play"></i></a></li>
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
</div>
<?php $this->load->view('backend/layout/submit_form', array('method' => 'saveMultipleLetter')) ?>