<?php
/**
 * @var $items
 * @var $tokenFb
 * @var $pagination
 * @var $total
 * @var $userInfo
 *
 */

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

	table tbody td div{
		width:  fit-content !important;
		font-size: 13px;
		text-align: center;
	}

</style>

<div class="m-content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="">
					<form method="get" class="form_filters_post">
						<div class="form-inline">
							<div class="form-group">
								<label class="text-system">Uid</label>
								<div class="form-inline">
									<input type="text" name="uid" class="form-control " value=""
										   placeholder="Uid">
								</div>
							</div>
							<div class="form-group">
								<label class="text-system">From date</label>
								<div class="form-inline">
									<input type="date" id="from_date" name="from_date" class="form-control " value="<?= $this->input->get('from_date')?>"
										   placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<label class="text-system">To date</label>
								<div class="form-inline">
									<input type="date" id="to_date" name="to_date" class="form-control " value="<?= $this->input->get('to_date')?>"
										   placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<label class="text-system">Keyword</label>
								<div class="form-inline">
									<input type="text" id="keywords" name="keywords" class="form-control " value="<?= $this->input->get('keywords')?>"
										   placeholder="Keyword">
								</div>
							</div>

							<div class="form-group">
								<label class="text-system"> &nbsp;</label>
								<div class="form-inline">
									<button type="submit" class="btn btn-default "><i class="fa fa-filter"></i> Lọc dữ
										liệu
									</button>

								</div>
							</div>
						</div>

					</form>

				</div>
				<?php if ($userInfo['role_id'] === ROLE_DOWNLOAD || $userInfo['role_id'] === ROLE_ADMIN): ?>
					<div class="export-status form-group m-form__group" style="display: none;">
						<h6>Downloading</h6>
						<div class="progress">
							<div class="progress-bar progress-bar-primary progress-bar-striped " role="progressbar"
								 aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
								 style="width:0%">
								0% Complete
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="">
					<div class="clearfix">
						<span>Tổng số interactions: <b><?= number_format($total) ?></b></span>
						<a href="#" class="btn btn-success pull-right group-export-csv can-export">
                                <span>
                                    <i class="fa fa-download"></i>
                                    <span>Download Data</span>
                                </span>
						</a>
					</div>
					<br>
					<br>
					<div class="list_item_content table-scrollable ">
						<table class="table  table-bordered table-hover" style="width: 1400px !important; max-width: 1400px">
						<thead>
						<tr class="">
							<th width="20px">Uid</th>
							<th >Name</th>
							<th >Phone</th>
							<th  width="230px">Email</th>
							<th width="120px">Relationship</th>
							<th >City</th>
							<th >Friends</th>
							<th>Sex</th>
							<th>Birthday</th>
							<th width="300px">Keywords</th>
							<th>Created date</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($items as $item): ?>
							<tr>
								<td style="width: fit-content">
									<a target="_blank" href="https://facebook.com/<?= $item->uid ?>">
										<img style="width:40px;" class="m--img-rounded " src="<?= sprintf('https://graph.facebook.com/%s/picture?type=square&access_token=%s', $item->uid, $tokenFb) ?>">
									</a>
								</td>
								<td ><div style="width: fit-content"><?= $item->name ?></div></td>
								<td><div><?= $item->phone ?></div></td>
								<td><div style="text-transform: lowercase"><?= $item->email ?></div></td>
								<td><div><?= $item->relationship ?></div></td>
								<td><div><?= $item->city ?></div></td>
								<td><div><?= $item->friends ?></div></td>
								<td><div><?= $item->sex ?></div></td>
								<td><div><?= $item->birthday ?></div></td>
								<td class="form_filters_post text-left ">
									<div class="clearfix item-content-read-less">
										<?php $this->load->view('/backend/clients/item_keywords',['keywords' => explode(',',$item->keywords)]);?>
									</div>
									<a href="#" class="read_more clearfix">Read more</a>

								</td>

								<td><div><?= $item->created_date ?></div></td>
							</tr>
						<?php endforeach; ?>

						</tbody>
					</table>
					</div>

				</div>
				<div class="clearfix">
					<?php echo $pagination ?>
				</div>
			</div>
		</div>

	</div>
</div>

<script>async function sendDataToDB(target) {
    var totals = '<?= $total?>';
    var home_url = '<?= site_url()?>';
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
        const {done, value} = await reader.read();

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
	$('.item-content-read-less').each(function(idx,$element){
		var height = this.clientHeight;
		console.log(height)
		if(height <= 60 ){
			$(this).parent().find('.read_more').addClass('hidden');
		}else{
			$(this).addClass('read-less');
			$(this).parent().find('.read_more').removeClass('hidden');

		}
	})
</script>
