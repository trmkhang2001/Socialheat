<?php

use app\common\business\BusinessKeyword;
use app\common\utilities\Common;

/**
 * @var  $keywords ;
 */
if (empty($keywords)) {
    $keywords = BusinessKeyword::getInstance()->getAllCache();
    $keywords = explode(',', $keywords->keyword);
}
$colorBg = ['#ffd6cc', '#ccf2ff', '#ccffee', '#ffffcc', '#ffd6cc'];
$colorText = ['#FF5E5E', '#3633DB', '#33DB9E', '#F6C000', '#FF5E5E']
?>
<style>
    .keyword:hover {
        cursor: pointer;
    }
</style>
<ul class="list-inline list_keyword_social text-justify clearfix">
    <?php
    $indexColor = 0;
    $bg_color = '';
    $text_color = '';
    foreach ($keywords as $index => $keyword) :
        if ($keyword) :
            $keyword = Common::trim($keyword, TRUE);
            // if ($keyword)
            //     $slug = url_title(convert_accented_characters($keyword), '-', TRUE);
            if ($indexColor > 4) {
                $indexColor = 0;
            }
            $bg_color = $colorBg[$indexColor];
            $text_color = $colorText[$indexColor];
            // $keywordColors[$slug] = $colorBg[$indexColor];
            $checked = '';
            $class = '';
            $style = '';
            if (!empty($filters['keyword']) && in_array($keyword, $filters['keyword'], FALSE)) {
                $checked = 'checked';
                $class = 'active';
                $style = 'border: 2px solid;';
                $text_color = '#000000 !important';
            }
            ++$indexColor;
    ?>
            <li class="list-inline-item text-lowercase bs-bg-opacity m-1 <?= $class ?>" data-color="<?= $bg_color ?>">
                <label class="rounded fw-bold p-1 keyword " style="<?= $style ?> background: <?= $bg_color ?>; color: <?= $text_color ?>;">
                    <span style="padding: 10px;cursor: pointer;"><?= $keyword ?></span>
                    <input type="checkbox" name="keyword[]" <?= $checked ?> value="<?= $keyword ?>" hidden>
                </label>
            </li>
    <?php endif;
    endforeach; ?>
</ul>