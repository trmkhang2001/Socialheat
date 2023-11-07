<?php

/**
 * @var $item
 * @var $userInfo
 */

?>
<div class="row" id='vue-form'>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
				<form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
					<label>
						<input type="hidden" name="id" value="<?php echo $item->id ?>" />
					</label>
					<div class="form-group">
						<label class="col-sm-3 control-label">Từ khóa</label>
						<div class="col-sm-9">
							<textarea type="text" class="form-control" name="keyword" placeholder=""><?php echo $item->keyword ?></textarea>
						</div>
					</div>

					<div class="form-group">
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

<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/keywords']) ?>
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