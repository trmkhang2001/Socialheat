<?php

/**
 * @var $item
 * @var $userInfo
 */
$type = $this->input->get('type_xpath', TRUE);
$params = $this->config->config['params'];
$channel_type = $params[XPATH]['channel_type'];
$types = $params[XPATH]['types'];
?>
<div class="card mx-5 p-3">
	<div class="row" id='vue-form'>
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
					<form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
						<label>
							<input type="hidden" name="id" value="<?php echo $item->id ?>" />
						</label>
						<div class="form-group">
							<label class="col-sm-3 control-label fw-bold my-3">Xpath</label>
							<div class="col-sm-9">
								<textarea type="text" rows="10" class="form-control" name="xpath" placeholder=""><?php echo $item->xpath ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label fw-bold my-3">Channel type</label>
							<div class="col-sm-9">
								<label class="field select">
									<select name="channel_type" class="form-control">
										<option value="">Chọn</option>

										<?php foreach ($channel_type as $type) :
											$selected = '';
											if ($type['value'] === $item->channel_type) {
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
						<div class="form-group">
							<label class="col-sm-3 control-label fw-bold my-3">Type</label>
							<div class="col-sm-9">
								<label class="field select">
									<select name="type" class="form-control">
										<option value="">Chọn</option>
										<?php foreach ($types as $type) :
											$selected = '';
											if ($type['value'] === $item->type) {
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
						<div class="form-group my-3">
							<div class="col-sm-9 col-sm-offset-3">
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

<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/xpath']) ?>