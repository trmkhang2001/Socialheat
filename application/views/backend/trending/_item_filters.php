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
    <div class="card p-3">
        <div class="clearfix filter-input col-md-12">
            <div class="row align-items-start flex-wrap">
                <div class="me-3 col-2 post_type">
                    <div class="card-toolbar">
                        <select data-title="Types" data-class-filter="filter-post-type" name="sort_by" class="form-select  sort_by" title="Post type" data-width="160px">
                            <option value="#">Interaction</option>
                            <option value="1" <?= $filters['sort_by'] === 1 ? 'selected' : '' ?>>Interaction: Min</option>
                            <option value="2" <?= $filters['sort_by'] === 2 ? 'selected' : '' ?>>Interaction: Max</option>
                            <option value="1" <?= $filters['sort_by'] === 3 ? 'selected' : '' ?>>Data: Min</option>
                            <option value="2" <?= $filters['sort_by'] === 4 ? 'selected' : '' ?>>Data: Max</option>
                        </select>
                    </div>
                </div>

                <div class="me-3 col-2 post_type">
                    <select data-title="Types" data-class-filter="filter-post-type" name="type" class="form-select" title="Post type" data-width="160px">
                        <option value="">Types</option>
                        <?php foreach ($types as $type) :
                            $selected = '';
                            if ($type['value'] === $filters['type']) {
                                $selected = 'selected';
                            }
                        ?>
                            <option value="<?= $type['value'] ?>" <?= $selected ?>><?= $type['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- <div class="me-3 col fw-bold">
                    <span class="align-middle">Date Created</span>
                </div> -->
                <!-- <div class=" me-3 col has-feedback form_input_date">
                    <input data-title="From Date" data-class-filter="filter-to-date" type="text" name="from_date" value="<?= isset($filters['from_date']) ? $filters['from_date'] : '' ?>" class="form-control " placeholder="From">
                    <span class="glyphicon glyphicon-calendar form-control-feedback" style="background:#E5E5E5;color: #404A7D;height: 30px"></span>
                </div>
                <div class=" me-3 col has-feedback form_input_date">
                    <input data-title="To Date" data-class-filter="filter-to-date" type="text" name="to_date" value="<?= isset($filters['to_date']) ? $filters['to_date'] : '' ?>" class="form-control " placeholder="To">
                    <span class="glyphicon glyphicon-calendar form-control-feedback" style="background:#E5E5E5;color: #404A7D;height: 30px"></span>
                </div> -->
                <div class="me-3 col-2 has-feedback">
                    <button type="submit" class="btn btn-primary btn-icon-submit" style="background-color: #0B0044;">Filter</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    var input = document.getElementById("inputValidation");
    input.addEventListener("keypress", function(event) {
        // If the user presses the "Enter" key on the keyboard
        if (event.key === "Enter") {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            document.getElementById("btn-submit").click();
        }
    });
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
    $(document).ready(function() {
        $("#inputValidation").keypress(function(event) {
            if (event.which === 13) {
                event.preventDefault();
                // Thực hiện hành động submit tại đây
                // Ví dụ: $("#myForm").submit();
            }
        });
    });
</script>