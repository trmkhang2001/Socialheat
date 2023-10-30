<?php
/**
 * @var $clients
 * @var $pagination
 * @var $items
 * @var $date_from
 * @var $userInfo
 * @var $date_to
 *
 */
$params = $this->config->config['params'];
$clientType = $params['clients_type'];
$listStatus = $params['list_status'];
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="">
				<form method="get" action="">
					<div class="form-inline">
						<?php if($userInfo['role_id'] === ROLE_ADMIN):?>
						<div class="form-group">
							<label class="text-system">Khách hàng</label>
							<div class="form-inline">
								<select name="client_id" class="form-control">
									<option value="">Chọn</option>
									<?php foreach ($clients as $client): ?>
										<option value="<?= $client->id ?>"><?= sprintf('%s(%s)',$client->name,$client->email) ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<?php endif;?>
						<div class="form-group">
							<label class="text-system">Từ ngày</label>
							<div class="form-inline">
								<input type="date" name="date_from" class="form-control " value="<?= $date_from?>"
									   placeholder="">
							</div>
						</div>
						<div class="form-group">
							<label class="text-system">Đến ngày</label>
							<div class="form-inline">
								<input type="date" name="date_to" class="form-control " value="<?= $date_to?>"
									   placeholder="">
							</div>
						</div>

						<div class="form-group">
							<label class="text-system"> &nbsp;</label>
							<div class="form-inline">
								<button type="submit" class="btn btn-default "><i class="fa fa-filter"></i> Lọc dữ liệu
								</button>

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
				<table class="table table-hover table-bordered">
					<thead>
					<tr class="active ">
						<th>STT</th>
						<th>Client</th>
						<th>Date</th>
						<th>Total</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($items as $index =>  $item):
						$status = $listStatus[$item->status];
						?>
						<tr>
							<td><?php echo ++$index ?></td>
							<td><?php echo $item->client_name ?></td>
							<td><?php echo $item->created_date ?></td>
							<td><?php echo $item->number ?></td>
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