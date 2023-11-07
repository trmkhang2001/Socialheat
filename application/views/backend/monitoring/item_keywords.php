<?php

use app\common\business\BusinessKeyword;

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
<ul class="list-inline list_keyword_social text-justify clearfix">
    <?php
    $indexColor = 0;
    $bg_color = '';
    $text_color = '';
    foreach ($keywords as $index => $keyword) :
        if ($keyword) :
            $keyword = \app\common\utilities\Common::trim($keyword, TRUE);
            if ($keyword)
                $slug = url_title(convert_accented_characters($keyword), '-', TRUE);
            if ($indexColor > 4) {
                $indexColor = 0;
            }
            $bg_color = $colorBg[$indexColor];
            $text_color = $colorText[$indexColor];
            $keywordColors[$slug] = $colorBg[$indexColor];
            $checked = '';
            $class = '';
            if (!empty($filters['keyword']) && in_array($keyword, $filters['keyword'], FALSE)) {
                $checked = 'checked';
                $class = 'active';
                $color = '#ffffff';
            }
            ++$indexColor;
    ?>
            <li class="list-inline-item text-lowercase bs-bg-opacity m-3 <?= $class ?>" data-color="<?= $bg_color ?>">
                <label class="rounded-pill fw-bold p-3" style=" background: <?= $bg_color ?>; color: <?= $text_color ?>">
                    <?= $keyword ?>
                </label>
            </li>
    <?php endif;
    endforeach; ?>
</ul>