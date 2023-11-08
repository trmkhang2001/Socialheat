<?php

/**
 * @var $items
 * @var $pagination
 * @var $channel_type
 *
 */

$params = $this->config->config['params'];
$channelType = $params[XPATH]['channel_type'];
$types = $params[XPATH]['types'];
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}

	.xpath-content {
		max-height: 100px;
		display: block;
		overflow-y: scroll;
	}
</style>
<div class="card mx-5 p-3">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="">
					<form method="get" action="">
						<div class="d-flex">
							<div class="form-group col-md-2 mx-3 my-5">
								<label class="control-label fw-bold text-system mb-3">Channel type</label>
								<div class="form-inline">
									<select name="type_tool" class="form-control" style="width: 100%">
										<option value="">Chọn</option>
										<?php foreach ($channelType as $type) :
											$selected = '';
											if ($type['value'] === $channel_type) {
												$selected = 'selected';
											}
										?>
											<option value="<?= $type['value'] ?>" <?= $selected ?>><?= $type['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-group col-md-2 mx-3 my-5">
								<label class="control-label fw-bold text-system mb-3">Type</label>
								<div class="form-inline">
									<select name="status" class="form-control" style="width: 100%">
										<option value="">Chọn</option>
										<?php foreach ($types as $v) :
											$selected = '';
											if ($v['value'] === (int)$type) {
												$selected = 'selected';
											}
										?>
											<option value="<?= $v['value'] ?>" <?= $selected ?>><?= $v['name'] ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>

							<div class="form-group mx-3 my-5">
								<label class="control-label fw-bold text-system mb-3"> &nbsp;</label>
								<div class="form-inline">
									<button type="submit" class="btn btn-secondary "><i class="fa fa-filter"></i> Lọc dữ liệu
									</button>

								</div>
							</div>
							<div class="clearfix pull-right mx-3 my-5">
								<div class="form-group m--margin-left-5">
									<label class="control-label fw-bold text-system mb-3"> &nbsp;</label>
									<div class="form-inline">
										<a href="/backend/xpath/create" class="btn btn-primary btn-default ">Thêm xpath</a>

									</div>
								</div>
							</div>

						</div>

					</form>

				</div>

			</div>
		</div>
	</div>
</div>

<div class="card m-5 p-3">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="table-responsive table-scrollable">

					<table class="table table-hover table-bordered">
						<thead>
							<tr class="active ">
								<th style="width: 40%;">Xpath</th>
								<th>Channel type</th>
								<th>Type</th>
								<th>Created date</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($items as $item) :
								if (($item->channel_type !== CHANNEL_TYPE_FACEBOOK_TOKEN) && $item->channel_type) :
									$channelInfo = $channelType[$item->channel_type];
									$type_info = $types[$item->type];
									$type = '';
									$paramsUrlApi = [
										'channel_type' => $item->channel_type,
										'type'         => $item->type,
										'AccessToken'  => ACCESS_TOKEN
									];
									$urlApi = site_url('backend/api/xpath?' . http_build_query($paramsUrlApi));
							?>
									<tr>
										<td class="xpath-content"><?php echo $item->xpath ?></td>
										<td><?= $channelInfo['name'] ?></td>
										<td><?php echo $type_info['name'] ?></td>
										<td><?php echo \app\common\utilities\Common::reformatDate($item->created_date) ?></td>
										<td class="actions">
											<ul class="list-inline">
												<li class="list-inline-item"><a data-toggle="tooltip" data-title="Updated" href="/backend/xpath/update/<?php echo $item->id ?>?type_xpath=<?= $type ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
												<li class="list-inline-item"><a data-toggle="tooltip" data-title="Deleted" href="/backend/xpath/delete/<?php echo $item->id ?>" class="btn btn-delete btn-danger"><i class="ki-outline ki-trash"></i></a></li>
												<li class="list-inline-item"><a data-toggle="tooltip" data-title="Copy api token " href="#" data-url="<?= $urlApi ?>" class="btn btn-warning copy-api-url" data-original-title="" title=""><i class="fa fa-copy "></i></a></li>

											</ul>
										</td>
									</tr>
							<?php endif;
							endforeach; ?>

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
<?php $this->load->view('backend/layout/submit_form', array('method' => 'saveMultipleLetter')) ?>