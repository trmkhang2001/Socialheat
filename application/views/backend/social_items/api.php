<?php
/**
 * @var $channelTypes
 * @var $types
 */
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="">

				<table class="table table-hover table-bordered">
					<thead>
					<tr class="active ">
						<th width="20%">Channel Type</th>
						<th>Api</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($channelTypes as $type):
						$params = ['channel_type' => $type['value'], 'AccessToken' => ACCESS_TOKEN];
						$apiUrl = site_url('/backend/api/social_items?' . http_build_query($params));

						?>
						<tr class="text-justify">
							<td><?= $type['name'] ?></td>
							<td>
								<ul class="list-inline">
									<li><?= sprintf('%s: <a data-url="%s" class="copy-api-url" href="%s" target="_blank">%s</a>', $type['name'], $apiUrl,$apiUrl, 'Copy') ?></li>

								</ul>
							</td>
						</tr>
					<?php endforeach; ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
	</div>
</div>
<?php $this->load->view('backend/layout/submit_form', array('method' => 'saveMultipleLetter')) ?>
