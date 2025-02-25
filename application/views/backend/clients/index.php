
<style>
	.read-less {
		max-height: 40px;
	}
</style>
<?php
/**
 * @var $items
 * @var $pagination
 * @var $filters
 * @var $total
 */
?>
<div class="m-content">
	<div class="clearfix form-filter m--margin-bottom-10">
		<?php $this->load->view('/backend/clients/_item_filters', ['filters' => $filters]) ?>
	</div>
	<div class="clearfix">
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
	<div class="list_item_content">
		<?php
		$types = $this->config->config['params']['types'];
		foreach ($items as $item): ?>
			<?php $this->load->view('/backend/clients/_item',['item' => $item,'types' => $types])?>
		<?php endforeach; ?>
	</div>

	<div class="row clearfix text-center" style="display: block">
		<?= $pagination ?>
	</div>

</div>
<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
<script>
  //Pusher.logToConsole = true;
  var pusher = new Pusher('<?= PUSHER_AUTH_KEY?>', {
    cluster: 'ap1',
    forceTLS: true,
  });

  var channel = pusher.subscribe('SIVC');
  channel.bind('notice', function(data) {
   $.get('/backend/clients/get_last_item',function(res){
     	if(res.success === true){
          let object = res.html;
     	  $('.list_item_content').prepend(object);
     	  $('.animation').hide().delay(500).show('slow');
     	  $('.animation').removeClass('animation');
          $('.list_item_content .portlet').last().remove();

        }
   },'json')

  });

  $(document).ready(function(){
    $('.post_keywords i').click(function(){
      let keyword = $(this).data('keyword');
      window.location = home_url+"/backend/clients?keyword[]="+keyword;
    })
  })

  $('.item-content-read-less').each(function(idx,$element){
    var height = this.clientHeight;
    if(height <= 40 ){
      $(this).parent().find('.read_more').addClass('hidden');
    }else{
      $(this).addClass('read-less');
      $(this).parent().find('.read_more').removeClass('hidden');

    }
  })

</script>

<script>async function sendDataToDB(target) {
		var totals = '<?= $total?>';
		var home_url = '<?= site_url()?>';
		var url = '<?= site_url('/backend/clients/download')?>';
		let itemPerPage = 1000;
		var number_of_page = Math.ceil(parseInt(totals.replace(/,/g, '')) / itemPerPage);
		csv_data = [];
		$('.export-status').show();
		$('.progress-bar').attr('aria-valuenow', 0).css('width', 0 + '%');
		var dataForm = $('.form-filter').serialize();

		let endId = '';
		for (var i = 1; i <= number_of_page; i++) {

			var params = dataForm +`&limit=${itemPerPage}&current_page=${i}&totals=${totals}`
			var urlDownload = url+'?'+params;
			const rawResponse = await fetch(urlDownload);
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
			// const contentLength = +rawResponse.headers.get('Content-Length');
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
					html[k].social_name,
					html[k].post_id,
					html[k].keywords
				];
				if ((k + 1) === length) {
					endId = html[k].id;
				}
				csv_data.push(temp);
			}
		}
		let nameFile = 'Soical Heat' + new Date().getTime();
		$('.export-status').hide();
		downloadCSV(csv_data, nameFile);
	}

	function downloadCSV(data, name) {
		var filename, link;
		var csv = '\ufeff Social NAME,ID POST,KEYWORDS';
		// for (var i = 0; i <= extra_fields.length - 1; i++) {
		//   csv = csv + ',' + extra_fields[i];
		// }
		csv = csv + '\n';
		for (var i = data.length - 1; i >= 0; i--) {
			var d = data[i];
			for (var j = 0; j <= d.length - 1; j++) {
				if (typeof d[j] === 'string') {
					d[j] = d[j].replaceAll(',', ' ');
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
</script>