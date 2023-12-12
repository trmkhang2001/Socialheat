<?php
/**
 * @var $missInteractions
 */

foreach ($missInteractions as $index => $mInteraction):?>
	<tr>
		<td>
			<span><?= ++$index ?></span>
		</td>
		<td>
			<a href="https://facebook.com/<?= $mInteraction->uid ?>" class="symbol symbol-50px me-4" target="_blank">
				<img style="width: 40px; height:40px" class="border rounded-pill m--img-rounded m--marginless" src="https://graph.facebook.com/<?= $mInteraction->uid ?>/picture?type=large&amp;width=500&amp;height=500&amp;access_token=<?= FB_TOKEN ?>" alt="">
			</a>
		</td>
		<td>
			<div class="d-flex justify-content-start flex-column">
				<a href="https://facebook.com/100004882509279" target="_blank">
					<span class="text-dark fw-bold text-hover-primary fs-6"><?= $mInteraction->uid ?></span>
				</a>
			</div>
		</td>
		<td>

		</td>
	</tr>
<?php endforeach;?>