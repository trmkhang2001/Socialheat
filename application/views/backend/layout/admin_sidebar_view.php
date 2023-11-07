<!-- -------------- Sidebar -------------- -->
<?php

/**
 * @var $userInfo
 */
?>

<!--begin::Aside-->
<div id="kt_aside" class="aside py-9" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Brand-->
    <div class="aside-logo px-9 mb-9" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="../../demo3/dist/index.html">
            <img alt="Logo" src="/assets/images/logo.png" class="h-20px logo theme-light-show" />
            <img alt="Logo" src="/assets/images/logo.png" class="h-20px logo theme-dark-show" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid ps-5 pe-3 mb-9" id="kt_aside_menu">
        <!--begin::Aside Menu-->
        <div class="w-100 hover-scroll-overlay-y d-flex pe-2" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper" data-kt-scroll-offset="100">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded fw-semibold px-1" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <!-- begin::Menu item Dashboard -->
                <div class="menu-item">
                    <a href="/backend/dashboards" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span><span class="menu-title">Dashboard</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <!-- end -->
                <!--begin:Menu item Monitoring-->
                <div class="menu-item">
                    <a href="/backend/monitoring" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="ki-outline ki-graph-up fs-2"></i></span><span class="menu-title">Monitoring</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <!-- end -->
                <!--begin:Menu item Interaction-->
                <div class="menu-item">
                    <a href="/backend/interactions" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="ki-outline ki-like fs-1"></i></span><span class="menu-title">Interaction</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <!-- end -->
                <!--begin:Menu item Monitoring-->
                <div class="menu-item">
                    <a href="/backend/profile" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="ki-outline ki-user fs-3"></i></span><span class="menu-title">Profile</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <!-- end -->
                <div data-kt-menu-trigger="click" class="menu-item fw-bold mb-3 hover showing"><!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i class="ki-outline ki-address-book fs-2"></i></span><span class="menu-title">Admin</span><span class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion"><!--begin:Menu item-->
                        <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/groupkeys"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Add
                                    Group</span></a><!--end:Menu link--></div>
                        <!--end:Menu item--><!--begin:Menu item-->
                        <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/keywords"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Keyword</span></a><!--end:Menu link-->
                        </div><!--end:Menu item--><!--begin:Menu item-->
                        <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="#"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Social
                                    Audience</span></a><!--end:Menu link--></div>
                        <!--end:Menu item--><!--begin:Menu item-->
                        <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="#"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">User
                                    Managment</span></a><!--end:Menu link--></div>
                        <!--end:Menu item--><!--begin:Menu item-->
                        <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="#"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Xpath</span></a><!--end:Menu link-->
                        </div><!--end:Menu item--><!--begin:Menu item-->
                        <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="#"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Add
                                    Items</span></a><!--end:Menu link--></div><!--end:Menu item-->
                        <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="#"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Config</span></a><!--end:Menu link-->
                        </div><!--end:Menu item-->
                    </div><!--end:Menu sub-->
                </div>
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto px-9" id="kt_aside_footer">
        <!--begin::User panel-->
        <div class="d-flex flex-stack">
            <!--begin::Wrapper-->
            <div class="d-flex align-items-center">
                <!--begin::Avatar-->
                <div class="symbol symbol-circle symbol-40px">
                    <img src="<?php echo $userInfo['avatar'] ?>" alt="photo" />
                </div>
                <!--end::Avatar-->
                <!--begin::User info-->
                <div class="ms-2">
                    <!--begin::Name-->
                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold lh-1"><?php echo $userInfo['name'] ?></a>
                    <!--end::Name-->
                    <!--begin::Major-->
                    <span class="text-muted fw-semibold d-block fs-7 lh-1">Developer</span>
                    <!--end::Major-->
                </div>
                <!--end::User info-->
            </div>
            <!--end::Wrapper-->
            <!--begin::User menu-->
            <div class="ms-1">
                <div class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-overflow="true" data-kt-menu-placement="top-end">
                    <i class="ki-duotone ki-setting-2 fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--begin::User account menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-50px me-5">
                                <img alt="Logo" src="<?php echo $userInfo['avatar'] ?>" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Username-->
                            <div class="d-flex flex-column">
                                <div class="fw-bold d-flex align-items-center fs-5"><?php echo $userInfo['name'] ?>
                                </div>
                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7"><?php echo $userInfo['email'] ?></a>
                            </div>
                            <!--end::Username-->
                        </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="/backend/profile" class="menu-link px-5">My
                            Profile</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                        <a href="auth/logOut" class="menu-link px-5">Sign Out</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::User account menu-->
            </div>
            <!--end::User menu-->
        </div>
        <!--end::User panel-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Aside-->
<!-- -------------- End Sidebar -------------- -->