<?php
$params = $this->config->config['params'];
$types = $params['types'];
/**
 * @var $keywords
 * @var array $filters
 * @var array $colorBg
 * @var array $channel_type
 * @var array $colorText
 */
?>
<style>
    .form-control-feedback {
        position: relative;
    }
</style>
<form method="get" class="form_filters_post form-filter">
    <div class="card" style="margin-top: 40px;margin-bottom: 15px">
        <div class="p-2">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option selected>Catagory</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <?php $this->load->view('/backend/monitoring/item_keywords'); ?>

    </div>
    <?php
    $types = $this->config->config['params']['types'];
    foreach ($items as $item) : ?>
        <?php $this->load->view('/backend/monitoring/_item', ['item' => $item, 'types' => $types]) ?>
    <?php endforeach; ?>

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
            $parent.css({
                'color': '#ffffff'
            });
        } else {
            $parent.addClass('active');
            $parent.css({
                'color': color
            });
        }
        $('.form_filters_post').submit();
    });
</script>