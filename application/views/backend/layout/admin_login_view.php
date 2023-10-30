<!DOCTYPE html>
<html>

<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>Admin Dashboard</title>
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/assets/backend/skin/default_skin/css/theme.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="/assets/backend/allcp/forms/css/forms.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="/assets/images/favicon.png">

    <!-- -------------- IE8 HTML5 support  -------------- -->
    <style>
        #main {
            background: url(/assets/images/login-register.jpg) no-repeat top center #2d494d !important;
        }
    </style>
</head>

<body class="utility-page sb-l-c sb-r-c">

    <!-- -------------- Body Wrap  -------------- -->
    <div id="main" class="animated fadeIn">

        <!-- -------------- Main Wrapper -------------- -->
        <section id="content_wrapper">

            <div id="canvas-wrapper">
                <canvas id="demo-canvas"></canvas>
            </div>

            <!-- -------------- Content -------------- -->
            <section id="content">

                <!-- -------------- Login Form -------------- -->
                <div class="allcp-form theme-primary mw320" style="margin-top: 0" id="login">
                    <div class="text-center mb20">
                        <img src="/assets/images/logo.png" width="100%" class="img-responsive" alt="Logo" />
                    </div>
                    <div class="panel mw320">
                        <?php if ($msg != "") { ?>
                            <div class="alert alert-danger dark alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <i class="fa fa-warning pr10"></i>
                                <strong><?php echo $msg ?></strong>
                            </div>
                        <?php } ?>
                        <form method="post" action="">
                            <h3 style="text-align:center">Đăng nhập</h3>
                            <div class="panel-body pn mv10">
                                <div class="section">
                                    <label for="username" class="field prepend-icon">
                                        <input type="email" name="email" class="gui-input" placeholder="User name" required>
                                        <label for="username" class="field-icon">
                                            <i class="fa fa-user"></i>
                                        </label>
                                    </label>
                                </div>
                                <!-- -------------- /section -------------- -->

                                <div class="section">
                                    <label for="password" class="field prepend-icon">
                                        <input type="password" name="password" class="gui-input" placeholder="Password" required>
                                        <label for="password" class="field-icon">
                                            <i class="fa fa-lock"></i>
                                        </label>
                                    </label>
                                </div>
                                <!-- -------------- /section -------------- -->

                                <div class="section">
                                    <!-- <div class="bs-component pull-left pt5">
                                    <div class="radio-custom radio-primary mb5 lh25">
                                        <input type="radio" id="remember" name="remember">
                                        <label for="remember">Remember me</label>
                                    </div>
                                </div> -->

                                    <button type="submit" class="btn btn-bordered btn-primary pull-right">Login</button>
                                </div>
                                <!-- -------------- /section -------------- -->

                            </div>
                            <!-- -------------- /Form -------------- -->
                        </form>
                    </div>
                    <!-- -------------- /Panel -------------- -->
                </div>
                <!-- -------------- /Spec Form -------------- -->

            </section>
            <!-- -------------- /Content -------------- -->

        </section>
        <!-- -------------- /Main Wrapper -------------- -->

    </div>
    <!-- -------------- /Body Wrap  -------------- -->

    <!-- -------------- Scripts -------------- -->

    <!-- -------------- jQuery -------------- -->
    <script src="/assets/backend/js/jquery/jquery-1.11.3.min.js"></script>
    <script src="/assets/backend/js/jquery/jquery_ui/jquery-ui.min.js"></script>

    <!-- -------------- CanvasBG JS -------------- -->
    <script src="/assets/backend/js/plugins/canvasbg/canvasbg.js"></script>

    <!-- -------------- Theme Scripts -------------- -->
    <script src="/assets/backend/js/utility/utility.js"></script>
    <!-- <script src="/assets/backend/js/demo/demo.js"></script> -->
    <script src="/assets/backend/js/main.js"></script>

    <!-- -------------- Page JS -------------- -->
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

    <!-- -------------- /Scripts -------------- -->

</body>

</html>