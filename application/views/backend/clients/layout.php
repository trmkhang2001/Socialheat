<!DOCTYPE html>
<html lang="en">
<?php
/**
 * @var string $page_title
 * @var string $template
 * @var array $userInfo
 * @var array $data
 */
$user = $userInfo;

?>
<!-- begin::Head -->

<head>
	<meta charset="utf-8" />
	<title>Posts | <?php echo $page_title; ?></title>
	<meta name="description" content="Basic datatables examples">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
	<script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script>
		window.home_url = '<?php echo base_url(); ?>';
	</script>
	<link href="/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
	<link href="/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />


	<!--begin::Page Vendors Styles -->
	<link href="/assets/vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!--		font-awesome-->
	<link href="/assets/fontawesome-5.15.4/css/all.min.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles -->
	<link rel="shortcut icon" href="/assets/demo/default/media/img/logo/favicon.ico" />
	<link href="/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="/assets/css/custom.css?v=11" rel="stylesheet" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<style type="text/css">
		#order-details .m-demo__preview li label {
			width: 150px;
		}

		#customer-info li label {
			width: 120px;
			font-size: 14px;
		}

		#customer-info li span {
			font-weight: bold;
			font-size: 14px;
		}

		html,
		body {
			font-family: 'Roboto', sans-serif font-size: 14px;
		}

		.m-brand .m-brand__logo .m-brand__logo-wrapper {
			color: #fff;
			font-size: 16px;
			font-weight: bold;
			width: max-content;
			text-transform: uppercase;
		}

		.card {
			box-shadow: 1px 3px 3px 0px #f1f3f5;
			border: 1px solid #f1f3f5;
		}

		.card:hover {
			box-shadow: 1px 3px 2px 3px #f1f3f5;
		}

		.card-header,
		.card-footer {
			border-color: #f1f3f5;
			cursor: pointer;
		}

		.grid {
			overflow: hidden;
		}

		.grid-item {

			margin-bottom: 25px;

		}

		.grid-item.coll {
			width: 30%;
		}

		.row.grid span {
			font-size: 12px;
		}

		.viewfull {
			color: #716aca;
			cursor: pointer;
		}

		td.email {
			overflow: auto !important;
			text-overflow: unset !important;
		}

		.input-small {
			width: 145px !important;
		}

		header .m-stack {
			background: #752FE7;
		}
	</style>

	<style type="text/css">
		<?php $relationship_color = get_relationship_colors();
		foreach ($relationship_color as $key => $color) :
		?>.m-badge--<?php echo $key; ?> {
			background: <?php echo $color; ?>;
			color: #fff;
		}

		<?php endforeach; ?><?php $colors = get_colors();
							foreach ($colors as $key => $color) : ?>.m-badge--<?php echo $key; ?> {
			background: <?php echo $color; ?>;
			color: #fff;
		}

		<?php endforeach; ?>.m-content .panel {
			-webkit-box-shadow: 1px 2px 0 #e5eaee;
			box-shadow: 1px 2px 0 #e5eaee;
			padding: 25px;
		}

		table {
			word-break: break-all;
		}
	</style>

</head>

<!-- end::Head -->

<!-- begin::Body -->

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page">

		<!-- BEGIN: Header -->
		<?php $this->load->view('backend/clients/header'); ?>
		<!-- END: Header -->
		<!-- begin::Body -->
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

			<!-- BEGIN: Left Aside -->
			<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
				<i class="la la-close"></i>
			</button>
			<?php $this->load->view('backend/clients/sidebar_view') ?>
			<!-- END: Left Aside -->
			<div class="m-grid__item m-grid__item--fluid m-wrapper">
				<!--Begin::Section-->
				<?php $this->load->view($template, $data); ?>
				<!--End::Section-->
			</div>
		</div>
		<!-- end:: Body -->
		<!-- begin::Footer -->
		<footer class="m-grid__item     m-footer ">
			<div class="m-container m-container--fluid m-container--full-height m-page__container">
				<div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
					<div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
						<span class="m-footer__copyright">
							2020 SOCIAL HEAT - BEST 1 SOCIAL ADVERTISING PLATFORM
						</span>
					</div>
				</div>
			</div>
		</footer>
		<!-- end::Footer -->
	</div>
	<div id="m_scroll_top" class="m-scroll-top">
		<i class="la la-arrow-up"></i>
	</div>
	<script src="/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
	<script src="/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
	<script src="/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js" type="text/javascript"></script>
	<!--begin::Page Scripts -->
	<script src="/assets/js/flot.bundle.js" type="text/javascript"></script>
	<!--begin::Page Vendors -->
	<script src="/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
	<!--end::Page Vendors -->
	<!--begin::Page Scripts -->
	<script src="/assets/demo/default/custom/crud/datatables/advanced/multiple-controls.js" type="text/javascript"></script>
	<!---->
	<!---->
	<!--<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->

	<script src="/assets/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js" type="text/javascript"></script>
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
</body>
<!-- end::Body -->

</html>