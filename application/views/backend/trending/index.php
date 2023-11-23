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
            <?php $this->load->view('/backend/trending/_item_filters', ['filters' => $filters]) ?>
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