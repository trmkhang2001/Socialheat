<?php

/**
 * @var $items
 * @var $pagination
 * @var $filters
 * @var $total
 */
?>
<!-- Dashboard -->
<div class="content d-flex flex-column flex-row-fluid p-0" id="kt_wrapper">
    <div class="container-fluid">
        <h1 class="mb-7">Monitoring</h1>
        <div class="clearfix form-filter m--margin-bottom-10">
            <?php $this->load->view('/backend/monitoring/_item_filters', ['filters' => $filters]) ?>
        </div>
    </div>
</div>