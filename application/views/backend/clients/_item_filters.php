<?php
$params = $this->config->config['params'];
$types = $params['types'];
/**
 * @var $keywords
 * @var array $filters
 * @var array $colorBg
 * @var array $channel_type
 */
?>
<style>
	.form-control-feedback {
		position: relative;
	}
</style>
<form method="get" class="form_filters_post form-filter">
	<div class="clearfix" style="margin-top: 40px;margin-bottom: 15px">
		<?php $this->load->view('/backend/clients/item_keywords'); ?>

	</div>
	<div class="clearfix filter-input col-md-12">
		<div class="form-inline " style="display: block">
			<div class="form-group  has-feedback " style="position: relative">

				<input type="text" data-title="" data-class-filter="filter-keyword" name="q"
				       style="background: #f2f2f2;" value="<?= isset($filters['q']) ? $filters['q'] : '' ?>"
				       class="form-control  keyword_filters" id="inputValidation" placeholder="Keyword on Post">
				<button type="submit" class="btn btn-icon-submit">
					<span class="glyphicon glyphicon-search form-control-feedback" style="color:#B2B2B2;"></span>
				</button>
			</div>
			<div class=" form-group post_type">
				<label> Sort by</label>

				<select data-title="Types" data-class-filter="filter-post-type"
				        name="sort_by" class="form-control  sort_by"
				        title="Post type" data-width="160px">
					<option value="">Interaction</option>
					<option value="1" <?= $filters['sort_by'] === 1 ? 'selected' : '' ?>>Interaction: Min</option>
					<option value="2" <?= $filters['sort_by'] === 2 ? 'selected' : '' ?>>Interaction: Max</option>
					<option value="1" <?= $filters['sort_by'] === 3 ? 'selected' : '' ?>>Data: Min</option>
					<option value="2" <?= $filters['sort_by'] === 4 ? 'selected' : '' ?>>Data: Max</option>
				</select>
			</div>

			<div class=" form-group post_type">
				<select data-title="Types" data-class-filter="filter-post-type"
				        name="type" class="form-control "
				        title="Post type" data-width="160px">
					<option value="">Types</option>
					<?php foreach ($types as $type):
						$selected = '';
						if ($type['value'] === $filters['type'])
						{
							$selected = 'selected';
						}
						?>
						<option value="<?= $type['value'] ?>" <?= $selected ?>><?= $type['name'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Date Created</label>
			</div>
			<div class=" form-group has-feedback form_input_date">

				<input data-title="From Date" data-class-filter="filter-to-date" type="text"
				       name="from_date"
				       value="<?= isset($filters['from_date']) ? $filters['from_date'] : '' ?>"
				       class="form-control " placeholder="From">
				<span class="glyphicon glyphicon-calendar form-control-feedback"
				      style="background:#E5E5E5;color: #404A7D;height: 30px"></span>
			</div>
			<div class=" form-group has-feedback form_input_date">
				<input data-title="To Date" data-class-filter="filter-to-date" type="text"
				       name="to_date"
				       value="<?= isset($filters['to_date']) ? $filters['to_date'] : '' ?>"
				       class="form-control " placeholder="To">
				<span class="glyphicon glyphicon-calendar form-control-feedback"
				      style="background:#E5E5E5;color: #404A7D;height: 30px"></span>

			</div>
			<?php if ($channel_type === CHANNEL_TYPE_FACEBOOK): ?>
				<div class="form-group">
					<a href="#" class="btn btn-xs btn-success pull-right group-export-csv can-export">
                                <span>
                                    <i class="fa fa-download"></i>
                                    <span>Download Post</span>
                                </span>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</form>
<script>
	$('input[name=from_date],input[name=to_date]').on('blur', function() {
		if (this.value === '') {
			this.type = 'text';
			$(this).parent().find('span').removeClass('hidden');
		}
	});

	$('input[name=from_date],input[name=to_date]').on('focus', function() {
		this.type = 'date';
		$(this).parent().find('span').addClass('hidden');
	});

	$('.sort_by').change(function() {

		$('.form_filters_post').submit();

	});
	$('.list_keyword_social input').click(function() {
		let $parent = $(this).parents('li');
		let color = $parent.attr('data-color');
		if ($parent.hasClass('active')) {
			$parent.removeClass('active');
			$parent.css({'color': '#ffffff'});
		} else {
			$parent.addClass('active');
			$parent.css({'color': color});
		}
		$('.form_filters_post').submit();
	});
</script>