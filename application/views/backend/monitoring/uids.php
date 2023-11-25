<?php

/**
 * @var $total
 * @var $totalSocial
 * @var $item
 * @var $interactions
 * @var $content
 * @var $pagination
 */
?>
<style>
	.header {
		height: 0px;
	}

	.img {
		width: 72px;
		height: 72px;
	}

	.tgray {
		color: gray;
	}

	li {
		list-style: none;
	}

	.showhide {
		cursor: pointer;
	}

	#phone_user {
		display: none;
	}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div class="container-fluid" id="kt_content_container">
		<h1 class="mb-7" id="title">Monitoring</h1>
		<!--begin::Row-->
		<div class="row mb-5">
			<!--begin::Col-->
			<div class="col-8">
				<!--begin::Chart widget 38-->
				<?php $this->load->view('/backend/monitoring/_item_fb_post', ['item' => $content, 'key' => $content['post_id']]) ?>
				<!--end::Chart widget 38-->
			</div>
			<!--end::Col-->
			<!--begin::Col-->
			<div class="col-4">
				<div class="">
					<!--begin::Engage widget 1-->
					<div class="d-flex justify-content-center align-items-center row">
						<div class="col">
							<div class="card p-5 d-flex justify-content-center">
								<img class="img" src="/assets/images/icon-total-audience.png" alt="">
								<span class="tgray mt-3 fw-bold">Total Profile</span>
								<div class="fw-bold fs-2 mt-3"><?php echo number_format($content['count_d'] ?? 0); ?></div>
							</div>
							<div class="card p-5 mt-5">
								<img class="img" src="/assets/images/icon_total_mail.png" alt="">
								<span class="tgray mt-3 fw-bold">Total Email</span>
								<div class="fw-bold fs-2 mt-3"><?php echo number_format($content->totalMail ?? 0) ?></div>
							</div>
						</div>
						<div class="col">
							<div class="card p-5">
								<img class="img" src="/assets/images/icon_location.png" alt="">
								<span class="tgray mt-3 fw-bold">Location</span>
								<div class="fw-bold fs-2 mt-3"><?php echo number_format($content->totalLocation ?? 0) ?></div>
							</div>
							<div class="card p-5 mt-5">
								<img class="img" src="/assets/images/icon_relationship.png" alt="">
								<span class="tgray mt-3 fw-bold">Relationship</span>
								<div class="fw-bold fs-2 mt-3"><?php echo number_format($content->totalRelationship ?? 0) ?></div>
							</div>
						</div>
					</div>
				</div>
				<!--end::Engage widget 1-->
			</div>
			<!--end::Col-->
		</div>
		<!-- end::Row -->
		<!-- begin::Row -->
		<div class=" row mb-5">
			<div class="col-4">
				<div class="card">
					<!--begin::Header-->
					<div class="card-header">
						<!--begin::Title-->
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bold text-gray-800">Gender</span>
							<span class="text-gray-500 mt-1 fw-semibold fs-6">3 types of gender</span>
						</h3>
						<!--end::Title-->
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body p-10">
						<canvas id="doughnutChartGender"></canvas>
					</div>
					<!--end::Body-->
				</div>
			</div>
			<div class="col-4">
				<div class="card"> <!--begin::Header-->
					<div class="card-header">
						<!--begin::Title-->
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bold text-gray-800">Age</span>
							<span class="text-gray-500 mt-1 fw-semibold fs-6">6 age ranges</span>
						</h3>
						<!--end::Title-->
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body p-10">
						<canvas id="doughnutChartAge"></canvas>
					</div>
					<!--end::Body-->
				</div>
			</div>
			<div class="col-4">
				<div class="card"> <!--begin::Header-->
					<div class="card-header">
						<!--begin::Title-->
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bold text-gray-800">Relationship</span>
							<span class="text-gray-500 mt-1 fw-semibold fs-6">The most common 6 types of relationship</span>
						</h3>
						<!--end::Title-->
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body p-10">
						<canvas id="doughnutChartRelationship"></canvas>
					</div>
					<!--end::Body-->
				</div>
			</div>
		</div>
		<div class="row mb-5">
			<div class="col-4">
				<div class="card">
					<!--begin::Header-->
					<div class="card-header">
						<!--begin::Title-->
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bold text-gray-800">Friends</span>
							<span class="text-gray-500 mt-1 fw-semibold fs-6">Friends of friends</span>
						</h3>
						<!--end::Title-->
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body p-10">
						<canvas id="doughnutChartFriends"></canvas>
					</div>
					<!--end::Body-->
				</div>
			</div>
			<div class="col-4">
				<div class="card"> <!--begin::Header-->
					<div class="card-header">
						<!--begin::Title-->
						<h3 class="card-title align-items-start flex-column">
							<span class="card-label fw-bold text-gray-800">Follows</span>
							<span class="text-gray-500 mt-1 fw-semibold fs-6">User’s followers</span>
						</h3>
						<!--end::Title-->
					</div>
					<!--end::Header-->
					<!--begin::Body-->
					<div class="card-body p-10">
						<canvas id="doughnutChartFollows"></canvas>
					</div>
					<!--end::Body-->
				</div>
			</div>
		</div>
		<!-- end::Row -->
		<div class="export-status form-group m-form__group" style="display: none;">
			<h6>Downloading</h6>
			<div class="progress">
				<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
					0% Complete
				</div>
			</div>
		</div>
		<!-- begin::Row -->
		<div class="row">
			<!--begin::Col-->
			<div class="col-xxl">
				<div class="card p-5">
					<div class="m-portlet m-portlet--tabs">
						<div class="m-portlet__body">

							<div class="m-portlet m-portlet--mobile">
								<div class="m-portlet__head mb-10">
									<div class="m-portlet__head-tools d-flex justify-content-end">
										<?php if (in_array($userInfo['role_id'], [ROLE_ADMIN, ROLE_DOWNLOAD], FALSE)) : ?>

											<a href="/backend/monitoring/downloads/<?= $content['id'] ?>" class="btn btn-secondary m-btn m-btn--custom m-btn--icon m-btn--air btn-export group-export-csv can-export">
												<span>
													<i class="la la-download"></i>
													<span>Download Data</span>
												</span>
											</a>
										<?php endif; ?>
									</div>

								</div>

								<div class="m-portlet__body">

									<div class="row">
										<div class="col-lg-12">
											<div class="export-status form-group m-form__group" style="display: none;">
												<h6>Downloading</h6>
												<div class="progress">
													<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
														0% Complete
													</div>
												</div>
											</div>
											<form id="uids-form">
												<div class="row">
													<div class="col-sm-12">
														<div class="table-responsive uids-list" id="uids-list">
															<div id="myTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
																<div class="m-loader m-loader--primary" style="text-align: center;display: none;width: 100%;height: 100%;top: 0px;left: 0px;position: absolute;z-index: 9;background: #fff;">
																	<svg class="circular" viewBox="25 25 50 50">
																		<circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
																	</svg>
																</div>
																<div class="table_scrool_wrapper">
																	<table id="uidTable" class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
																		<thead>
																			<tr class="fw-bold text-muted">
																				<th class="uid sorting">Social Profile</th>
																				<th class="email">Email</th>
																				<th class="Phone">Phone</th>
																				<th class="Friends friends sorting_desc">
																					Friends
																				</th>
																				<th class="Follow follows sorting">Follow
																				</th>
																				<th class="Sex">Birthday</th>
																				<th class="Sex" style="min-width: 150px">
																					Sex
																				</th>
																				<th class="Relationship">Relationship</th>
																				<th class="City">City</th>
																				<th class="City">Craw Date</th>
																			</tr>
																		</thead>

																		<tbody>
																			<?php
																			/**
																			 * @var $interactions
																			 */
																			foreach ($interactions as $interaction) : ?>
																				<tr>
																					<td>
																						<div class="d-flex align-items-center symbol symbol-50px">
																							<a href="https://facebook.com/<?= $interaction['uid'] ?>" class="symbol symbol-50px me-4" target="_blank">
																								<img style="width: 40px; height:40px" class="border rounded-pill m--img-rounded m--marginless" src="https://graph.facebook.com/<?= $interaction['uid'] ?>/picture?type=large&width=500&height=500&access_token=2712477385668128|b429aeb53369951d411e1cae8e810640" alt="">
																							</a>
																							<a target="_blank" href="https://facebook.com/<?= $interaction['uid'] ?>" class="text-gray-800 text-hover-primary fs-5 fw-bold" data-kt-ecommerce-product-filter="product_name"><?= $interaction['name'] ?></a>

																						</div>
																					</td>
																					<td>
																						<?php if (!empty($interaction['email'])) { ?>
																							<span class="fw-bold badge badge-blue px-4 showData" data-decode="<?= $interaction['email'] ?>">
																								<span class="svg-icon svg-icon-5 svg-icon-success ms-n1 me-1" style="color: #5c98ff;">
																									<i class="fa-solid fa-eye fa-beat me-2" style="color: #5c98ff;"></i>Show
																								</span>
																							</span>
																						<?php } ?>
																					</td>
																					<td class="fw-bold">
																						<?php // substr($value['phone'], 0, -4) . '****'
																						?>
																						<span class="fw-bold badge badge-blue px-4 showData" data-decode="<?= $interaction['phone'] ?>">
																							<span class="svg-icon svg-icon-5 svg-icon-success ms-n1 me-1" style="color: #5c98ff;">
																								<i class="fa-solid fa-eye fa-beat me-2" style="color: #5c98ff;"></i>Show
																							</span>
																						</span>
																					</td>
																					<td><?= $interaction['friends'] ?></td>
																					<td><?= $interaction['follow'] ?></td>
																					<td><?= $interaction['birthday'] ? date('d/m/Y', strtotime($interaction['birthday'])) : '' ?></td>
																					<td>
																						<?php
																						if ($interaction['sex'] === 'male') : ?>
																							<!-- <span class="m-badge  m-badge--male m-badge--wide" style="color:white;letter-spacing: 0.6px;padding: 1px 10px;border-radius: 0.75rem;background-color: #3F51B5"><i class="fa fa-mars" aria-hidden="true"></i>male</span> -->
																							<span class="badge badge-blue px-4">
																								<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
																								<span class="svg-icon svg-icon-5 svg-icon-success ms-n1 me-1">
																									<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
																										<path d="M12 0H0V12H12V0Z" fill="white" fill-opacity="0.01"></path>
																										<path d="M10.4879 3.76222V1.51221H8.23785" stroke="#2F81FC" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
																										<path d="M2.60325 9.50028C3.97007 10.8671 6.18617 10.8671 7.553 9.50028C8.23642 8.81685 8.57812 7.92113 8.57812 7.0254C8.57812 6.12968 8.23642 5.23395 7.553 4.55053C6.18617 3.18368 3.97007 3.18368 2.60325 4.55053C1.23642 5.91735 1.23642 8.13343 2.60325 9.50028Z" stroke="#2F81FC" stroke-width="1.4" stroke-linejoin="round"></path>
																										<path d="M7.49997 4.50008L9.98787 2.01221" stroke="#2F81FC" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
																									</svg>
																								</span>Male
																							</span>
																						<?php
																						elseif ($interaction['sex'] === 'female') : ?>
																							<span class="badge badge-red px-4">
																								<span class="svg-icon svg-icon-5 svg-icon-success ms-n1 me-1">
																									<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
																										<g clip-path="url(#clip0_575_111)">
																											<path d="M12 0H0V12H12V0Z" fill="white" fill-opacity="0.01"></path>
																											<path d="M9.59467 2.46307C8.22784 1.09624 6.01176 1.09624 4.64492 2.46307C3.96151 3.14649 3.6198 4.04222 3.6198 4.93795C3.6198 5.83368 3.96151 6.7294 4.64492 7.41282C6.01176 8.77966 8.22784 8.77966 9.59467 7.41282C10.9615 6.04599 10.9615 3.82991 9.59467 2.46307Z" stroke="#F87B7B" stroke-width="1.4" stroke-linejoin="round"></path>
																											<path d="M4.61612 7.38394L1.43414 10.5659" stroke="#F87B7B" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
																											<path d="M4.79289 10.3892L1.61091 7.20718" stroke="#F87B7B" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
																										</g>
																										<defs>
																											<clipPath id="clip0_575_111">
																												<rect width="12" height="12" fill="white"></rect>
																											</clipPath>
																										</defs>
																									</svg>

																								</span>Female
																							</span>
																						<?php
																						else : ?>
																							<div class="d-flex">
																								<div style="width: 20px;height: 20px;border-radius: 50%;background-color: #8c8c93"></div>
																								<div style="padding-left: 5px">
																									other
																								</div>

																							</div>
																						<?php


																						endif; ?>
																					</td>
																					<td><?= $interaction['relationship'] ?></td>
																					<td><?= $interaction['city'] ?></td>
																					<td><?= $interaction['created_date'] ?? '' ?></td>
																				</tr>
																			<?php
																			endforeach ?>
																		</tbody>

																	</table>
																</div>
																<div class="row mt-5">

																	<?= $pagination ?>

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
		</div>
		<!-- end::Row -->
		<!--end::Container-->
	</div>
	<!--end::Content-->
