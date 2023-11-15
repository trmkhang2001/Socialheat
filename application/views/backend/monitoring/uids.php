<?php
$name = array("Ensure Gold", "#ensureGold", "#ensurevietnam", "#ensuregoldvietnam", "#suaensure");
/**
 * @var $total
 * @var $totalSocial
 * @var $item
 * @var $interactions
 * @var $userInfo
 * @var $totalKeywords
 */
?>
<style>
    .header {
        height: 0px;
    }

    .img {
        width: 72px;
        height: 72px;
    }

    .tgray {
        color: gray;
    }

    li {
        list-style: none;
    }
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Container-->
    <div class="container-fluid" id="kt_content_container">
        <h1 class="mb-7">Monitoring</h1>
        <!--begin::Row-->
        <div class="row mb-5">
            <!--begin::Col-->
            <div class="col-8">
                <!--begin::Chart widget 38-->
                <?php $this->load->view('/backend/monitoring/_item_fb_post', ['item' => $content, 'key' => $content['post_id']]) ?>
                <!--end::Chart widget 38-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-4">
                <div class="">
                    <!--begin::Engage widget 1-->
                    <div class="d-flex justify-content-center align-items-center row">
                        <div class="col">
                            <div class="card p-5 d-flex justify-content-center">
                                <img class="img" src="/assets/images/icon-total-audience.png" alt="">
                                <span class="tgray mt-3 fw-bold">Total Profile</span>
                                <div class="fw-bold fs-2 mt-3"><?php echo number_format($content['count_d']); ?></div>
                            </div>
                            <div class="card p-5 mt-5">
                                <img class="img" src="/assets/images/icon_total_mail.png" alt="">
                                <span class="tgray mt-3 fw-bold">Total Email</span>
                                <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['email_count']) ?></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card p-5">
                                <img class="img" src="/assets/images/icon_location.png" alt="">
                                <span class="tgray mt-3 fw-bold">Location</span>
                                <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['relationship_count']) ?></div>
                            </div>
                            <div class="card p-5 mt-5">
                                <img class="img" src="/assets/images/icon_relationship.png" alt="">
                                <span class="tgray mt-3 fw-bold">Relationship</span>
                                <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['relationship_count']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col-->
        </div>
        <!-- end::Row -->
        <!-- begin::Row -->
        <div class=" row mb-5">
            <div class="col-4">
                <div class="card">
                    <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Gender</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">3 types of gender</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-10">
                        <canvas id="doughnutChartGender"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <div class="col-4">
                <div class="card"> <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Age</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">6 age ranges</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-10">
                        <canvas id="doughnutChartAge"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <div class="col-4">
                <div class="card"> <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Relationship</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">The most common 6 types of relationship</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-10">
                        <canvas id="doughnutChartRelationship"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-4">
                <div class="card">
                    <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Friends</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Friends of friends</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-10">
                        <canvas id="doughnutChartFriends"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <div class="col-4">
                <div class="card"> <!--begin::Header-->
                    <div class="card-header">
                        <!--begin::Title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Follows</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">User’s followers</span>
                        </h3>
                        <!--end::Title-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-10">
                        <canvas id="doughnutChartFollows"></canvas>
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
        <!-- end::Row -->
        <div class="export-status form-group m-form__group" style="display: none;">
            <h6>Downloading</h6>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    0% Complete
                </div>
            </div>
        </div>
        <!-- begin::Row -->
        <div class="row">
            <!--begin::Col-->
            <div class="col-xxl">
                <div class="card p-5">
                    <div class="m-portlet m-portlet--tabs">
                        <div class="m-portlet__body">
                            <script type="text/json" id="uid-data">
                                <?php echo json_encode($items); ?>
                            </script>
                            <div class="m-portlet m-portlet--mobile">
                                <div class="m-portlet__head mb-10">
                                    <div class="m-portlet__head-tools d-flex justify-content-end">
                                        <?php if (in_array($userInfo['role_id'], [ROLE_ADMIN, ROLE_DOWNLOAD], FALSE)) : ?>

                                            <a href="#uids-list" class="btn btn-secondary m-btn m-btn--custom m-btn--icon m-btn--air btn-export group-export-csv can-export">
                                                <span>
                                                    <i class="la la-download"></i>
                                                    <span>Download Data</span>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    </div>

                                </div>

                                <div class="m-portlet__body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="export-status form-group m-form__group" style="display: none;">
                                                <h6>Downloading</h6>
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                        0% Complete
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="uids-form">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="table-responsive uids-list" id="uids-list">
                                                            <div id="myTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                                                <div class="m-loader m-loader--primary" style="text-align: center;display: none;width: 100%;height: 100%;top: 0px;left: 0px;position: absolute;z-index: 9;background: #fff;">
                                                                    <svg class="circular" viewBox="25 25 50 50">
                                                                        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                                                                    </svg>
                                                                </div>
                                                                <div class="table_scrool_wrapper">
                                                                    <table id="uidTable" class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                                                        <thead>
                                                                            <tr class="fw-bold text-muted">
                                                                                <th class="uid sorting">Social Profile</th>
                                                                                <th class="Name name sorting">Name</th>
                                                                                <th class="email">Email</th>
                                                                                <th class="Phone">Phone</th>
                                                                                <th class="Friends friends sorting_desc">Friends</th>
                                                                                <th class="Follow follows sorting">Follow</th>
                                                                                <th class="Sex">Birthday</th>
                                                                                <th class="Sex" style="min-width: 150px">Sex</th>
                                                                                <th class="Relationship">Relationship</th>
                                                                                <th class="City">City</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                            <?php
                                                                            /**
                                                                             * @var $interactions
                                                                             */
                                                                            foreach ($interactions as $value) :
                                                                            ?>
                                                                                <tr>
                                                                                    <td>
                                                                                        <div class="d-flex align-items-center symbol symbol-50px">
                                                                                            <a href="https://facebook.com/<?= $value['uid'] ?>" class="symbol symbol-50px" target="_blank">
                                                                                                <img style="width: 40px;" class="m--img-rounded m--marginless" src="https://graph.facebook.com/<?= $value['uid'] ?>/picture?type=large&width=500&height=500&access_token=2712477385668128|b429aeb53369951d411e1cae8e810640" alt="">
                                                                                            </a>

                                                                                        </div>
                                                                                    </td>
                                                                                    <td><a target="_blank" href="https://facebook.com/<?= $value['uid'] ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name"><?= $value['name'] ?></a></td>
                                                                                    <td><?= $value['email'] ?  substr($value['email'], 0, -4) . '****' : '' ?></td>
                                                                                    <td><?= substr($value['phone'], 0, -4) . '****' ?></td>
                                                                                    <td><?= $value['friends'] ?></td>
                                                                                    <td><?= $value['follow'] ?></td>
                                                                                    <td><?= $value['birthday'] ?></td>
                                                                                    <td>
                                                                                        <?php
                                                                                        if ($value['sex'] === 'male') : ?>
                                                                                            <span class="m-badge  m-badge--male m-badge--wide" style="color:white;letter-spacing: 0.6px;padding: 1px 10px;border-radius: 0.75rem;background-color: #3F51B5"><i class="fa fa-mars" aria-hidden="true"></i>male</span>
                                                                                        <?php
                                                                                        elseif ($value['sex'] === 'female') : ?>
                                                                                            <span class="m-badge  m-badge--female m-badge--wide" style="color:white;letter-spacing: 0.6px;padding: 1px 10px;border-radius: 0.75rem;background-color: #E91E63"">
					                                                                    <i class=" fa fa-venus" aria-hidden="true"></i>
                                                                                                female</span>
                                                                                        <?php
                                                                                        else : ?>
                                                                                            <div class="d-flex">
                                                                                                <div style="width: 20px;height: 20px;border-radius: 50%;background-color: #8c8c93"></div>
                                                                                                <div style="padding-left: 5px">other
                                                                                                </div>

                                                                                            </div>
                                                                                        <?php


                                                                                        endif; ?>
                                                                                    </td>
                                                                                    <td><?= $value['relationship'] ?></td>
                                                                                    <td><?= $value['city'] ?></td>
                                                                                </tr>
                                                                            <?php
                                                                            endforeach ?>
                                                                        </tbody>

                                                                    </table>
                                                                </div>
                                                                <div class="row mt-5">

                                                                    <?= $pagination ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end::Row -->
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>
<script type="text/json" id="extra-fields">
    <?php echo json_encode(get_extra_fields()); ?>
</script>
<script src="<?= site_url('/assets/js/custom.js') ?>"></script>
<script src="<?= site_url('/assets/js/convert.js') ?>"></script>