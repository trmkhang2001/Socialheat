<?php

use app\common\business\BusinessKeyword;

/**
 * @var  $keywords ;
 */
if (empty($keywords))
{
	$keywords = BusinessKeyword::getInstance()->getAllCache();
	$keywords = explode(',', $keywords->keyword);
}
$colorBg = ['#6478E6', '#E58364', '#30AAD0', '#ED9494', '#8FB981'];
?>
<ul class="list-inline list_keyword_social text-justify clearfix">
	<?php
	$indexColor = 0;
	$bg_color = '';
	foreach ($keywords as $index => $keyword):
		if($keyword):
		$keyword = \app\common\utilities\Common::trim($keyword, TRUE);
		if ($keyword)
			$slug = url_title(convert_accented_characters($keyword), '-', TRUE);
		if ($indexColor > 4)
		{
			$indexColor = 0;
		}
		$bg_color = $colorBg[$indexColor];
		$keywordColors[$slug] = $colorBg[$indexColor];
		$checked = '';
		$class = '';
		if ( ! empty($filters['keyword']) && in_array($keyword, $filters['keyword'], FALSE))
		{
			$checked = 'checked';
			$class = 'active';
			$color = '#ffffff';
		}
		++$indexColor;
		?>
		<li class="text-lowercase <?= $class ?>" data-color="<?= $bg_color ?>">
			<label style=" background: <?= $bg_color ?>;">
				<?= $keyword ?>
				<input type="checkbox" name="keyword[]" <?= $checked ?> value="<?= $keyword ?>" class="hidden">
			</label>
		</li>
	<?php endif;endforeach; ?>
</ul>