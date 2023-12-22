<!-- -------------- Sidebar -------------- -->
<?php

/**
 * @var $userInfo
 */
$params = $this->config->config['params'];
$roles = $params['user_role'];
?>

<!--begin::Aside-->
<div id="kt_aside" class="aside py-9" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
    <!--begin::Brand-->
    <div class="aside-logo px-9 mb-9" id="kt_aside_logo">
        <!--begin::Logo-->
        <a href="/backend/dashboards">
            <img alt="Logo" src="/assets/images/logo.png" class="h-30px logo theme-light-show" />
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
                <!--begin:Menu item Brand Heath-->
                <div class="menu-item">
                    <a href="/backend/BrandHeath" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="fa-brands fa-slack fs-1"></i></span><span class="menu-title">Brand Health</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <!-- end -->
                <!-- begin:Menu item Keyword Brand -->
                <div class="menu-item">
                    <a href="/backend/KeywordBrand" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="fa-solid fa-list"></i></span><span class="menu-title">Keyword Brand</span><!--end:Menu link--><!--begin:Menu sub-->
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
                <!-- begin::Menu item Ads -->
                <div class="menu-item">
                    <a href="/backend/trending" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="fa-brands fa-buysellads fs-1"></i></span><span class="menu-title">Ads</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <div class="menu-item">
                    <a href="/backend/socialItems/clients" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g opacity="0.35">
                                    <path d="M20 14C21.1046 14 22 13.1046 22 12C22 10.8954 21.1046 10 20 10C18.8954 10 18 10.8954 18 12C18 13.1046 18.8954 14 20 14Z" stroke="#0B0044" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20 6C21.1046 6 22 5.10457 22 4C22 2.89543 21.1046 2 20 2C18.8954 2 18 2.89543 18 4C18 5.10457 18.8954 6 20 6Z" stroke="#0B0044" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M20 22C21.1046 22 22 21.1046 22 20C22 18.8954 21.1046 18 20 18C18.8954 18 18 18.8954 18 20C18 21.1046 18.8954 22 20 22Z" stroke="#0B0044" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M4 14C5.10457 14 6 13.1046 6 12C6 10.8954 5.10457 10 4 10C2.89543 10 2 10.8954 2 12C2 13.1046 2.89543 14 4 14Z" stroke="#0B0044" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6 12H18" stroke="#0B0044" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M18 4H14C12 4 11 5 11 7V17C11 19 12 20 14 20H18" stroke="#0B0044" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg></span><span class="menu-title">Social Audience</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <!-- end::Menu item Ads -->
                <!--begin:Menu item Monitoring-->
                <div class="menu-item">
                    <a href="/backend/profile" class="menu-link">
                        <!--begin:Menu link--><span class="menu-icon"><i class="ki-outline ki-user fs-3"></i></span><span class="menu-title">Profile</span><!--end:Menu link--><!--begin:Menu sub-->
                    </a>
                </div>
                <?php if ($userInfo['role_id'] === ROLE_ADMIN) : ?>
                    <!-- end -->
                    <div data-kt-menu-trigger="click" class="menu-item mb-3 hover showing"><!--begin:Menu link--><span class="menu-link"><span class="menu-icon"><i class="ki-outline ki-address-book fs-2"></i></span><span class="menu-title" style="color: var(--bs-gray-700);">Admin</span><span class="menu-arrow"></span></span><!--end:Menu link--><!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/socialItems"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Social Audience</span></a><!--end:Menu link--></div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/items"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Items List</span></a><!--end:Menu link--></div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/groupKeys"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Add Group</span></a><!--end:Menu link--></div>
                            <!--end:Menu item--><!--begin:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/keywords"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Keyword</span></a><!--end:Menu link-->
                            </div><!--end:Menu item--><!--begin:Menu item-->
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/crm"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">CRM Phone</span></a><!--end:Menu link-->
                            </div>
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/users"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">User
                                        Managment</span></a><!--end:Menu link--></div>
                            <!--end:Menu item--><!--begin:Menu item-->
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/xpath"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Xpath</span></a><!--end:Menu link-->
                            </div><!--end:Menu item--><!--begin:Menu item-->
                            <div class="menu-item"><!--begin:Menu link--><a class="menu-link" href="/backend/xpath/token"><span class="menu-bullet"><span class="bullet bullet-dot"></span></span><span class="menu-title hover-menu-item-text text-gray-600">Config</span></a><!--end:Menu link-->
                            </div><!--end:Menu item-->
                        </div><!--end:Menu sub-->
                    </div>
                <?php endif ?>
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
                    <img src="<?php if ($userInfo['avatar'] == NULL) echo '/assets/images/no_avatar.png';
                                else echo $userInfo['avatar'] ?>" alt="photo" />
                </div>
                <!--end::Avatar-->
                <!--begin::User info-->
                <div class="ms-2">
                    <!--begin::Name-->
                    <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bold lh-1"><?php echo $userInfo['name'] ?></a>
                    <!--end::Name-->
                    <!--begin::Major-->
                    <span class="text-muted fw-semibold d-block fs-7 lh-1">
                        <?php foreach ($roles as $role) :
                            if ($userInfo['role_id'] === $role['id'])
                                echo $role['name'];
                        endforeach; ?>
                    </span>
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
                                <img alt="Logo" src="<?php if ($userInfo['avatar'] == NULL) echo '/assets/images/no_avatar.png';
                                                        else echo $userInfo['avatar'] ?>" />
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
                        <a href="<?php echo site_url() ?>auth/logout" class="menu-link px-5">Sign Out</a>
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