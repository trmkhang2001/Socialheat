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
        <div class="row g-5 g-xl-10 mb-xl-10">
            <!--begin::Col-->
            <div class="col-xxl-8">
                <!--begin::Chart widget 38-->
                <?php $this->load->view('/backend/monitoring/_item_fb_post', ['item' => $content, 'key' => $content['post_id']]) ?>
                <!--end::Chart widget 38-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xxl-4">
                <!--begin::Engage widget 1-->
                <div class="row h-md-100 d-flex justify-content-center" dir="ltr">
                    <div class="card col-5 me-3 mb-3 p-10">
                        <img class="img" src="/assets/images/icon-total-audience.png" alt="">
                        <span class="tgray mt-3 fw-bold">Total Profile</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($content['count_d']); ?></div>
                    </div>
                    <div class="card col-5 mb-3 p-10">
                        <img class="img" src="/assets/images/icon_total_mail.png" alt="">
                        <span class="tgray mt-3 fw-bold">Total Email</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['email_count']) ?></div>
                    </div>
                    <div class="card col-5 me-3 p-10">
                        <img class="img" src="/assets/images/icon_location.png" alt="">
                        <span class="tgray mt-3 fw-bold">Location</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['relationship_count']) ?></div>
                    </div>
                    <div class="card col-5 p-10">
                        <img class="img" src="/assets/images/icon_relationship.png" alt="">
                        <span class="tgray mt-3 fw-bold">Relationship</span>
                        <div class="fw-bold fs-2 mt-3"><?php echo number_format($group_data['relationship_count']) ?></div>
                    </div>
                </div>
                <!--end::Engage widget 1-->
            </div>
            <!--end::Col-->
        </div>
        <!-- end::Row -->
        <!-- begin::Row -->
        <div class="row">
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
                                <div class="m-portlet__head">
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
                                <div class="div" hidden>
                                    <?php
                                    render_field_panel();
                                    ?>
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
                                                                <div class="dataTables_length dataTables_filter" id="myTable_length">
                                                                    <label>Show
                                                                        <select name="myTable_length" aria-controls="groupTable" class="custom-select custom-select-sm form-control form-control-sm">
                                                                            <option value="10">10</option>
                                                                            <option value="25">25</option>
                                                                            <option value="50">50</option>
                                                                            <option value="100">100</option>
                                                                        </select> entries</label>

                                                                    <label>City : <select name="city" class="custom-select custom-select-sm form-control form-control-sm" id="city">
                                                                            <option value="">Select city</option>
                                                                            <?php foreach (get_cities() as $city) : ?>
                                                                                <option value="<?php echo vn_to_str($city); ?> "><?php echo $city; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </label>

                                                                    &nbsp;
                                                                    <label>Friends : <select name="friends" class="custom-select custom-select-sm form-control form-control-sm" id="friends">
                                                                            <option value="">Number of friend</option>
                                                                            <option value="> 5000"> > 5,000</option>
                                                                            <option value="4000-5000"> 4,000 - 5,000</option>
                                                                            <option value="3000-4000"> 3,000 - 4,000</option>
                                                                            <option value="2000-3000"> 2,000 - 3,000</option>
                                                                            <option value="1000-2000"> 1,000 - 2,000</option>
                                                                            <option value="<1000"> 0 - 999</option>
                                                                        </select>
                                                                    </label>

                                                                    <label>Follows : <select name="follows" class="custom-select custom-select-sm form-control form-control-sm" id="follows">
                                                                            <option value="">Number of followers</option>
                                                                            <option value="> 5000"> > 5,000</option>
                                                                            <option value="4000-5000"> 4,000 - 5,000</option>
                                                                            <option value="3000-4000"> 3,000 - 4,000</option>
                                                                            <option value="2000-3000"> 2,000 - 3,000</option>
                                                                            <option value="1000-2000"> 1,000 - 2,000</option>
                                                                            <option value="<1000"> 0 - 999</option>
                                                                        </select>
                                                                    </label>
                                                                    &nbsp;
                                                                    <label>Filter
                                                                        <select name="sex" class="custom-select custom-select-sm form-control form-control-sm" id="sex">
                                                                            <option value="">Sex</option>
                                                                            <option value="male">Male</option>
                                                                            <option value="female">Female</option>
                                                                        </select>
                                                                    </label>

                                                                    &nbsp;
                                                                    <label>
                                                                        <select name="relationship" class="custom-select custom-select-sm form-control form-control-sm" id="relationship">
                                                                            <option value="">Relationship</option>
                                                                            <option value="single">Single</option>
                                                                            <option value="married">Married</option>
                                                                            <option value="In a relationship">In a
                                                                                relationship
                                                                            </option>
                                                                            <option value="It's complicated">It's complicated
                                                                            </option>
                                                                            <option value="In an open relationship">In an open
                                                                                relationship
                                                                            </option>
                                                                            <option value="Engaged">Engaged</option>
                                                                            <option value="Divorced">Divorced</option>
                                                                            <option value="In a domestic partnership">In a
                                                                                domestic partnership
                                                                            </option>
                                                                            <option value="Separated">Separated</option>
                                                                            <option value="In a civil union">In a civil union
                                                                            </option>
                                                                        </select>
                                                                    </label>
                                                                    &nbsp;
                                                                    <?php
                                                                    $get_age_ranges = get_age_ranges();
                                                                    ?>
                                                                    <label>
                                                                        <select name="age" class="custom-select custom-select-sm form-control form-control-sm" id="age">
                                                                            <option value="">Age</option>
                                                                            <?php foreach ($get_age_ranges as $key => $age_range) : ?>
                                                                                <option value="<?php echo $age_range[0] . '_' . $age_range[1]; ?>"><?php echo $age_range[2]; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </label>
                                                                    &nbsp;
                                                                    <label>Search:<input type="search" id="search" class="form-control form-control-sm" placeholder="Uid or Phone" aria-controls="myTable"></label>

                                                                </div>
                                                                <div class="table_scrool_wrapper">
                                                                    <table id="uidTable" class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="uid sorting">Social Profile</th>
                                                                                <th class="Name name sorting">Name</th>
                                                                                <th class="email">Email</th>
                                                                                <th class="Phone">Phone</th>
                                                                                <th class="Friends friends sorting_desc">Friends
                                                                                </th>
                                                                                <th class="Follow follows sorting">Follow</th>
                                                                                <th class="Sex">Birthday</th>
                                                                                <th class="Sex">Sex</th>

                                                                                <th class="Relationship">Relationship</th>

                                                                                <?php $extra_fields = get_extra_fields_label();
                                                                                ?>
                                                                                <?php foreach ($extra_fields as $key => $extra_field) :

                                                                                ?>
                                                                                    <th class="<?php echo $key; ?>"><?php echo $extra_field; ?></th>
                                                                                <?php endforeach; ?>
                                                                                <th class="City">City</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-5">
                                                                        <div class="dataTables_info" id="myTable_info" role="status" aria-live="polite">Showing 1
                                                                            to <?php echo $items['limit'] ?>
                                                                            of <?php echo $items['totals']; ?> entries
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12 col-md-7">
                                                                        <div class="dataTables_paginate paging_simple_numbers" id="myTable_paginate">
                                                                            <?php helper_pagination($items['numpages'], 1); ?>
                                                                        </div>
                                                                    </div>
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