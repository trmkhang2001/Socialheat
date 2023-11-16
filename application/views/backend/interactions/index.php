<?php

/**
 * @var $items
 * @var $tokenFb
 * @var $pagination
 * @var $total
 * @var $userInfo
 *
 */
$name = array("Ensure Gold", "#ensureGold", "#ensurevietnam", "#ensuregoldvietnam", "#suaensure");
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}

	.m-content .panel {
		-webkit-box-shadow: 1px 2px 0 #e5eaee;
		box-shadow: 1px 2px 0 #e5eaee;
		padding: 25px;
	}

	.m-content .text-system {
		display: block;
	}

	.m--img-rounded {
		border-radius: 50% !important;
	}

	table tbody td div {
		width: fit-content !important;
		font-size: 13px;
		text-align: center;
	}

	.table td {
		white-space: nowrap;
	}
</style>
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Container-->
	<div class="container-fluid" id="kt_content_container">
		<h1 class="mb-7">Interactions</h1>
		<!--begin::Form filter-->
		<div class="d-flex flex-stack bg-white bd-highlight mb-6 p-10 rounded">
			<form data-kt-search-element="form" class="d-flex bd-highlight" autocomplete="on">
				<div class="flex-fill me-3">
					<!-- begin::Input -->
					<input type="text" class="search-input form-control form-control border h-lg-45px ps-3" id="uid" name="uid" value="" placeholder="UID" data-kt-search-element="input">
					<!--end::Input-->
				</div>
				<div class="flex-fill me-3">
					<!--begin::Input-->
					<input type="text" class="search-input form-control form-control border h-lg-45px ps-3" id="keywords" name="keywords" value="<?= $this->input->get('keywords') ?>" placeholder=" Keywords" data-kt-search-element="input">
					<!--end::Input-->
				</div>
				<div class="flex-fill ms-7 me-3">
					<button type="submit" class="btn btn-primary">Filter</button>
				</div>
			</form>
		</div>
		<?php if ($userInfo['role_id'] === ROLE_DOWNLOAD || $userInfo['role_id'] === ROLE_ADMIN) : ?>
			<div class=" card p-3 mb-5 export-status form-group m-form__group" style="display: none;">
				<h6>Downloading</h6>
				<div class="progress">
					<div class="progress-bar progress-bar-primary progress-bar-striped " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
						0% Complete
					</div>
				</div>
			</div>
		<?php endif; ?>
		<!--end::Form-->
		<div class="row mb-6">
			<div class="col-md-12">
				<div class="panel">
					<div class="bg-white rounded ps-2 pt-5">
						<div class="app-container d-flex flex-stack ms-3 me-3 ">
							<div class="d-flex flex-column justify-content-center flex-wrap me-3">
								<!--begin::Title-->
								<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0 mb-3">
									Result
								</h1>
								<!--end::Title-->
								<span>Total: <b><?= number_format($total) ?> </b> interactions</span>
							</div>
							<div class="clearfix">
								<a href="#" class="btn btn-light-primary me-3 pull-right group-export-csv can-export" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
									<i class="ki-duotone ki-exit-up fs-2"><span class="path1"></span><span class="path2"></span></i> Export
								</a>
							</div>
						</div>
						<br>
						<br>
						<!--begin::Table container-->
						<div class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
							<!--begin::Table-->
							<table class="table table-bordered table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
								<!--begin::Table head-->
								<thead>
									<tr class="text-muted">
										<th width="20px">Uid</th>
										<th>Name</th>
										<th>Phone</th>
										<th width="230px">Email</th>
										<th width="120px">Relationship</th>
										<th>City</th>
										<th>Friends</th>
										<th>Sex</th>
										<th>Birthday</th>
										<th width="300px">Keywords</th>
										<th>Created date</th>
									</tr>
								</thead>
								<!--end::Table head-->
								<!--begin::Table body-->
								<tbody>
									<?php foreach ($items as $item) { ?>
										<tr>
											<td style="width: fit-content">
												<a target="_blank" href="https://facebook.com/<?= $item->uid ?>">
													<img style="width:40px;" class="m--img-rounded " src="<?= sprintf('https://graph.facebook.com/%s/picture?type=square&access_token=%s', $item->uid, $tokenFb) ?>">
												</a>
											</td>
											<td>
												<div class="d-flex justify-content-start flex-column">
													<a href="#" class="text-dark fw-bold text-hover-primary fs-6"><?= $item->name ?></a>
												</div>
											</td>
											<td>
												<span class="fw-bold badge badge-blue px-4 showData" data-decode="<?= $item->phone ?>">
													<span class="svg-icon svg-icon-5 svg-icon-success ms-n1 me-1" style="color: #5c98ff;">
														<i class="fa-solid fa-eye fa-beat me-2" style="color: #5c98ff;"></i>Show
													</span>
												</span>
											</td>
											<td>
												<span class="text-dark me-2 fs--7 fw-bold "><?= $item->email ?></span>
											</td>
											<td>
												<span class="text-dark me-2 fs--7 fw-bold "><?= $item->relationship ?></span>
											</td>
											<td>
												<span class="text-dark me-2 fs--7 fw-bold "><?= $item->city ?></span>
											</td>
											<td>
												<span class="text-dark me-2 fs--7 fw-bold "><?= $item->friends ?></span>
											</td>
											<td>
												<?php
												if ($item->sex === 'male') : ?>
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
												elseif ($item->sex === 'female') : ?>
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
													<!-- <span class="m-badge  m-badge--male m-badge--wide" style="color:white;letter-spacing: 0.6px;padding: 1px 10px;border-radius: 0.75rem;background-color: #3F51B5"><i class="fa fa-mars" aria-hidden="true"></i>male</span> -->
													<span class="badge badge-blue px-4">
														<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
														<span class="svg-icon svg-icon-5 svg-icon-success ms-n1 me-1">
															<i class="fa-solid fa-venus-mars" style="color: #FF00C9;"></i>
														</span>Other
													</span>
												<?php


												endif; ?>
											</td>
											<td>
												<span class="text-dark me-2 fs--7 fw-bold "><?php $date = date('d/m/Y', strtotime($item->birthday));
																							echo $date; ?></span></span>
											</td>
											<td class="form_filters_post text-left ">
												<div class="d-flex clearfix item-content-read-less">
													<?php $this->load->view('/backend/monitoring/item_keywords', ['keywords' => explode(',', $item->keywords)]); ?>
												</div>
											</td>
											<td>
												<span class="text-dark me-2 fs--7 fw-bold "><?php $date = date('d/m/Y', strtotime($item->created_date));
																							echo $date; ?></span>
											</td>
										</tr>
									<?php } ?>
								</tbody>
								<!--end::Table body-->
							</table>
							<!--end::Table-->
						</div>
						<!--end::Table container-->

					</div>
					<div class="row">
						<div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
							<div class="dataTables_paginate paging_simple_numbers" id="kt_ecommerce_report_views_table_paginate">
								<?php echo $pagination ?>
							</div>
						</div>
					</div>
					<!-- <div class="clearfix my-15">
					</div> -->
				</div>
			</div>

		</div>
	</div>
