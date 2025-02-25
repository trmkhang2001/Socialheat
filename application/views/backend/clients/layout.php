<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.1.8
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
	<base href="" />
	<title>Admin Dashboard</title>
	<meta charset="utf-8" />
	<meta name="description" content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
	<meta name="keywords" content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Metronic - Bootstrap Admin Template, HTML, VueJS, React, Angular. Laravel, Asp.Net Core, Ruby on Rails, Spring Boot, Blazor, Django, Express.js, Node.js, Flask Admin Dashboard Theme & Template" />
	<meta property="og:url" content="https://keenthemes.com/metronic" />
	<meta property="og:site_name" content="Keenthemes | Metronic" />
	<!-- Main -->
	<script src="/assets/backend/js/jquery/jquery-1.11.3.min.js"></script>
	<script src="/assets/backend/js/jquery/jquery_ui/jquery-ui.min.js"></script>
	<script src="/assets/plugins/moment/moment.min.js"></script>
	<script src="/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/assets/plugins/vuejs/vue.min.js"></script>
	<script src="/assets/plugins/toastr/toastr.min.js"></script>
	<link rel="stylesheet" href="/assets/plugins/toastr/toastr.min.css">
	<script src="/assets/backend/plugins/tinymce/tinymce.min.js"></script>
	<!-- Demo3 -->
	<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
	<link rel="shortcut icon" href="/assets/demo3/media/logos/favicon.ico" />
	<!--begin::Fonts(mandatory for all pages)-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300" />
	<!--end::Fonts-->
	<!-- CSS-theme -->
	<!--begin::Vendor Stylesheets(used for this page only)-->
	<link rel="stylesheet" href="/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
	<link href="/assets/demo3/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<link href="/assets/demo3/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Vendor Stylesheets-->
	<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
	<link href="/assets/demo3/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="/assets/demo3/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<style>
	.header {
		left: 400px !important;
	}

	#btn-back-to-top {
		position: fixed;
		bottom: 20px;
		right: 20px;
		display: none;
	}
</style>
<!--begin::Body-->

<body id="kt_body" class="header-fixed sidebar-enabled">
	<!--begin::Main-->
	<!--begin::Root-->
	<div class="wrapper d-flex flex-column flex-row-fluid" style="padding-right: 0px;">
		<!--begin::Aside-->
		<?php $this->load->view("backend/layout/admin_sidebar_view") ?>
		<!--end::Aside-->
		<!--begin::Wrapper-->
		<section id="content" class="m-grid__item m-grid__item--fluid m-wrapper">
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
			<?php $this->load->view($template, $data); ?>
		</section>
		<!--end::Wrapper-->
	</div>
	<button type="button" class="btn btn-danger btn-floating btn-lg" id="btn-back-to-top">
		<i class="fas fa-arrow-up"></i>
	</button>
	<!--end::Root-->
	<!--end::Main-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "/assets/demo3/";
	</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="/assets/demo3/plugins/global/plugins.bundle.js"></script>
	<script src="/assets/demo3/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used for this page only)-->
	<script src="/assets/demo3/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
	<script src="/assets/demo3/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="/assets/demo3/js/widgets.bundle.js"></script>
	<script src="/assets/demo3/js/custom/widgets.js"></script>
	<script src="/assets/demo3/js/custom/apps/chat/chat.js"></script>
	<script src="/assets/demo3/js/custom/utilities/modals/users-search.js"></script>
	<script>
		//Get the button
		let mybutton = document.getElementById("btn-back-to-top");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction();
		};

		function scrollFunction() {
			if (
				document.body.scrollTop > 20 ||
				document.documentElement.scrollTop > 20
			) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}
		// When the user clicks on the button, scroll to the top of the document
		mybutton.addEventListener("click", backToTop);

		function backToTop() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}
	</script>
	<script>
		$.fn.dataTable.ext.errMode = 'none';
		$('[data-toggle="tooltip"]').tooltip();

		$('.read_more').click(function(e) {
			e.preventDefault();
			var content = $(this).parent().find('.item-content-read-less');
			if (content.hasClass('read-less')) {
				content.removeClass('read-less')
				content.addClass('read-more');
				$(this).text('Read less');
			} else {
				content.removeClass('read-more')
				content.addClass('read-less');
				$(this).text('Read more');
			}
		});
	</script>
	<!-- /Script -->
<!--	--><?php //$this->load->view('/backend/layout/script_chart'); ?>
	<?php $this->load->view('/backend/layout/script'); ?>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>