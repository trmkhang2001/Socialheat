<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="../../../">
    <title>Admin Dashboard</title>
    <meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords" content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="Https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="/assets/images/fav-icon.png" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/assets/demo3/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/demo3/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable" style="background-image: url('/assets/images/bglogin.png');background-repeat: no-repeat;height: auto">
    <!--begin::Main-->
    <div class="__login m-15">
        <div class="text-center">
            <img src="/assets/images/logo.png" alt="">
        </div>
        <div class="mw-1920 d-flex flex-center m-7">
            <div class="register" id="register">
                <div class="d-flex flex-row ">
                    <!--begin::Wrapper-->
                    <div class="card card-flush w-md-400px w-lg-400px w-xl-400px w-325px py-5">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <h1 class="">Register</h1>
                            </div>
                            <?php if ($msg != "") { ?>
                                <div class="alert alert-danger">
                                    <strong><?php echo $msg ?></strong>
                                </div>
                            <?php } ?>
                            <!--begin::Form-->
                            <form class="form w-100 form-edit-item" method="post" action="sigup/register">
                                <!--begin::Input group=-->
                                <div class="fv-row mb-4">
                                    <label class="fw-bold text-black-main py-3 font-size-h5">Name</label>
                                    <input type="text" class="form-control bg-gray-100 py-4" name="name" placeholder="Name" autocomplete="off" value="<?php if ($name) {
                                                                                                                                                            echo $name;
                                                                                                                                                        } ?>" required>
                                </div>
                                <div class="fv-row mb-4">
                                    <!--begin::Email-->
                                    <label class="fw-bold text-black-main py-3 font-size-h5" style="font-weight: 600">Email</label>
                                    <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-gray-100 py-4" value="<?php if ($email) {
                                                                                                                                                                echo $email;
                                                                                                                                                            } ?>" required>
                                    <!--end::Email-->
                                </div>
                                <!--end::Input group=-->
                                <div class="fv-row mb-4">
                                    <!--begin::Password-->
                                    <label class="fw-bold text-black-main py-3 font-size-h5" style="font-weight: 600">Password</label>
                                    <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-gray-100 py-4" required>
                                    <!--end::Password-->
                                </div>
                                <div class="fv-row mb-4">
                                    <!--begin::Password-->
                                    <label class="fw-bold text-black-main py-3 font-size-h5" style="font-weight: 600">Confirm Password</label>
                                    <input type="password" placeholder="Confirm Password" name="confirm_password" autocomplete="off" class="form-control bg-gray-100 py-4" required>
                                    <!--end::Password-->
                                </div>
                                <div class="fv-row mb-4">
                                    <!--begin::Password-->
                                    <label class="fw-bold text-black-main py-3 font-size-h5" style="font-weight: 600">Phone</label>
                                    <input type="phone" placeholder="Phone" name="phone" autocomplete="off" class="form-control bg-gray-100 py-4" value="<?php if ($phone) {
                                                                                                                                                                echo $phone;
                                                                                                                                                            } ?>">
                                    <!--end::Password-->
                                </div>
                                <!--end::Input group=-->
                                <!--begin::Submit button-->
                                <div class="d-grid mb-5 mt-2">
                                    <button type="submit" @click="saveComplete" class="btn btn-primary m-auto w-100 px-8 py-4 my-3 " style="background-color:#2B00FF;">
                                        <!--begin::Indicator label-->
                                        <span class="indicator-label fs-16">Register</span>
                                        <!--end::Indicator label-->
                                        <!--begin::Indicator progress-->

                                        <!--end::Indicator progress-->
                                    </button>
                                </div>
                                <!--end::Submit button-->
                            </form>
                            <!--end::Form-->
                            <div class="text-center text-gray-400 fw-bold fs-4">Already have an account?
                                <a href="/admin" class="btn link-primary fw-bolder ml-2">Login</a>
                            </div>
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/demo3/js/jquery/jquery-1.11.3.min.js"></script>

    <script src="/assets/demo3/js/plugins/canvasbg/canvasbg.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {

            "use strict";

            // Init Theme Core
            //Core.init();

            // Init CanvasBG
            CanvasBG.init({
                Loc: {
                    x: window.innerWidth / 5,
                    y: window.innerHeight / 10
                }
            });

        });
    </script>
    <!--end::Main-->
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="/assets/demo3/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/demo3/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="/assets/demo3/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="/assets/demo3/js/pages/custom/login/login-general.js"></script>
    <!--end::Page Scripts-->


    <svg id="SvgjsSvg1001" width="2" height="0" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" style="overflow: hidden; top: -100%; left: -100%; position: absolute; opacity: 0;">
        <defs id="SvgjsDefs1002"></defs>
        <polyline id="SvgjsPolyline1003" points="0,0"></polyline>
        <path id="SvgjsPath1004" d="M0 0 "></path>
    </svg>
</body>
<!--end::Body-->

</html>