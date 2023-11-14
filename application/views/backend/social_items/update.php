<?php

/**
 * @var $item
 * @var $userInfo
 */
$params = $this->config->config['params'];
$types = $params['types'];
$channel_types = $params['channel_types'];

?>
<div class="card p-5 ms-3">
	<div class="row" id='vue-form'>
		<div class="col-md-12">
			<div class="panel">
				<h1>Social Audience</h1>
				<div class="panel-body">
					<form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
						<label>
							<input type="hidden" name="id" value="<?php echo $item->id ?>" />
						</label>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label">Social Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" placeholder="" value="<?php echo $item->name ?>" />
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label">Social Id</label>
							<div class="col-sm-10">

								<input type="text" class="form-control" name="social_id" placeholder="" value="<?php echo $item->social_id ?>" />
							</div>
						</div>

						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label">Type</label>
							<div class="col-sm-10">
								<label class="field select">
									<select name="type" class="form-select">
										<option value="">Chọn</option>
										<?php foreach ($types as $type) :
											$selected = '';
											if ($type['value'] === (int)$item->type) {
												$selected = 'selected';
											}
										?>
											<option value="<?= $type['value'] ?>" <?= $selected ?>><?= $type['name'] ?></option>
										<?php endforeach; ?>
									</select>
									<i class="arrow"></i>
								</label>
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label">Channel Type</label>
							<div class="col-sm-10">
								<label class="field select">
									<select name="channel_type" class="form-select">
										<option value="">Chọn</option>
										<?php foreach ($channel_types as $type) :
											$selected = '';
											if ($type['value'] === (int)$item->type) {
												$selected = 'selected';
											}
										?>
											<option value="<?= $type['value'] ?>" <?= $selected ?>><?= $type['name'] ?></option>
										<?php endforeach; ?>
									</select>
									<i class="arrow"></i>
								</label>
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label">Image</label>
							<div class="col-sm-10">
								<input type="file" class="form-control" id="image" name="image" placeholder="" />
							</div>
						</div>
						<div class="mb-3 row">
							<?php if (isset($item->image_url)) : ?>
								<label class="col-sm-2"></label>
								<div class="col-sm-10">
									<img src="<?php echo base_url($item->image_url) ?>" width="100%" />
								</div>
							<?php else : ?>
								<label class="col-sm-2"></label>
								<div class="col-sm-10">
									<img src="" id="blah" width="100%" />
								</div>
							<?php endif; ?>
						</div>

						<div class="mb-3 row">
							<div class="col-sm-10 col-sm-offset-3">
								<button type="button" @click="saveComplete" class="btn btn-primary"><i class="fa fa-save"></i> SAVE
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/socialitems']) ?>
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}

	$('#image').change(function() {
		readURL(this);
	});
</script>