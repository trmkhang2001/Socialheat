<?php

/**
 * @var $items
 * @var $pagination
 * @var $filters
 * @var $total
 */
?>
<style>
    .text {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 6;
        /* number fs-1 p-3  of lines to show */
        line-clamp: 6;
        -webkit-box-orient: vertical;
    }

    .chats {
        display: inline-flex;
    }

    .number {
        font-weight: bold;
    }

    ul {
        margin-top: 10px;
        margin-left: 15px;
    }

    li {
        list-style: none;
    }

    .item {
        margin: 2px;
    }

    .title_social:hover {
        color: var(--bs-primary) !important;
    }
</style>
<!-- Dashboard -->
<div class="m-content d-flex flex-column flex-row-fluid p-0" id="kt_wrapper">
    <div class="container-fluid">
        <h1 class="mb-5">Ads Trend</h1>
        <div class="card p-3 mb-5">
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
                </div>
            </div>
        </div>
        <h1 class="mb-5">Total</h1>
        <div class="row gx-5 gx-xl-10">
            <?php foreach ($items as $item) : ?>
                <?php $this->load->view('/backend/trending/_item', ['item' => $item, 'types' => $types]) ?>
            <?php endforeach; ?>
        </div>
        <div class="row clearfix text-center" style="display: block">
            <?= $pagination ?>
        </div>
    </div>
</div>