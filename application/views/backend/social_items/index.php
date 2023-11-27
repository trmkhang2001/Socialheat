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

	#wrapper input[type=radio] {
		display: none;
	}

	input[type="radio"]:checked~label {
		color: orange;
	}

	.clasificacion {
		direction: rtl;
		unicode-bidi: bidi-override;
	}

	.create_btn {
		position: absolute;
		right: 1.25rem !important;
	}
</style>
<div class="ms-5">
	<h1 class="mb-7 mx-3">Social Audience</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="card p-5 mx-3">
					<form method="get" action="">
						<div class="d-flex">
							<div class="form-group me-3">
								<label class="fw-bold text-system">Channel type</label>
								<div class="form-inline">
									<select name="channel_type" class="form-select">
										<option value="">Chọn</option>
										<?php foreach ($channelTypes as $type) : ?>
											<option value="<?= $type['value'] ?>"><?= $type['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group me-3">
								<label class="fw-bold text-system">Name</label>
								<div class="form-inline">
									<input type="text" name="keyword" class="form-control " value="" placeholder="Email">
								</div>
							</div>
							<div class="form-group me-3">
								<label class="fw-bold text-system">Types</label>
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
								<label class="fw-bold text-system">Status</label>
								<div class="form-inline">
									<select name="status" class="form-select form-control">
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
									<button type="submit" class="btn btn-secondary "><i class="fa fa-filter"></i> Filter </button>

								</div>
							</div>
							<?php if ($userInfo['role_id'] === ROLE_ADMIN) { ?>
								<div class="form-group pull-right">
									<label class="text-system"> &nbsp;</label>
									<div class="">
										<a href="/backend/socialItems/create" class="btn btn-primary btn-default create_btn " style="background-color: #0B0044;">Create Social Items</a>
									</div>
								</div>
							<?php } ?>
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
					<div class="d-flex p-5">
						<table class="table align-middle table-row-dashed fs-6 gy-5">
							<thead>
								<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
									<th class="w-10px pe-2 w-xxl-50px">No.</th>
									<th class="min-w-200px">Name</th>
									<th class="text-start min-w-100px">Audiences Detail</th>
									<th class="text-start min-w-100px">Type</th>
									<th class="text-start min-w-100px">Audience Size</th>
									<th class="text-start min-w-100px">Status</th>
									<?php if ($userInfo['role_id'] === ROLE_ADMIN) : ?>
										<th class="text-start min-w-100px">Rating</th>
									<?php endif ?>
								</tr>
							</thead>
							<tbody class="fw-semibold text-gray-600">
								<?php
								$index = 0;
								foreach ($items as $item) :
									$type = $types[$item->type];
									$status = $listStatus[$item->status];
									$channelInfo = $channelTypes[$item->channel_type];
								?>
									<tr>
										<td><?= $index ?></td>
										<td>
											<a class="me-2" href="">
												<?php
												if ($type['name'] === 'Group')
													$img_link = '/assets/images/avartar_group.png';
												else
													$img_link = 'https://graph.facebook.com/' . $item->social_id . '/picture?type=square&access_token=' . FB_TOKEN;
												?>
												<img class="rounded" style="width: 42px; height:42px;" src="<?= $img_link ?>" alt="">
											</a>
											<a class="text-gray-800 text-hover-primary fw-bold" target="_blank" href="<?php echo $channelInfo['link'] . '/' . $item->social_id ?>"><?php echo $item->name ?></a>
										</td>
										<td><a class="btn" style="color: white;background: #0b0044;" target="_blank" href="<?php echo 'https://app.thealita.com/' . $item->social_id ?>">Info</a></td>
										<td class="fw-bold"><?php echo $type['name'] ?></td>
										<td class="fw-bold">
											105
											<?php if ($item->image) : ?>
												<!-- <img src="<?= site_url($item->image) ?>" height="30" width="auto"> -->
											<?php endif; ?>
										</td>
										<td class="text-start pe-0 __container">
											<div id="wrapper">
												<div class="clasificacion"><input type="radio"><label>★</label><input checked="" type="radio"><label>★</label><input type="radio"><label>★</label><input type="radio"><label>★</label><input type="radio"><label>★</label></div>
											</div>
										</td>
										<?php if ($userInfo['role_id'] === ROLE_ADMIN) : ?>
											<td class="actions">
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="Update" href="/backend/socialItems/update/<?php echo $item->id ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
												<a data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" href="/backend/socialItems/delete/<?php echo $item->id ?>" class="btn btn-delete btn-danger"><i class="ki-outline ki-trash fa-trash-o"></i></a>
												<?php if ((int)$item->status ===  STATUS_ACTIVE) : ?>
													<a data-bs-toggle="tooltip" data-bs-placement="top" title="DeActive" href="/backend/socialItems/deactive/<?php echo $item->id ?>" class="btn btn-warning "><i class="fa fa-pause"></i></a>
												<?php else : ?>
													<a data-bs-toggle="tooltip" data-bs-placement="top" title="Active" href="/backend/socialItems/active/<?php echo $item->id ?>" class="btn btn-warning "><i class="fa fa-play"></i></a>
												<?php endif; ?>
											</td>
										<?php endif ?>
									</tr>
								<?php $index++;
								endforeach; ?>

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row clearfix text-center" style="display: block;margin-bottom: 20px;">
				<?= $pagination ?>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('backend/layout/submit_form', array('method' => 'saveMultipleLetter')) ?>