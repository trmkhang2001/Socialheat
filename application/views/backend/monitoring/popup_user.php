<?php
// var_dump($missinteractions);
?>
<!-- Modal User  -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Tương Tác</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted">
                                <th>
                                    NO.
                                </th>
                                <th>Profile</th>
                                <th>Uid</th>
                                <th></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            <?php $index = 0;
                            foreach ($missinteractions['miss'] as $miss) {
                                $index++ ?>
                                <tr>
                                    <td>
                                        <span><?= $index ?>.</span>
                                    </td>
                                    <td>
                                        <a href="https://facebook.com/<?= $miss->uid ?>" class="symbol symbol-50px me-4" target="_blank">
                                            <img style="width: 40px; height:40px" class="border rounded-pill m--img-rounded m--marginless" src="https://graph.facebook.com/<?= $miss->uid ?>/picture?type=large&amp;width=500&amp;height=500&amp;access_token=2712477385668128|b429aeb53369951d411e1cae8e810640" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="https://facebook.com/100004882509279" target="_blank">
                                                <span class="text-dark fw-bold text-hover-primary fs-6"><?= $miss->uid ?></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                        <div class="dataTables_paginate paging_simple_numbers" id="kt_ecommerce_report_views_table_paginate">
                            <?= $missinteractions['pagination'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>