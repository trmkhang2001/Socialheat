<?php
/**
 * @var $channelTypes
 * @var $types
 */
$params = ['AccessToken' => ACCESS_TOKEN];
$commentParams = ['AccessToken' => ACCESS_TOKEN,'comment_id' => ''];
?>
<style>
	.actions ul li {
		margin-bottom: 10px;
	}

	a {
		cursor: pointer;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="">

				<table class="table table-hover table-bordered">
					<thead>
					<tr class="active ">
						<th width="20%">Type</th>
						<th>Api</th>
					</tr>
					</thead>
					<tbody>
					<tr>
						<td>Comments</td>
						<td>
							<ul>
								<li><a class="copy-api-url"
									   data-url="<?= site_url('/backend/api/comments?' . http_build_query($commentParams)) ?>">Api
										Get Comment</a></li>
								<li>
									<a class="copy-api-url"
									   data-url="<?= site_url('/backend/api/comment_reports') ?>">Api Post Comment
										Report</a> |
									<a target="_blank"
									   href="<?= site_url('/assets/file/slp2_post_comment_reports.json') ?>">Json
										example</a>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td>Interaction</td>
						<td>
							<ul>
								<li><a class="copy-api-url"
									   data-url="<?= site_url('/backend/api/posts_interactive?' . http_build_query($params)) ?>">Api
										Get Post Interaction</a></li>
								<li>
									<a class="copy-api-url"
									   data-url="<?= site_url('/backend/api/import_interactive') ?>">Api Import
										Interaction</a> |
									<a target="_blank"
									   href="<?= site_url('/assets/file/slp2_import_interaction.json') ?>">Json
										example</a>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td>Social Items</td>
						<td>
							<ul>
								<?php foreach ($channelTypes as $type):
									$params = ['channel_type' => $type['value'], 'AccessToken' => ACCESS_TOKEN];
									$apiUrl = site_url('/backend/api/social_items?' . http_build_query($params));

									?>
									<li><?= sprintf('%s: <a data-url="%s" class="copy-api-url" href="%s" target="_blank">%s</a>', $type['name'], $apiUrl,$apiUrl, 'Copy') ?></li>

								<?php endforeach; ?>
							</ul>
						</td>
					</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-12">
	</div>
</div>
<?php $this->load->view('backend/layout/submit_form', array('method' => 'saveMultipleLetter')) ?>
