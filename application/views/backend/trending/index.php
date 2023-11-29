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
        -webkit-line-clamp: 2;
        /* number fs-1 p-3  of lines to show */
        line-clamp: 2;
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

    .img-thum {
        height: 280px;
        width: 100% !important;
    }

    .item {
        margin: 2px;
    }

    .title_social:hover {
        color: var(--bs-primary) !important;
    }

    .text-limit-length {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 15ch;
        display: inline-block;
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
            <?php foreach ($items as $item) :
                if (($item->image_url != NULL) && (!empty($item->content)) && (!empty($item->count_d)))
                    $this->load->view('/backend/trending/_item', ['item' => $item, 'types' => $types]);
            endforeach; ?>
        </div>
        <div class="row clearfix text-center" style="display: block">
            <?= $pagination ?>
        </div>
    </div>
</div>