</div>
</div>

<script>
	async function sendDataToDB(target) {
		var totals = '<?= $total ?>';
		var home_url = '<?= site_url() ?>';
		var number_of_page = Math.ceil(parseInt(totals.replace(/,/g, '')) / 1000);
		csv_data = [];
		$('.export-status').show();
		$('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%');
		let endId = '';
		for (var i = 1; i <= number_of_page; i++) {
			var url = new URL(home_url + '/backend/interactions/download');
			const params = {
				limit: 1000,
				current_page: i,
				totals: totals,
				end_id: endId,
				from_date: $('#from_date').val(),
				to_date: $('#to_date').val(),
				keywords: $('#keywords').val(),
			};
			const stream = await new ReadableStream();
			Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
			const rawResponse = await fetch(url);
			const response = rawResponse.clone();
			if (response.ok) { // if HTTP-status is 200-299
				// get the response body (the method explained below)
				let res = await response.json();
				if (res.status === false) {
					toastr['error'](res.msg);
					// alert(res.msg);
					return false;
				}
			}
			const reader = rawResponse.body.getReader();
			const contentLength = +rawResponse.headers.get('Content-Length');
			// Step 3: read the data
			let receivedLength = 0; // received that many bytes at the moment
			let chunks = []; // array of received binary chunks (comprises the body)
			while (true) {
				const {
					done,
					value
				} = await reader.read();

				if (done) {
					break;
				}

				chunks.push(value);
				receivedLength += value.length;

				var file_down_percent = receivedLength / 4983540 * 100;
				var percent = Math.round((i / number_of_page) * 100);
				percent = percent + (file_down_percent / number_of_page);
				percent = percent.toPrecision(3);

				$('.progress-bar').attr('aria-valuenow', percent).css('width', percent + '%');
				$('.progress-bar').text(percent + '% Complete');
			}
			// Step 4: concatenate chunks into single Uint8Array
			let chunksAll = new Uint8Array(receivedLength); // (4.1)
			let position = 0;
			for (let chunk of chunks) {
				chunksAll.set(chunk, position); // (4.2)
				position += chunk.length;
			}
			let result = new TextDecoder('utf-8').decode(chunksAll);
			let content = JSON.parse(result);
			var html = content.uids;
			var length = html.length;
			for (var k = 0; k < length; k++) {
				var temp = [
					html[k].uid,
					html[k].name,
					html[k].email,
					html[k].phone,
					html[k].friends,
					html[k].follow,
					html[k].relationship,
					html[k].city,
				];
				if ((k + 1) === length) {
					endId = html[k].id;
				}
				csv_data.push(temp);
			}
		}
		let nameFile = $('#from_date').val() + '--' + $('#to_date').val() + new Date().getTime();
		$('.export-status').hide();
		downloadCSV(csv_data, nameFile);
	}

	function downloadCSV(data, name) {
		var filename, link;
		var csv = '\ufeff Social Profile,NAME,EMAIL,PHONE,FRIEND,FOLLOW,RELATIONSHIP,City';
		// for (var i = 0; i <= extra_fields.length - 1; i++) {
		//   csv = csv + ',' + extra_fields[i];
		// }
		csv = csv + '\n';
		for (var i = data.length - 1; i >= 0; i--) {
			var d = data[i];
			for (var j = 0; j <= d.length - 1; j++) {
				if (typeof d[j] === 'string') {
					d[j] = d[j].replaceAll(',', '');
				}
				csv += d[j];
				if (j < d.length - 1) {
					csv += ',';
				}
			}
			csv += '\n';
		}
		var universalBOM = '\uFEFF';
		// if (csv == null) return;
		date = new Date();
		filename = 'Socialheat - ' + name + '.csv';
		csvData = new Blob([csv], {
			type: 'text/csv',
			charset: 'utf-8',
		});
		var csvUrl = URL.createObjectURL(csvData);
		// data = encodeURI(csv);
		link = document.createElement('a');
		link.setAttribute('href', csvUrl);
		link.setAttribute('download', filename);
		link.click();
	}

	$(document).ready(function() {
		$('.group-export-csv, #group-export-phone').click(function(e) {
			e.preventDefault();
			var $target = $(e.currentTarget);
			if ($target.hasClass('can-export')) {
				sendDataToDB($target);
			}
		});
	});
	$('.item-content-read-less').each(function(idx, $element) {
		var height = this.clientHeight;
		console.log(height)
		if (height <= 60) {
			$(this).parent().find('.read_more').addClass('hidden');
		} else {
			$(this).addClass('read-less');
			$(this).parent().find('.read_more').removeClass('hidden');

		}
	})
</script>