</div>

<script>
	var doughnutChart = function(chartSelector, labels, data, colors) {
		var element = document.querySelector(chartSelector);

		if (!element) {
			return;
		}
		new Chart(element, {
			type: 'doughnut',
			data: {
				labels: labels,
				datasets: [{
					data: data,
					backgroundColor: colors,
				}],
			},
			options: {
				plugins: {
					legend: {
						position: 'bottom',
					},
				},
				responsive: true,
			},
		});
	};
	<?php if (!empty($charts['gender'])) : ?>
		doughnutChart('#doughnutChartGender', <?= json_encode($charts['gender']['labels']) ?>,
			<?= json_encode($charts['gender']['series']) ?>, <?= json_encode($charts['gender']['colors']) ?>);
	<?php endif; ?>

	<?php if (!empty($charts['ages'])) : ?>
		doughnutChart('#doughnutChartAge', <?= json_encode($charts['ages']['labels']) ?>,
			<?= json_encode($charts['ages']['series']) ?>, <?= json_encode($charts['ages']['colors']) ?>);
	<?php endif; ?>

	<?php if (!empty($charts['relationships'])) : ?>
		doughnutChart('#doughnutChartRelationship', <?= json_encode($charts['relationships']['labels']) ?>,
			<?= json_encode($charts['relationships']['series']) ?>, <?= json_encode($charts['relationships']['colors']) ?>);
	<?php endif; ?>

	<?php if (!empty($charts['friends'])) : ?>
		doughnutChart('#doughnutChartFriends', <?= json_encode($charts['friends']['labels']) ?>,
			<?= json_encode($charts['friends']['series']) ?>, <?= json_encode($charts['friends']['colors']) ?>);
	<?php endif; ?>

	<?php if (!empty($charts['follows'])) : ?>
		doughnutChart('#doughnutChartFollows', <?= json_encode($charts['follows']['labels']) ?>,
			<?= json_encode($charts['follows']['series']) ?>, <?= json_encode($charts['follows']['colors']) ?>);
	<?php endif; ?>
</script>