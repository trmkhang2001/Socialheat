<?php

/**
 * @var $item
 * @var $userInfo
 * @var $socialItems
 */
$params = $this->config->config['params'];
$types = $params['types'];
$channel_types = $params['channel_types'];
?>
<link href="/assets/backend/plugins/select2/select2.min.css" rel="stylesheet" />

<link href="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />

<style>
	.allcp-form .select .arrow {
		display: none;
	}

	.select2-container .select2-selection--single {
		height: 36px;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		line-height: 36px;
	}

	.list_keyword_social li {
		padding: 0 !important;
	}

	.list_keyword_social li {
		margin-right: 6px;
		margin-bottom: 8px;
		float: left;
	}

	.list_keyword_social li.active label {
		color: #000000 !important;
		font-weight: bold;
	}

	.list_keyword_social li:hover,
	.post_keywords i:hover {
		color: #000000 !important;
	}

	.bootstrap-tagsinput span {
		padding: 3px;
		background-color: #4fd8b0;
	}
</style>
<h1 class="mx-5 p-3">ADD POST</h1>
<div class="card mx-5 p-3">
	<div class="row" id='vue-form'>
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
					<form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
						<label>
							<input type="hidden" name="id" value="<?php echo $item->id ?>" />
						</label>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Name</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="name" placeholder="" value="<?php echo $item->name ?>" />
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Post Id</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="post_id" placeholder="" value="<?php echo $item->post_id ?>" />
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Content</label>
							<div class="col-sm-10">
								<textarea type="text" class="form-control" name="content" placeholder=""><?php echo $item->content ?></textarea>
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Channel Type</label>
							<div class="col-sm-10">
								<select name="channel_type" class="form-select form-select-lg mb-3">
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
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Type</label>
							<div class="col-sm-10">
								<select name="type" class="form-select form-select-lg mb-3">
									<option value="">Chọn</option>
									<?php foreach ($types as $type) :
										$selected = '';
										if ($type['value'] === (int)$item->type) {
											$selected = 'selected';
										}
									?>mb-3 row
									<option value="<?= $type['value'] ?>" <?= $selected ?>><?= $type['name'] ?></option>
								<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Social Item</label>
							<div class="col-sm-10">
								<select name="post_owner_id" class="form-select form-select-lg mb-3 social-item-select2">
									<option value="">Chọn</option>
									<?php foreach ($socialItems as $social_item) :
										$selected = '';
										if ($social_item->id === (int)$item->post_owner_id) {
											$selected = 'selected';
										}
									?>
										<option value="<?= $social_item->social_id ?>" <?= $selected ?>><?= $social_item->name ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Từ khóa hiện có</label>
							<div class="col-sm-10 form_filters_post">
								<div class="border border-2 rounded p-2" style="overflow:scroll;height: 200px;">
									<?php $this->load->view('/backend/monitoring/item_keywords'); ?>
								</div>
							</div>
						</div>
						<div class="mb-3 row">
							<label class="col-sm-2 col-form-label fw-bold">Từ khóa</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="keywords" id="object_tagsinput" value="">
							</div>
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
<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/items']) ?>
<script src="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js" type="text/javascript"></script>
<script src="/assets/backend/plugins/select2/select2.min.js"></script>
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
			})
			<?php if ($item->keywords) :
				$keywords = explode(',', $item->keywords);
				foreach ($keywords as $keyword) :
			?>
					t.tagsinput("add", {
						value: '<?= $keyword ?>',
						text: '<?= $keyword ?>',
						color: '#000000',
					})
			<?php endforeach;
			endif; ?>


		};
		return {
			init: function() {
				t();
			},
		};
	}();
	jQuery(document).ready(function() {
		ComponentsBootstrapTagsinput.init();

		$('.social-item-select2').select2();

	});
</script>