<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<style type="text/css">
	.btn-accent.btn-export {
		background: #ccc;
		border-color: #ccc;
		cursor: not-allowed !important;
	}

	.btn-accent.can-export {
		background-color: #00c5dc;
		border-color: #00c5dc;
		cursor: pointer !important;
	}

	.items-total-data .align-items-center {
		background: #FFFFFF;
		border: 1px solid #ECECEC;
		border-radius: 5px;
		height: 200px;
		margin-bottom: 18px;
	}

	.items-total-data .m-widget1 .m-widget1__item {
		padding: 0 0 0 20px;
	}

	.items-total-data .m-widget1 {
		padding: 0 15px;
	}

	.items-total-data .m-widget1__title {
		font-family: Roboto;
		font-style: normal;
		font-weight: 500 !important;
		font-size: 16px !important;
		line-height: 19px;
		color: #4F5B88;
	}

	.items-total-data .m-widget1__desc {
		font-family: Roboto;
		font-style: normal;
		font-weight: normal !important;
		font-size: 12px !important;
		line-height: 14px;
		color: #A5ACC8;
	}

	.items-total-data .m-widget1__number {
		font-family: Roboto;
		font-style: normal;
		font-weight: normal;
		font-size: 38px !important;
		color: #5478FF !important;
	}

	.items-total-data .group-text {
		text-align: justify;
		margin: auto;
		padding-left: 20px !important;
	}

	.m--bg-info {
		background-color: #6D67FF !important;
	}

	.m--img-rounded {
		border-radius: 50% !important;
	}
