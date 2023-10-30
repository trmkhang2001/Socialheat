<!DOCTYPE html>
<html>

<head>
	<!-- -------------- Meta and Title -------------- -->
	<meta charset="utf-8">
	<title>Admin Dashboard </title>
	<meta name="keywords" content=""/>
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--    main-->

	<script src="/assets/backend/js/jquery/jquery-1.11.3.min.js"></script>
	<script src="/assets/backend/js/jquery/jquery_ui/jquery-ui.min.js"></script>
	<script src="/assets/plugins/moment/moment.min.js"></script>
	<script src="/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/assets/plugins/vuejs/vue.min.js"></script>
	<script src="/assets/plugins/toastr/toastr.min.js"></script>
	<link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
	<script src="/assets/backend/plugins/tinymce/tinymce.min.js"></script>

	<!-- -------------- Fonts -------------- -->
	<link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
		  type='text/css'>
	<!-- -------------- CSS - theme -------------- -->
	<link rel="stylesheet" href="/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="/assets/backend/skin/default_skin/css/theme.css">
	<link rel="stylesheet" type="text/css" href="/assets/backend/allcp/forms/css/forms.css">

	<link rel="stylesheet" type="text/css" href="/assets/backend/plugins/flipclock/flipclock.css">
	<script src="/assets/backend/plugins/flipclock/flipclock.js"></script>

	<link rel="stylesheet" href="/assets/backend/css/style.css?v=<?= time() ?>"/>

	<!-- -------------- Favicon -------------- -->
	<link rel="shortcut icon" href="/assets/images/favicon.png">
	<!-- -------------- IE8 HTML5 support  -------------- -->
	<style>
		.table > thead > tr > td.active, .table > tbody > tr > td.active, .table > tfoot > tr > td.active, .table > thead > tr > th.active, .table > tbody > tr > th.active, .table > tfoot > tr > th.active, .table > thead > tr.active > td, .table > tbody > tr.active > td, .table > tfoot > tr.active > td, .table > thead > tr.active > th, .table > tbody > tr.active > th, .table > tfoot > tr.active > th {
			color: #0c0c0c;
			border-color: #f5f5f5;
			background-color: #f5f5f5;
		}

		.loading-bg {
			background: rgba(0, 0, 0, 0.3);
			height: 100%;
			width: 100%;
			position: absolute;
			z-index: 9999;
			top: 0;
		}

		.has-error em {
			font-size: 11px;
		}

		.allcp-form .select > select {
			height: 36px;
			padding: 6px 15px;
		}

		.has-error .form-control {
			border-color: #f76a6d !important;
		}

		body.sb-l-o #sidebar_left .sidebar-menu > li.active > a, body.sb-l-o #sidebar_left .sidebar-menu > li.active > a > span {
			color: #67d3e0 !important;
		}
	</style>
	<script>
      toastr.options = {
        'preventDuplicates': true,
        'preventOpenDuplicates': true,
      };
      var setValueDefult = {
        init: function(datas) {
          $.each(datas, function(idx, el) {
            $('select[name=' + idx + ']').val(el).trigger('change');
            $('input[name=' + idx + '][type=input]').val(el).trigger('change');
          });
        },
      };

      function format_num(num) {
        var n = parseInt(n);
        if (n == 0) {
          return num;
        }
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
      };
      $('.num_format').each(function() {
        var num = $(this).text().trim();
        $(this).text(format_num(num));
      });

      $('.currency_format').each(function() {
        var num = $(this).text().trim();
        $(this).text(format_num(num) + ' đ');
      });


	</script>
</head>

<!--<body class="dashboard-page sb-l-o sb-r-c onload-check sb-l-m sb-l-disable-animation">-->
<body class="dashboard-page sb-l-o sb-r-c onload-check">
<!-- -------------- Body Wrap  -------------- -->
<div id="main">
	<div class="loading-bg hidden">
		<44div class="loader_export " id="loader" >
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="lading"></div>
	</
	44div>
</div>

<?php

/**
 * @var $userInfo
 * @var $data
 * @var $breadcrumbs
 */
$this->load->view("/backend/layout/admin_header_view", array('userInfo' => $userInfo));
$this->load->view("/backend/layout/admin_sidebar_view");
?>

<!-- -------------- Main Wrapper -------------- -->
<section id="content_wrapper">
	<?php
	$this->load->view("/backend/layout/admin_breadcrumb_view", array('breadcrumbs' => $breadcrumbs));
	?>


	<!-- -------------- Content -------------- -->
	<section id="content" class="animated fadeIn">

		<?php $this->load->view($template, $data); ?>

	</section>
	<!-- -------------- /Content -------------- -->
</section>
4
</div>
<!-- -------------- /Body Wrap  -------------- -->

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->

<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- -------------- Theme Scripts -------------- -->
<script src="/assets/backend/js/utility/utility.js"></script>
<script src="/assets/backend/js/demo/demo.js"></script>
<script src="/assets/backend/js/main.js"></script>
<script src="/assets/backend/js/crud_manage.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function() {

    'use strict';

    // Init Theme Core
    Core.init();

    // Init Theme Core
    Demo.init();

    var url = window.location.pathname;

    $('#sidebar_left li').each(function(index, el) {
      var href = $(this).find('a').attr('data-action');
      var arr=url.split('/')
      var parameter=arr[2];

      if (parameter === href) {
        $(this).addClass('active');
        $(this).parents('li').find('.accordion-toggle').addClass('menu-open');

      }

    });
  });
</script>
<!-- -------------- /Scripts -------------- -->
<?php
$this->load->view('backend/layout/script');
?>
</body>

</html>
