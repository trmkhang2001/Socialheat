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
						<input type="hidden" name="id" value="<?php echo $item->id ?>"/>
						<input type="hidden" name="type" value="<?php echo XPATH_TYPE_TOOL_POST_FB_TOKEN?>"/>
						<input type="hidden" name="type_tool" value="<?php echo XPATH_TYPE_TOOL_POST_FB_TOKEN?>"/>
					</label>
					<div class="form-group">
						<label class="col-sm-3 control-label">Token</label>
						<div class="col-sm-9">
							<textarea type="text" rows="3" class="form-control" name="xpath" placeholder=""><?php echo $item->xpath ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-9 col-sm-offset-3">
							<button type="button" @click="saveComplete" class="btn btn-primary"><i
										class="fa fa-save"></i> SAVE
							</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/xpath/token']) ?>

