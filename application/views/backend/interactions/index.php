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
						<div class="table-responsive table-scrollable m-5">
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
												<span class="text-muted fw-bold text-hover-primary d-block"><?= $item->phone ?></span>

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
												<span class="text-dark me-2 fs--7 fw-bold "><?= $item->sex ?></span>
											</td>
											<td>
												<span class="text-dark me-2 fs--7 fw-bold "><?= $item->birthday ?></span>
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