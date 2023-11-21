<?php

use app\common\business\BusinessApi;
use app\common\business\BusinessInteraction;
use app\common\business\BusinessInterface;
use app\common\business\BusinessItem;
use app\common\business\BusinessKeyword;
use app\common\business\BusinessSocialItem;
use app\common\utilities\Common;
use app\common\business\BusinessUser;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\models\Interaction;
use app\models\Item;

class Dashboards extends BackendController
{
	public function index()
	{
		$keywords = BusinessKeyword::getInstance()->findByConditions([], TRUE);
		$totalKeyword = count(explode(',', $keywords->keyword));
		$totalAudience = BusinessItem::getInstance()->getCount();
		$totalMentions = BusinessSocialItem::getInstance()->getCount();
		$totalEngage = BusinessInteraction::getInstance()->getCount();
		$topKeywords  = BusinessItem::getInstance()->getTopKeywords(ITEM_PER_PAGE_10);
		$chartInteractions = $this->_getChartInteractionByType();
		$chartPosts = $this->_getChartPostByRangeDate();
		$this->temp['data']['totalKeyword'] = $totalKeyword;
		$this->temp['data']['totalAudience'] = $totalAudience;
		$this->temp['data']['totalMentions'] = $totalMentions;
		$this->temp['data']['totalEngage'] = $totalEngage;
		$this->temp['data']['chartInteractions'] = $chartInteractions;
		$this->temp['data']['chartPosts'] = $chartPosts;
		$this->temp['data']['topKeywords'] = $topKeywords;
		$this->temp['template'] = 'backend/dashboards/index';
		$this->render();
	}


	private function _getChartPostByRangeDate()
	{
		$posts = BusinessItem::getInstance()->getPostByRangeDate();
		$charts = [];
		foreach ($posts as $post) {
			$charts['label'][] = $post->date_format;
			$charts['items'][] = $post->total_item;
			$charts['data'][] = $post->total_data ?? 0;
		}
		return $charts;
	}

	private function _getChartInteractionByType()
	{
		$interactions = BusinessItem::getInstance()->getTotalInteractionByType();
		$params = $this->config->config['params'];
		$charts = [];

		if ($interactions) {
			$types = $params['types'];
			foreach ($interactions as $interaction) {
				$charts['label'][] = $types[$interaction->type]['name'];
				$charts['data'][] = $interaction->total_data ?? 0;
			}
		}
		return $charts;
	}
}
