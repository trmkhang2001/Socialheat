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

	.text-limit-length {
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		max-width: 15ch;
		display: inline-block;
	}
</style>
.<div class="container d-flex flex-column flex-column-fluid" id="kt_content">
	<h1>Items List</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="card p-5">
					<div class="d-flex">
						<form method="get" action="">
							<div class="d-flex">
								<div class="form-group me-3">
									<label class="text-system">Post Id</label>
									<div class="form-inline">
										<input type="text" name="post_id" class="form-control " value="" placeholder="Uid">
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
										<select name="type" class="form-select">
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
										<select name="status" class="form-select">
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
										<button type="submit" class="btn btn-secondary "><i class="fa fa-filter"></i> Lọc dữ liệu
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
	</div>
	<div class="card mt-5">
		<div class="row p-5">
			<div class="col-md-12">
				<div class="panel">
					<div class="">
						<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0 mb-3">
							Tổng số post: <?= number_format($total) ?>
						</h1>
						<div class="table-responsive table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3 p-5">
							<table class="table align-middle table-row-dashed fs-6 gy-5">
								<thead>
									<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
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
									<?php foreach ($items as $item) :
										$type = $types[$item->type];
										$status = $listStatus[$item->status];
									?>
										<tr>
											<td><?php echo $item->name ?></td>
											<td><a class="text-limit-length" target="_blank" href="https://www.facebook.com/<?php echo $item->post_id ?>">
													<?php echo $item->post_id ?></a></td>
											<td><?php echo $type['name'] ?></td>
											<td>
												<?php if ($item->image_url) : ?>
													<img class="rounded " src="<?= site_url($item->image_url) ?>" height="60px" width="auto">
												<?php endif; ?>
											</td>
											<td><?php if (!empty($item->craw_date)) {
													$date = date('d/m/Y', strtotime($item->craw_date));
													echo $date;
												} ?></td>
											<td><?php $date = date('d/m/Y', strtotime($item->updated_date));
												echo $date; ?></td>
											</td>

											<td><span class="<?php echo $status['class'] ?>"><?php echo $status['name'] ?></span></td>

											<td class="actions">
												<ul class="list-inline">
													<a data-toggle="tooltip" data-title="Updated" href="/backend/items/update/<?php echo $item->id ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
													<a data-toggle="tooltip" data-title="Deleted" href="/backend/items/delete/<?php echo $item->id ?>" class="btn btn-delete btn-danger"><i class="ki-outline ki-trash fa-trash-o"></i></a>
													<?php if ((int)$item->status ===  STATUS_ACTIVE) : ?>
														<a data-toggle="tooltip" data-title="DeActive" href="/backend/items/deactive/<?php echo $item->id ?>" class="btn btn-warning "><i class="fa fa-pause"></i></a>
													<?php else : ?>
														<a data-toggle="tooltip" data-title="Active" href="/backend/items/active/<?php echo $item->id ?>" class="btn btn-warning "><i class="fa fa-play"></i></a>
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
			</div>
			<div class="col-md-12">
				<?php echo $pagination ?>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('backend/layout/submit_form', array('method' => 'saveMultipleLetter')) ?>