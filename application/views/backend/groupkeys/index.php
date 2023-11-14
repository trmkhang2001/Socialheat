<?php
$items = array("Total Mentions", "Total Audience", "Total Keywords", "Total User Engage");
$name = array("Ensure Gold", "#ensureGold", "#ensurevietnam", "#ensuregoldvietnam", "#suaensure");
/**
 * @var $total
 * @var $item
 * @var $interactions
 * @var $userInfo
 * @var $id
 */
?>
<!-- Dashboard -->
<div class="content d-flex flex-column flex-row-fluid p-0" id="kt_wrapper">
    <!--begin::Header-->
    <div id="kt_header" class="header mt-0 mt-lg-0 pt-lg-0" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{lg: '300px'}">
        <!--begin::Container-->
        <div class="container d-flex flex-stack flex-wrap gap-4 ms-0" id="kt_header_container">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-10 pb-lg-0" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">
                <!--begin::Heading-->
                <h1 class="d-flex flex-column text-dark fw-bold my-0 fs-1">Add Group
                </h1>
                <!--end::Heading-->
            </div>
            <!--end::Page title=-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <!-- -------------- /Header  -------------- -->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <div class="card mb-10">
                <div class="card-body pt-9 pb-2 s-2">
                    <form action="" method="POST" class="form-horizontal allcp-form  form-edit-item" role="form">
                        <?php if (isset($item)) : ?>
                            <label>
                                <input type="hidden" name="id" value="<?php echo $item->id ?>" />
                            </label>
                        <?php else : ?>
                            <label>
                                <input type="hidden" name="id" value="<?php echo $id ?>" />
                            </label>
                        <?php endif ?>
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Group Keyword Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="groupkeys" id="groupkeys" placeholder="Group Keyword Name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input type="text" style="height: 150px;" class="form-control" name="description" id="description">
                            </div>
                        </div>
                        <div class="mb-3 row d-flex">
                            <div class="d-flex justify-content-end align-items-center gap-2 gap-lg-3">
                                <a href="/backend/dashboards" class="btn btn-sm fw-bold btn-secondary indicator-label"> Cancel</a>
                                <a type="button" @click="saveComplete" href="" class="btn btn-sm fw-bold btn-primary"> Add Group</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Content-->
</div>
<?php $this->load->view('backend/layout/submit_form', ['urlRedirect' => '/backend/groupkeys']) ?>