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
    <div class="card p-3" style="margin-top: 40px;margin-bottom: 15px">
        <div class="row pb-3">
            <div class="d-flex justify-content-start" style="width: 20%;">
                <select class="form-select" aria-label=".form-select-lg example">
                    <option selected>Catagory</option>
                    <option value="1">Marketing</option>
                    <option value="2">Navigation</option>
                </select>
            </div>
        </div>
        <div class="" style="overflow:scroll;height: 200px;">
            <?php $this->load->view('/backend/monitoring/item_keywords'); ?>
        </div>

    </div>
    <div class="card p-3">
        <div class="clearfix filter-input col-md-12">
            <div class="d-flex align-items-center flex-stack flex-wrap">
                <div class="mx-3 col has-feedback">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span><span class="path2"></span></i>
                        <input type="text" name="q" value="<?= isset($filters['q']) ? $filters['q'] : '' ?>" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-13 keyword_filters" id="inputValidation" placeholder="Keyword on Post">
                        <button id="btn-submit" type="submit" hidden></button>
                    </div>
                </div>
                <div class="me-3 col post_type">
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

                <div class="me-3 col post_type">
                    <select data-title="Types" data-class-filter="filter-post-type" name="type" class="form-select " title="Post type" data-width="160px">
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
                <div class="me-3 col fw-bold">
                    <span class="align-middle">Date Created</span>
                </div>
                <div class=" me-3 col has-feedback form_input_date">

                    <input data-title="From Date" data-class-filter="filter-to-date" type="text" name="from_date" value="<?= isset($filters['from_date']) ? $filters['from_date'] : '' ?>" class="form-control " placeholder="From">
                    <span class="glyphicon glyphicon-calendar form-control-feedback" style="background:#E5E5E5;color: #404A7D;height: 30px"></span>
                </div>
                <div class=" me-3 col has-feedback form_input_date">
                    <input data-title="To Date" data-class-filter="filter-to-date" type="text" name="to_date" value="<?= isset($filters['to_date']) ? $filters['to_date'] : '' ?>" class="form-control " placeholder="To">
                    <span class="glyphicon glyphicon-calendar form-control-feedback" style="background:#E5E5E5;color: #404A7D;height: 30px"></span>

                </div>
                <?php if ($channel_type === CHANNEL_TYPE_FACEBOOK) : ?>
                    <div class="col">
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
    </div>
    <?php
    $types = $this->config->config['params']['types'];
    foreach ($items as $item) : ?>
        <?php $this->load->view('/backend/monitoring/_item', ['item' => $item, 'types' => $types]) ?>
    <?php endforeach; ?>

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
</script>