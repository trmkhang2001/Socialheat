<div class="content d-flex flex-column flex-row-fluid" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header mt-0 mt-lg-0 pt-lg-0" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{lg: '300px'}">
        <!--begin::Container-->
        <div class="container d-flex flex-stack flex-wrap gap-4 ms-0" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-10 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="d-flex flex-column text-dark fw-bold my-0 fs-1">CRM Phone
                </h1>
                <!--end::Heading-->
            </div>
            <div class="">
                <a href="/backend/crm/create" class="btn btn-primary">Thêm CRM Phone</a>
            </div>
            <!--end::Page title=-->
            <!--begin::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <!-- -------------- /Header  -------------- -->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted">
                            <th class="w-25px">
                                NO.
                            </th>
                            <th class="min-w-500px">Phone</th>
                            <th></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        <?php

                        foreach ($items as $index =>  $item) :
                        ?>
                            <tr>
                                <td>
                                    <span><?php echo number_format($index + 1) ?>.</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="/backend/monitoring">
                                            <span class="text-dark fw-bold text-hover-primary fs-6"><?= $item->phone ?></span>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" href="/backend/crm/delete/<?php echo $item->id ?>" class="btn btn-delete btn-danger" aria-label="Delete" data-bs-original-title="Delete" data-kt-initialized="1"><i class="ki-outline ki-trash fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                    <div class="dataTables_paginate paging_simple_numbers" id="kt_ecommerce_report_views_table_paginate">
                        <?php echo $pagination ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>