</style>
<?php
/**
 * @var  $can_download
 * @var $content
 * @var $page_title
 * @var $userInfo
 */
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
	<div class="m-subheader ">
		<div class="d-flex align-items-center">
			<div class="mr-auto">
				<h3 class="m-subheader__title m-subheader__title--separator"><?php echo $page_title; ?></h3>
			</div>

			<div>
				<!--				--><?php //if ((int)$content['status'] !== 9): ?>
				<!--					<a data-post-id="--><? //= $content['post_id'] ?><!--" title="Refresh post"-->
				<!--					   class="refresh-post btn btn-success " href="javascript::void()">-->
				<!--						Update Data-->
				<!--					</a>-->
				<!--				--><?php //endif ?>
				<!--				<a data-post-id="-->
				<? //= $content['post_id'] ?><!--" class="report-post btn btn-success"-->
				<!--				   href="javascript::void()"-->
				<!--				   title="Report post">-->
				<!--					Report-->
				<!--				</a>-->
				<?php if(in_array($userInfo['role_id'], [ROLE_ADMIN, ROLE_DOWNLOAD], FALSE)):?>
				<a href="#uids-list"
				   class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air btn-export group-export-csv can-export ">
                                <span>
                                   <i class="la la-file-excel-o"></i>
                                    <span>Download Data</span>
                                </span>
				</a>
				<?php endif;?>
			</div>

		</div>
		<div class="export-status form-group m-form__group" style="display: none;">
			<h6>Downloading</h6>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
					 style="width:0%">
					0% Complete
				</div>
			</div>
		</div>
	</div>

	<!-- ============================================================== -->
	<!-- End Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->

	<div class="m-content items-total-content">
		<div class="m-portlet" style="background: transparent;box-shadow: none">
			<div class="m-portlet__body  m-portlet__body--no-padding">
				<div class="row m-row--no-padding m-row--col-separator-xl">
					<?php $this->load->view('/backend/clients/_item_fb_post', ['item' => $content, 'key' => $content['post_id']]) ?>
					<!--					<div class="col-md-6">-->
					<!--						<div class="clearfix">-->
					<!--							<div class="col-md-6" style="background: #fff"></div>-->
					<!--							<div class="col-md-6"></div>-->
					<!--						</div>-->
					<!--					</div>-->
					<div class="col-xl-8 col-md-8 items-total-data">
						<!--begin:: Widgets/Stats2-1 -->
						<div class="m-widget1  row">
							<div class="m-widget1__item col-md-6">
								<div class="row m-row--no-padding align-items-center">
									<div class="col-md-6 group-text">
										<div class="clearfix">
											<h3 class="m-widget1__title">Total data </h3>
											<span class="m-widget1__desc">Number of users</span>
										</div>
										<div class="clearfix">
											<span class="m-widget1__number m--font-brand"><?php echo number_format($content['count_d']); ?></span>

										</div>
									</div>
									<div class="col-md-6 text-center">
										<svg width="80" height="80" viewBox="0 0 80 80" fill="none"
											 xmlns="http://www.w3.org/2000/svg">
											<circle cx="40" cy="40" r="40" fill="#3F8CFF" fill-opacity="0.1"/>
											<path d="M52.7273 22H27.2727C26.5687 22 26 22.5746 26 23.2857V32.2857H54V23.2857C54 22.5746 53.4312 22 52.7273 22ZM31.0909 28.75C30.2119 28.75 29.5 28.0308 29.5 27.1429C29.5 26.2549 30.2119 25.5357 31.0909 25.5357C31.9699 25.5357 32.6818 26.2549 32.6818 27.1429C32.6818 28.0308 31.9699 28.75 31.0909 28.75ZM26 56.7143C26 57.4254 26.5687 58 27.2727 58H52.7273C53.4312 58 54 57.4254 54 56.7143V47.7143H26V56.7143ZM31.0909 51.25C31.9699 51.25 32.6818 51.9692 32.6818 52.8571C32.6818 53.7451 31.9699 54.4643 31.0909 54.4643C30.2119 54.4643 29.5 53.7451 29.5 52.8571C29.5 51.9692 30.2119 51.25 31.0909 51.25ZM26 45.1429H54V34.8571H26V45.1429ZM31.0909 38.3929C31.9699 38.3929 32.6818 39.1121 32.6818 40C32.6818 40.8879 31.9699 41.6071 31.0909 41.6071C30.2119 41.6071 29.5 40.8879 29.5 40C29.5 39.1121 30.2119 38.3929 31.0909 38.3929Z"
												  fill="#3F8CFF"/>
										</svg>

									</div>
								</div>
							</div>
							<div class="m-widget1__item col-md-6">
								<div class="row m-row--no-padding align-items-center">
									<div class="col-md-6 group-text">
										<div class="clearfix">
											<h3 class="m-widget1__title">Total Like & Share</h3>
											<span class="m-widget1__desc">Number of users like & share post</span>
										</div>
										<div class="clearfix">
											<span class="m-widget1__number m--font-brand"><?php echo number_format($content['count_like_share']); ?></span>

										</div>
									</div>
									<div class="col-md-6 text-center">
										<svg width="80" height="80" viewBox="0 0 80 80" fill="none"
											 xmlns="http://www.w3.org/2000/svg">
											<circle cx="40" cy="40" r="40" fill="#5ADD67" fill-opacity="0.1"/>
											<path d="M26.4 55H28.1V32.4211H26.4C25.4983 32.4211 24.6335 32.787 23.9958 33.4385C23.3582 34.0899 23 34.9735 23 35.8947V51.5263C23 52.4476 23.3582 53.3311 23.9958 53.9826C24.6335 54.634 25.4983 55 26.4 55ZM53.6 32.4211H41.7L43.6074 26.5714C43.7776 26.0493 43.824 25.4934 43.7427 24.9494C43.6614 24.4055 43.4548 23.889 43.1399 23.4426C42.8249 22.9962 42.4107 22.6326 41.9313 22.3818C41.4519 22.131 40.9211 22.0001 40.3825 22H40L31.5 31.4449V55H50.2L56.8504 40.0701L57 39.3684V35.8947C57 34.9735 56.6418 34.0899 56.0042 33.4385C55.3665 32.787 54.5017 32.4211 53.6 32.4211Z"
												  fill="#5ADD67"/>
										</svg>
									</div>
								</div>
							</div>
							<div class="m-widget1__item col-md-6">
								<div class="row m-row--no-padding align-items-center">
									<div class="col-md-6 group-text">
										<div class="clearfix">
											<h3 class="m-widget1__title">Total Comments</h3>
											<span class="m-widget1__desc">Number of users comment on post</span>
										</div>
										<div class="clearfix">
											<span class="m-widget1__number m--font-brand"><?php echo number_format($total_comment); ?></span>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<svg width="80" height="80" viewBox="0 0 80 80" fill="none"
											 xmlns="http://www.w3.org/2000/svg">
											<circle cx="40" cy="40" r="40" fill="#FF9B52" fill-opacity="0.1"/>
											<path d="M53.6 26H26.4C24.5249 26 23 27.5249 23 29.4V60L29.8 53.2H53.6C55.4751 53.2 57 51.6751 57 49.8V29.4C57 27.5249 55.4751 26 53.6 26ZM43.4 44.7H31.5V41.3H43.4V44.7ZM48.5 37.9H31.5V34.5H48.5V37.9Z"
												  fill="#FF9B52"/>
										</svg>
									</div>
								</div>
							</div>

							<div class="m-widget1__item col-md-6">
								<div class="row m-row--no-padding align-items-center">
									<div class="col-md-6 group-text">
										<div class="clearfix">
											<h3 class="m-widget1__title">Email</h3>
											<span class="m-widget1__desc">Data have email</span>
										</div>
										<div class="clearfix">
											<span class="m-widget1__number m--font-danger"><?php echo number_format($group_data['email_count']) ?></span>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<svg width="80" height="80" viewBox="0 0 80 80" fill="none"
											 xmlns="http://www.w3.org/2000/svg">
											<circle cx="40" cy="40" r="40" fill="#4F4BFF" fill-opacity="0.1"/>
											<path d="M53.6 26H26.4C24.53 26 23.017 27.575 23.017 29.5L23 50.5C23 52.425 24.53 54 26.4 54H53.6C55.47 54 57 52.425 57 50.5V29.5C57 27.575 55.47 26 53.6 26ZM53.6 33L40 41.75L26.4 33V29.5L40 38.25L53.6 29.5V33Z"
												  fill="#4F4BFF"/>
										</svg>
									</div>
								</div>
							</div>

							<div class="m-widget1__item col-md-6">
								<div class="row m-row--no-padding align-items-center">
									<div class="col-md-6 group-text">
										<div class="clearfix">
											<h3 class="m-widget1__title">Birthday</h3>
											<span class="m-widget1__desc">Data have birthday</span>
										</div>
										<div class="clearfix">
											<span class="m-widget1__number m--font-danger"><?php echo number_format($group_data['birthday_count']) ?></span>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<svg width="80" height="80" viewBox="0 0 80 80" fill="none"
											 xmlns="http://www.w3.org/2000/svg">
											<circle cx="40" cy="40" r="40" fill="#FF8989" fill-opacity="0.1"/>
											<path d="M57 49.5C54.8735 49.5 54.6276 47.125 51.346 47.125C48.05 47.125 47.7923 49.5 45.673 49.5C43.5711 49.5 43.2859 47.125 40 47.125C36.7486 47.125 36.4165 49.5 34.346 49.5C32.2098 49.5 31.978 47.125 28.673 47.125C25.3681 47.125 25.1324 49.5 23 49.5V43.5625C23 41.5957 24.6317 40 26.6429 40H27.8571V29.3125H32.7143V40H37.5714V29.3125H42.4286V40H47.2857V29.3125H52.1429V40H53.3571C55.3683 40 57 41.5957 57 43.5625V49.5ZM57 59H23V51.875C26.2904 51.875 26.5493 49.5 28.673 49.5C30.7943 49.5 31.0449 51.875 34.346 51.875C37.5975 51.875 37.9294 49.5 40 49.5C42.1362 49.5 42.3679 51.875 45.673 51.875C48.9635 51.875 49.2223 49.5 51.346 49.5C53.4321 49.5 53.7178 51.875 57 51.875V59ZM30.2857 28.125C28.9386 28.125 27.8571 27.0674 27.8571 25.75C27.8571 23.4492 30.2857 24.043 30.2857 21C31.1964 21 32.7143 23.1895 32.7143 25.1562C32.7143 27.123 31.6328 28.125 30.2857 28.125ZM40 28.125C38.6529 28.125 37.5714 27.0674 37.5714 25.75C37.5714 23.4492 40 24.043 40 21C40.9107 21 42.4286 23.1895 42.4286 25.1562C42.4286 27.123 41.3471 28.125 40 28.125ZM49.7143 28.125C48.3672 28.125 47.2857 27.0674 47.2857 25.75C47.2857 23.4492 49.7143 24.043 49.7143 21C50.625 21 52.1429 23.1895 52.1429 25.1562C52.1429 27.123 51.0614 28.125 49.7143 28.125Z"
												  fill="#FF8989"/>
										</svg>
									</div>
								</div>
							</div>

							<div class="m-widget1__item col-md-6">
								<div class="row m-row--no-padding align-items-center">
									<div class="col-md-6 group-text">
										<div class="clearfix">
											<h3 class="m-widget1__title">Relationship</h3>
											<span class="m-widget1__desc">Data have relationship</span>
										</div>
										<div class="clearfix">
											<span class="m-widget1__number m--font-danger"><?php echo number_format($group_data['relationship_count']) ?></span>
										</div>
									</div>
									<div class="col-md-6 text-center">
										<svg width="80" height="80" viewBox="0 0 80 80" fill="none"
											 xmlns="http://www.w3.org/2000/svg">
											<circle cx="40" cy="40" r="40" fill="#FF6FB4" fill-opacity="0.1"/>
											<path d="M57.129 30.9676C56.5705 29.6041 55.7651 28.3686 54.7579 27.3301C53.75 26.2885 52.5617 25.4607 51.2575 24.8918C49.9052 24.2996 48.4547 23.9965 46.9904 24C44.936 24 42.9316 24.5931 41.1897 25.7134C40.773 25.9814 40.3771 26.2757 40.0021 26.5964C39.627 26.2757 39.2311 25.9814 38.8144 25.7134C37.0726 24.5931 35.0682 24 33.0138 24C31.5344 24 30.1009 24.2988 28.7466 24.8918C27.4381 25.463 26.2588 26.2845 25.2462 27.3301C24.2377 28.3674 23.4322 29.6033 22.8751 30.9676C22.2959 32.3866 22 33.8935 22 35.4443C22 36.9072 22.2834 38.4316 22.8459 39.9824C23.3168 41.2784 23.9919 42.6227 24.8545 43.9802C26.2213 46.1285 28.1007 48.369 30.4343 50.6403C34.3014 54.4053 38.131 57.006 38.2935 57.1115L39.2811 57.7792C39.7187 58.0736 40.2813 58.0736 40.7188 57.7792L41.7064 57.1115C41.8689 57.0016 45.6944 54.4053 49.5657 50.6403C51.8993 48.369 53.7786 46.1285 55.1455 43.9802C56.0081 42.6227 56.6873 41.2784 57.154 39.9824C57.7166 38.4316 58 36.9072 58 35.4443C58.0041 33.8935 57.7083 32.3866 57.129 30.9676Z"
												  fill="#FF6FB4"/>
										</svg>
									</div>
								</div>
							</div>
						</div>

						<!--end:: Widgets/Stats2-1 -->
					</div>
				</div>
			</div>
		</div>
		<!--			<div class="row">-->
		<!--				<div class="col-lg-12">-->
		<!--					<div class="m-portlet m-portlet--mobile">-->
		<!--						<div class="m-portlet__head">-->
		<!--							<div class="m-portlet__head-caption">-->
		<!--								<div class="m-portlet__head-title">-->
		<!--                                <span class="m-portlet__head-icon m--hide">-->
		<!--                                    <i class="la la-gear"></i>-->
		<!--                                </span>-->
		<!--									<h3 class="m-portlet__head-text">-->
		<!--										City (%)-->
		<!--									</h3>-->
		<!--								</div>-->
		<!--							</div>-->
		<!--						</div>-->
		<!--						<div class="m-portlet__body city-loading">-->
		<!--							<div class="m-loader m-loader--primary"-->
		<!--								 style="text-align: center;display: none;width: 100%;height: 100%;top: 0px;left: 0px;position: absolute;z-index: 9;background: #fff;">-->
		<!--								<svg class="circular" viewBox="25 25 50 50">-->
		<!--									<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"-->
		<!--											stroke-miterlimit="10"/>-->
		<!--								</svg>-->
		<!--							</div>-->
		<!--							<div id="m_flotcharts" style="height: 300px;">-->
		<!---->
		<!--							</div>-->
		<!--						</div>-->
		<!--					</div>-->
		<!---->
		<!---->
		<!--				</div>-->
		<!--			</div>-->

		<!--End::Section-->

		<!--End::Section-->
		<div class="m-portlet m-portlet--tabs">
			<div class="m-portlet__head">
				<div class="m-portlet__head-tools">
					<ul class="nav nav-tabs m-tabs-line m-tabs-line--2x m-tabs-line--right" role="tablist"
						id="tabs-wrapper">
						<li class="nav-item m-tabs__item m-tabs-line--success">
							<a class="nav-link m-tabs__link active show" data-toggle="tab"
							   href="#m_portlet_base_demo_2_3_tab_content" role="tab" aria-selected="true"
							   data-type="all">
								Total data:&nbsp;<span
										class=""><?php echo number_format($content['count_d']); ?></span>
							</a>
						</li>
						<!-- <li class="nav-item m-tabs__item">
							<a class="nav-link m-tabs__link" data-toggle="tab" href="#m_portlet_base_thirdparty_tab_content" role="tab" aria-selected="false">
								<i class="fa fa-bar-chart" aria-hidden="true"></i>ThirdParty
							</a>
						</li> -->
						<li class="nav-item m-tabs__item m-tabs-line--danger">
							<a class="nav-link m-tabs__link" data-toggle="tab"
							   href="#m_portlet_base_like_tab_content" role="tab" data-type="is_like">
								Like & Share :&nbsp;<span
										id="like-count"><?php echo number_format($content['count_like_share']) ?></span>
							</a>
						</li>
						<li class="nav-item m-tabs__item m-tabs-line--brand">
							<a class="nav-link m-tabs__link" data-toggle="tab"
							   href="#m_portlet_base_comment_tab_content" role="tab" data-type="is_comment">
								<i class="flaticon-comment"></i> Comment:&nbsp;<span
										id="comment-count"><?php echo $total_comment; ?></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="m-portlet__body">
				<script type="text/json" id="uid-data">
            <?php echo json_encode($items); ?>





				</script>
				<div class="m-portlet m-portlet--mobile">
					<div class="m-portlet__head">
						<div class="m-portlet__head-caption">
							<div class="m-portlet__head-title m--bg-info" style="padding: 5px 10px;">
								<h3 class="m-portlet__head-text m--font-light">
									Total data:&nbsp;<span class="converted-insights"
														   style="font-weight: 700;"><?php echo number_format($items['totals']); ?></span>
								</h3>
							</div>
						</div>

						<div class="m-portlet__head-tools">
							<ul class="m-portlet__nav">
								<!--                        <li class="m-portlet__nav-item">-->
								<!--                            <a target="_blank" href="-->
								<?php //echo base_url("/assets/sociallead_sample.xls") ?><!--" class="btn btn-success">-->
								<!--                                <i class="la la-file-excel-o"></i>-->
								<!--                                Data sample-->
								<!--                            </a>-->
								<!--                        </li>-->
								<?php if(in_array($userInfo['role_id'], [ROLE_ADMIN, ROLE_DOWNLOAD], FALSE)):?>

								<li class="m-portlet__nav-item">
									<a href="#uids-list"
									   class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air btn-export group-export-csv can-export">
										<span>
											<i class="la la-download"></i>
											<span>Download Data</span>
										</span>
									</a>
								</li>
								<?php endif;?>


							</ul>
						</div>

					</div>
					<?php
					render_field_panel();
					?>
					<div class="m-portlet__body">

						<div class="row">
							<div class="col-lg-12">
								<div class="export-status form-group m-form__group" style="display: none;">
									<h6>Downloading</h6>
									<div class="progress">
										<div class="progress-bar" role="progressbar" aria-valuenow="0"
											 aria-valuemin="0" aria-valuemax="100" style="width:0%">
											0% Complete
										</div>
									</div>
								</div>
								<form id="uids-form">
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive uids-list" id="uids-list">
												<div id="myTable_wrapper"
													 class="dataTables_wrapper dt-bootstrap4 no-footer">
													<div class="m-loader m-loader--primary"
														 style="text-align: center;display: none;width: 100%;height: 100%;top: 0px;left: 0px;position: absolute;z-index: 9;background: #fff;">
														<svg class="circular" viewBox="25 25 50 50">
															<circle class="path" cx="50" cy="50" r="20" fill="none"
																	stroke-width="2" stroke-miterlimit="10"/>
														</svg>
													</div>
													<div class="dataTables_length dataTables_filter"
														 id="myTable_length">
														<label>Show
															<select name="myTable_length" aria-controls="groupTable"
																	class="custom-select custom-select-sm form-control form-control-sm">
																<option value="10">10</option>
																<option value="25">25</option>
																<option value="50">50</option>
																<option value="100">100</option>
															</select> entries</label>

														<label>City : <select name="city"
																			  class="custom-select custom-select-sm form-control form-control-sm"
																			  id="city">
																<option value="">Select city</option>
																<?php foreach (get_cities() as $city) : ?>
																	<option value="<?php echo vn_to_str($city); ?> "><?php echo $city; ?></option>
																<?php endforeach; ?>
															</select>
														</label>

														&nbsp;
														<label>Friends : <select name="friends"
																				 class="custom-select custom-select-sm form-control form-control-sm"
																				 id="friends">
																<option value="">Number of friend</option>
																<option value="> 5000"> > 5,000</option>
																<option value="4000-5000"> 4,000 - 5,000</option>
																<option value="3000-4000"> 3,000 - 4,000</option>
																<option value="2000-3000"> 2,000 - 3,000</option>
																<option value="1000-2000"> 1,000 - 2,000</option>
																<option value="<1000"> 0 - 999</option>
															</select>
														</label>

														<label>Follows : <select name="follows"
																				 class="custom-select custom-select-sm form-control form-control-sm"
																				 id="follows">
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
															<select name="sex"
																	class="custom-select custom-select-sm form-control form-control-sm"
																	id="sex">
																<option value="">Sex</option>
																<option value="male">Male</option>
																<option value="female">Female</option>
															</select>
														</label>

														&nbsp;
														<label>
															<select name="relationship"
																	class="custom-select custom-select-sm form-control form-control-sm"
																	id="relationship">
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
															<select name="age"
																	class="custom-select custom-select-sm form-control form-control-sm"
																	id="age">
																<option value="">Age</option>
																<?php foreach ($get_age_ranges as $key => $age_range) : ?>
																	<option value="<?php echo $age_range[0] . '_' . $age_range[1]; ?>"><?php echo $age_range[2]; ?></option>
																<?php endforeach; ?>
															</select>
														</label>
														&nbsp;
														<label>Search:<input type="search" id="search"
																			 class="form-control form-control-sm"
																			 placeholder="Uid or Phone"
																			 aria-controls="myTable"></label>

													</div>
													<div class="table_scrool_wrapper">
														<table id="uidTable"
															   class="table table-striped- table-bordered table-hover table-checkable dataTable no-footer">
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
															<div class="dataTables_info" id="myTable_info"
																 role="status" aria-live="polite">Showing 1
																to <?php echo $items['limit'] ?>
																of <?php echo $items['totals']; ?> entries
															</div>
														</div>
														<div class="col-sm-12 col-md-7">
															<div class="dataTables_paginate paging_simple_numbers"
																 id="myTable_paginate">
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
<script type="text/json" id="extra-fields">
<?php echo json_encode(get_extra_fields()); ?>


</script>
<script src="<?= base_url('/assets/js/custom.js') ?>"></script>
<script src="<?= base_url('/assets/js/convert.js') ?>"></script>

