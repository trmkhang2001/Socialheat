<?php

use app\common\utilities\Common;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessXpath;

class Xpath extends BackendController
{


	public function index()
	{
		$itemPerPage = DEFAULT_ITEM_PER_PAGE;
		$conditions = $this->getConditions();
		$page = intval($this->input->get('page', TRUE));
		$offset = $page ? $itemPerPage * ($page - 1) : 0;
		$items = BusinessXpath::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
		$total = BusinessXpath::getInstance()->getCount($conditions);
		$pagination = Pagination::bootstrap($total, '', $itemPerPage);
		$this->setBreadcrumbs('Danh sách Xpath', 'Quản lý');
		$this->temp['data']['items'] = $items;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/xpath/index';
		$this->render();
	}

	private function getConditions()
	{
		$modelDbSetting = BusinessXpath::getModel();
		$filterArr = array('channel_type', 'type');
		$filterConditions = $this->input->get($filterArr, TRUE);
		$this->temp['data']['channel_type'] = $filterConditions['channel_type'];
		$this->temp['data']['type'] = $filterConditions['type'];
		$conditions = array();
		foreach ($filterConditions as $key => $condition) {
			if ($condition) {
				$conditions[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $condition);
			}
		}
		return $conditions;
	}

	public function create()
	{
		$model = BusinessXpath::getModel();
		$item = Common::getFieldObj($model::$fields);
		$item->id = 0;
		$this->temp['data']['item'] = $item;
		$this->setBreadcrumbs('Thêm Xpath', 'Quản lý');
		$this->temp['template'] = 'backend/xpath/update';
		$this->render();
	}

	public function update($id)
	{
		$item = BusinessXpath::getInstance()->findOneCache($id);
		$this->temp['data']['item'] = $item;
		$this->setBreadcrumbs('Cập nhật Xpath', 'Quản lý');
		$this->temp['template'] = 'backend/xpath/update';
		$this->render();
	}


	public function save()
	{
		$model = BusinessXpath::getModel();
		$data = $this->input->post($model::$fields, TRUE);
		unset($data['status']);
		$id = $this->input->post('id', TRUE);

		if ($_POST && $data) {
			if ($id > 0) {

				$data['updated_date'] = date('Y-m-d H:i:s');
				$res = BusinessXpath::getInstance()->update($id, $data, TRUE);
			} else {
				$data['created_date'] = date('Y-m-d H:i:s');
				$data['status'] = STATUS_ACTIVE;
				$res = BusinessXpath::getInstance()->save($data, TRUE);
			}
			$this->result = $res;
			$this->response();
		}
	}

	public function delete($id)
	{
		$item = BusinessXpath::getInstance()->findOne($id);
		if ($item) {
			$res = BusinessXpath::getInstance()->delete($id, []);
			$this->result = $res;
			$this->response();
		}
	}

	public function token()
	{
		$item = BusinessXpath::getInstance()->findByConditions(['type' => XPATH_TYPE_TOOL_POST_FB_TOKEN], TRUE);
		if (empty($item)) {
			$model = BusinessXpath::getModel();
			$item = Common::getFieldObj($model::$fields);
			$item->id = 0;
		}
		$this->temp['data']['item'] = $item;
		$this->temp['template'] = 'backend/xpath/fb_token';
		$this->render();
	}
}
