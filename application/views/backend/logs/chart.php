<?php
/**
 * @var $clients
 * @var $items
 * @var $date_from
 * @var $date_to
 */
$params = $this->config->config['params'];
$clientType = $params['clients_type'];
$listStatus = $params['list_status'];
?>

	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="">
					<form method="get" action="">
						<div class="form-inline">

							<div class="form-group">
								<label class="text-system">Từ ngày</label>
								<div class="form-inline">
									<input type="date" name="date_from" class="form-control " value="<?= $date_from?>"
										   placeholder="">
								</div>
							</div>
							<div class="form-group">
								<label class="text-system">Đến ngày</label>
								<div class="form-inline">
									<input type="date" name="date_to" class="form-control " value="<?= $date_to?>"
										   placeholder="">
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

			</div>
		</div>

	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div id="html2canvas" style="background-color: #fff;">
					<canvas id="myChart" style=""></canvas>
				</div>
			</div>
		</div>
	</div>
	<script src="/assets/js/html2canvas.js"></script>

	<script src="/assets/plugins/chartjs/Chart.min.js"></script>
<?php
$name_report = sprintf('Thống kê số lượng call api của khách hàng');
?>
<script>
  var ctx = $("#myChart");
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo  json_encode($data['label']) ?>,
      datasets: [
		  <?php foreach ($listLabel as $labels):?>
        {
          label: '<?php echo json_encode($labels)?>',
          backgroundColor :<?php echo json_encode ($data['colors'])?>,
          data:  <?php echo json_encode($data['sum'])?>,
          fill: false
        },
		  <?php endforeach;?>

      ]
    },
    options: {
      legend: {
        display: false
      },
      title: {
        display: true,
        text: '<?php echo $name_report?>'
      },
      scales: {
        xAxes: [{ stacked: true, display: true,
          ticks: {
            autoSkip: false
          }
        }],
        yAxes: [
          {
            position: 'left',

            id: 'yAxis_Left',
            ticks: {
              fontColor: "#f39c12",
              beginAtZero: false,
              callback: unitK,
              //stepSize: 2000,
            }
          },
        ]
      },
      tooltips: {
        mode: 'single',
        intersect: true,
        callbacks: {
          label: function(tooltipItem, data) {
            var index = tooltipItem.index;
            var label = data.datasets[index].label;
            return label;

          },

        },

      }
    }

  });


  function unitK(value, index, values)
  {
    var unit = '', val = parseInt(value), sf = 0;
    if (val >= 1000000){ unit = 'M'; sf = val/1000000; }
    else if (val>=1000){ unit = 'K'; sf = val/1000; }
    else sf = val;
    return sf + unit;
  }

</script>
