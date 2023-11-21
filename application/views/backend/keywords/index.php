<?php

/**
 * @var $items
 * @var $pagination
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
<div class="row card mx-5 p-3">
	<div class="row">
		<div class="col-md-12">
			<div class="">
				<form method="get" action="">
					<div class="form-inline">
						<div class="form-group ">
							<label class="text-system"> &nbsp;</label>
							<div class="form-inline">
								<a href="/backend/keywords/create" class="btn btn-primary btn-default ">Thêm từ khóa</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="row mt-5">
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="table table-responsive table-row-bordered table-scrollable table-row-gray-100 align-middle gs-0 gy-3 m-5">
						<table class="table table-row-gray-300 align-middle gs-0 gy-4">
							<thead>
								<tr class="active ">
									<th width="450px">Keywords</th>
									<th>Created date</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($items as $item) :

								?>
									<tr>
										<td>
											<div><?php echo $item->keyword ?></div>
										</td>
										<td><?php echo $item->created_date ?></td>
										<td class="actions">
											<ul class="list-inline">
												<li class="list-inline-item"><a data-toggle="tooltip" data-title="Updated" href="/backend/keywords/update/<?php echo $item->id ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a></li>
												<li class="list-inline-item"><a data-toggle="tooltip" data-title="Deleted" href="/backend/keywords/delete/<?php echo $item->id ?>" class="btn btn-delete btn-danger"><i class="ki-outline ki-trash"></i></a></li>
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
	<?php $this->load->view('backend/layout/submit_form', array('method' => 'saveMultipleLetter')) ?>
</div>