<?php

use app\common\utilities\Common;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessSocialItem;
use app\common\components\Upload;

class SocialItems extends BackendController
{


	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$itemPerPage = DEFAULT_ITEM_PER_PAGE;
		$conditions = $this->getConditions();
		$page = intval($this->input->get('page', TRUE));
		$offset = $page ? $itemPerPage * ($page - 1) : 0;
		$items = BusinessSocialItem::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
		$total = BusinessSocialItem::getInstance()->getCount($conditions);
		$pagination = Pagination::bootstrap($total, '', $itemPerPage, 'page', 5);
		$this->temp['data']['items'] = $items;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/social_items/index';
		$this->render();
	}
	public function clients()
	{
		$itemPerPage = DEFAULT_ITEM_PER_PAGE;
		$conditions = $this->getConditionsClients();
		$page = intval($this->input->get('page', TRUE));
		$offset = $page ? $itemPerPage * ($page - 1) : 0;
		$items = BusinessSocialItem::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
		$total = BusinessSocialItem::getInstance()->getCount($conditions);
		$pagination = Pagination::bootstrap($total, '', $itemPerPage, 'page', 5);
		$this->temp['data']['items'] = $items;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/social_items/clients';
		$this->render();
	}

	private function getConditions()
	{
		$modelDbSetting = BusinessSocialItem::getModel();
		$filterArr = array('social_id', 'type', 'keyword', 'status', 'channel_type');
		$filterConditions = $this->input->get($filterArr, TRUE);
		$conditions = array();
		foreach ($filterConditions as $key => $condition) {
			if ($key === 'keyword') {
				$conditions[] = $this->getSimpleSearchCondition($modelDbSetting::tableName() . '.name');
			} elseif ($condition === '0' || $condition) {
				$conditions[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $condition);
			}
		}
		return $conditions;
	}
	private function getConditionsClients()
	{
		$modelDbSetting = BusinessSocialItem::getModel();
		$filterArr = array('social_id', 'type', 'keyword', 'status', 'channel_type');
		$filterConditions = $this->input->get($filterArr, TRUE);
		$conditions = array();
		$conditions[] = array(sprintf('%s', 'is_feature IS NOT NULL'));
		foreach ($filterConditions as $key => $condition) {
			if ($key === 'keyword') {
				$conditions[] = $this->getSimpleSearchCondition($modelDbSetting::tableName() . '.name');
			} elseif ($condition === '0' || $condition) {
				$conditions[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $condition);
			}
		}
		return $conditions;
	}

	public function create()
	{
		$model = BusinessSocialItem::getModel();
		$item = Common::getFieldObj($model::$fields);
		$item->id = 0;
		$this->temp['data']['item'] = $item;
		$this->setBreadcrumbs('Created Social Items', 'Dashboard');
		$this->temp['template'] = 'backend/social_items/update';
		$this->render();
	}

	public function update($id)
	{
		$item = BusinessSocialItem::getInstance()->findOneCache($id);
		$this->temp['data']['item'] = $item;
		$this->setBreadcrumbs('Cập nhật bài viết', 'Quản lý');
		$this->temp['template'] = 'backend/social_items/update';
		$this->render();
	}

	public function deactive($id)
	{
		$item = BusinessSocialItem::getInstance()->findOneCache($id);
		if ($item) {
			BusinessSocialItem::getModel()->update($id, ['status' => STATUS_DEACTIVE], FALSE);
			redirect('/backend/socialitems');
		}
	}
	public function active($id)
	{
		$item = BusinessSocialItem::getInstance()->findOneCache($id);
		if ($item) {
			BusinessSocialItem::getInstance()->update($id, ['status' => STATUS_ACTIVE], FALSE);
			redirect('/backend/socialitems');
		}
	}

	public function save()
	{
		$model = BusinessSocialItem::getModel();
		$data = $this->input->post($model::$fields, TRUE);
		// echo "<pre>";print_r($data);die;
		unset($data['status']);
		$id = $this->input->post('id', TRUE);
		$user = $this->userInfo;
		if ($_POST && $data) {
			$objImage = Upload::isEmpty('image');
			if (!$objImage) {
				$image = BusinessSocialItem::getInstance()->upload('image');
				if (!empty($image['file_path'])) {
					$data['image'] = $image['file_path'];
				} else {
					$res['validation']['image'] = $image['error_message'];
					$this->response($res);
				}
			}
			if ($id > 0) {
				$data['updated_by'] = $user['id'];
				$data['updated_date'] = date('Y-m-d H:i:s');
				$res = BusinessSocialItem::getInstance()->update($id, $data, TRUE);
			} else {
				$data['created_by'] = $user['id'];
				$data['created_date'] = date('Y-m-d H:i:s');
				$data['status'] = STATUS_ACTIVE;
				$res = BusinessSocialItem::getInstance()->save($data, TRUE);
			}
			$this->result = $res;
			$this->response();
		}
	}

	public function delete($id)
	{
		$item = BusinessSocialItem::getInstance()->findOne($id);
		if ($item) {
			$res = BusinessSocialItem::getInstance()->delete($id, []);
			$this->result = $res;
			$this->response();
		}
	}

	public function linkApi()
	{
		$channelTypes = $this->config->config['params']['channel_types'];
		$this->temp['data']['channelTypes'] = $channelTypes;
		$this->temp['data']['types'] = $this->config->config['params']['types'];
		$this->temp['template'] = 'backend/social_items/api';
		$this->render();
	}
}
