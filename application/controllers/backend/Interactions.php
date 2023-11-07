<?php

use app\controllers\backend\BackendController;
use app\common\business\BusinessInteraction;
use app\common\business\BusinessXpath;

class Interactions extends BackendController
{
	public function index()
	{
		$itemPerPage = ITEM_PER_PAGE_20;
		$conditions = $this->getConditions();
		$page = intval($this->input->get('page', TRUE));
		$offset = $page ? $itemPerPage * ($page - 1) : 0;
		$items = BusinessInteraction::getInstance()->getRangeCache($conditions, $offset, $itemPerPage, 'id DESC');
		$total = BusinessInteraction::getInstance()->getCount($conditions);
		$pagination = $this->pagination($total, $itemPerPage);
		$accessToken = FB_TOKEN;
		$token = BusinessXpath::getInstance()->findByConditions(['channel_type' => CHANNEL_TYPE_FACEBOOK_TOKEN], TRUE);
		if ($token) {
			$accessToken = $token->xpath;
		}
		$this->temp['page_title'] = 'Export';
		$this->temp['data']['total'] = $total;
		$this->temp['data']['items'] = $items;
		$this->temp['data']['tokenFb'] = $accessToken;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/interactions/index';
		$this->render();
	}

	private function getConditions()
	{
		$filterArr = array('keywords', 'from_date', 'to_date', 'uid');
		$filterConditions = $this->input->get($filterArr, TRUE);
		$conditions = array();
		foreach ($filterConditions as $key => $condition) {
			if ($condition) {
				if ($key === 'keyword') {
					$keywords = explode(',', $condition);
					foreach ($keywords as $item) {
						$conditions[0][] = $this->getSimpleSearchCondition('keywords', $item);
					}
				} elseif ($key === 'to_date') {
					$conditions[] = array(sprintf('%s', 'DATE(created_date) <=') => $condition);
				} elseif ($key === 'from_date') {
					$conditions[] = array(sprintf('%s', 'DATE(created_date) >=') => $condition);
				} else {
					$conditions[] = array(sprintf('%s', $key) => $condition);
				}
			}
		}
		return $conditions;
	}



	public function clear_cache()
	{
		BusinessInteraction::getModel()->clearCache();
	}

	public function download()
	{
		$itemPerPage = $this->input->get('limit');
		$conditions = $this->getConditions();
		$page = intval($this->input->get('current_page', TRUE));
		$offset = $page ? $itemPerPage * ($page - 1) : 0;
		$endId = $this->input->get('end_id', TRUE);
		$items = BusinessInteraction::getInstance()->getDataDownload($conditions, $offset, $itemPerPage, $endId);
		$this->response(['uids' => $items, 'status' => TRUE, 'msg' => '']);
	}
}
