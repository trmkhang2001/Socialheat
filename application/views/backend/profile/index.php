<?php
$items = array("Total Mentions", "Total Audience", "Total Keywords", "Total User Engage");
$name = array("Ensure Gold", "#ensureGold", "#ensurevietnam", "#ensuregoldvietnam", "#suaensure");
/**
 * @var $total
 * @var $item
 * @var $interactions
 * @var $userInfo
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
                <h1 class="d-flex flex-column text-dark fw-bold my-0 fs-1">Profile
                </h1>
                <!--end::Heading-->
            </div>
            <!--end::Page title=-->
            <!--begin::Wrapper-->
            <div class="d-flex d-lg-none align-items-center ms-n3 me-2">
                <!--begin::Aside mobile toggle-->
                <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">
                    <i class="ki-duotone ki-abstract-14 fs-1 mt-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Aside mobile toggle-->
                <!--begin::Logo-->
                <a href="#" class="d-flex align-items-center">
                    <img alt="Logo" src="/assets/images/logo.png" class="theme-light-show h-20px" />
                </a>
                <!--end::Logo-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->
    <!-- -------------- /Header  -------------- -->
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Container-->
        <div class="container-fluid" id="kt_content_container">
            <div class="card mb-6">
                <div class="card-body pt-9 pb-2">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="<?= $userInfo['avatar'] ?>" alt="image">
                            </div>
                        </div>
                        <!--end::Pic-->

                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?= $userInfo['name'] ?></a>
                                        <a href="#"><i class="ki-duotone ki-verify fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i></a>
                                    </div>
                                    <!--end::Name-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#" class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
                                            <i class="ki-duotone ki-profile-circle fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> Developer
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                </div>
            </div>
            <div class="card mb-6">
                <div class="card-body pt-9 pb-2 s-2">
                    <h1 class="mb-10">Profile Information</h1>
                    <form action="">
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Fullname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="fullname" value="<?= $userInfo['name'] ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" value="<?= $userInfo['email'] ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" aria-readonly="" class="form-control" id="email" value="<?= $userInfo['email'] ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                                <input type="text" aria-readonly="" class="form-control" id="phone" value="<?= $userInfo['phone'] ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <div class="card mb-10">
                <div class="card-body pt-9 pb-2 s-2">
                    <h1 class="mb-10">Privacy & Password</h1>
                    <form action="">
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Email Address*</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" value="<?= $userInfo['email'] ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Password*</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" value="********">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="text" class="col-sm-2 col-form-label">Password Confirm*</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="passwordConfirm" value="********">
                            </div>
                        </div>
                        <div class="mb-3 row d-flex">
                            <div class="d-flex justify-content-end align-items-center gap-2 gap-lg-3">
                                <a href="/backend/dashboards" class="btn btn-sm fw-bold btn-secondary indicator-label"> Cancel</a>
                                <a href="" class="btn btn-sm fw-bold btn-primary"> Save Changes</a>
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