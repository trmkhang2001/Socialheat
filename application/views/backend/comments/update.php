<?php
/**
 *
 * @var $item
 * @var $userInfo
 * @var $keyword
 */

$params = $this->config->config['params'];
$types = $params['types'];
$from = '';
?>

<style>
	/*body {*/
	/*	overflow: hidden;*/
	/*}*/
</style>
<div class="row" id='vue-form'>
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-body">
				<form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
					<label>
						<input type="hidden" name="id" value="<?php echo $item->id ?>"/>
					</label>
					<div class="form-group">
						<label class="col-sm-3 control-label">Comment</label>
						<div class="col-sm-9">
							<textarea type="text" rows="5" class="form-control" name="comment" placeholder=""
							><?php echo $item->comment ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Từ khóa hiện có</label>
						<div class="col-sm-9 form_filters_post">
							<?php $this->load->view('/backend/clients/item_keywords'); ?>

						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Từ khóa</label>
						<div class="col-sm-9">
							<input name="keywords" id="object_tagsinput" type="text" value="">
							<small>vd:căn hộ cho thuê,cắt lỗ,đất thổ cư</small><br>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Type</label>
						<div class="col-sm-9">
							<label class="field select">
								<select name="type" class="form-control">
									<option value="">Chọn</option>
									<?php foreach ($types as $type):
										$selected = '';
										if ($type['value'] == $item->type)
										{
											$selected = 'selected';
										}
										?>
										<option
											value="<?= $type['value'] ?>" <?= $selected ?> ><?= $type['name'] ?></option>
									<?php endforeach; ?>
								</select>
								<i class="arrow"></i>
							</label>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Tương tác</label>
						<div class="col-sm-9">
							<input name="from" placeholder="from" class="form-control col-md-5"
							       type="number" value="<?= $item->from ?>">
							<input name="to" placeholder="to"
							       class="form-control col-md-5 col-md-offset-1" type="number" value="<?= $item->to ?>">
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
<script src="/assets/plugins/vuejs/vue.min.js"></script>

<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/comments']) ?>


<script>
	var modalLoading = {
		show: function() {
			$('.loading-bg ').removeClass('hidden');
		},
		hide: function() {
			$('.loading-bg ').addClass('hidden');
		},
	};
	var validateForm = {
		setValidateMsg: function(data) {
			$.each(data, function(key, val) {
				var $elInput = $('input[name="' + key + '"]');
				var $elSelect = $('select[name=\'' + key + '\']');
				var $elTextArea = $('textarea[name=\'' + key + '\']');
				var msg = '<em class="text-danger">' + val + '</em>';
				$elInput.parents('.form-group').addClass('state-error has-error');
				$elSelect.parents('.form-group').addClass('state-error has-error');
				$elTextArea.parents('.form-group').addClass('state-error has-error');
				$elInput.parent().append(msg);
				$elSelect.parent().append(msg);
				$elTextArea.parent().append(msg);
				toastr['error'](val);
			});
		},
		removeValidateMsg: function() {
			$('.form-group').removeClass('state-error has-error');
			$('.form-group').find('.text-danger').remove();
		},
	};
	var ComponentsBootstrapTagsinput = function() {
		var t = function() {
			var t = $('#object_tagsinput');
			t.tagsinput({
				itemValue: 'value',
				itemText: 'text',
			}), $('.list_keyword_social  input').on('click', function() {
				$('#object_tagsinput').tagsinput('add', {
					value: $(this).val(),
					text: $(this).val(),
				});
			});
			<?php if($item->keywords):
			$keywords = explode(',', $item->keywords);
			foreach ($keywords as $keyword):
			?>
			t.tagsinput('add', {
				value: '<?=$keyword?>',
				text: "<?= $keyword?>",
			});
			<?php  endforeach; endif;?>


		};
		return {
			init: function() {
				t();
			},
		};
	}();
	jQuery(document).ready(function() {
		ComponentsBootstrapTagsinput.init();
	});

</script>

