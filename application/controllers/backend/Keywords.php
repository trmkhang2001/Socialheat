<?php

use app\common\utilities\Common;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessKeyword;

class Keywords extends BackendController
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
		$items = BusinessKeyword::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
		$total = BusinessKeyword::getInstance()->getCount($conditions);
		$pagination = Pagination::bootstrap($total, '', $itemPerPage);
		$this->setBreadcrumbs('Danh sách items', 'Quản lý');
		$this->temp['data']['items'] = $items;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/keywords/index';
		$this->render();
	}

	private function getConditions()
	{
		$modelDbSetting = BusinessKeyword::getModel();
		$filterArr = array('status_api', 'uid', 'email', 'keyword');
		$filterConditions = $this->input->get($filterArr, TRUE);
		$conditions = array();
		foreach ($filterConditions as $key => $condition) {
			if ($key === 'keyword') {
				$conditions[] = $this->getSimpleSearchCondition($modelDbSetting::tableName() . '.phone');
			} elseif ($condition === '0' || $condition) {
				$conditions[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $condition);
			}
		}
		return $conditions;
	}

	public function create()
	{
		$model = BusinessKeyword::getModel();
		$item = Common::getFieldObj($model::$fields);
		$item->id = 0;
		$this->temp['data']['item'] = $item;
		$this->setBreadcrumbs('Thêm bài viết', 'Quản lý');
		$this->temp['template'] = 'backend/keywords/update';
		$this->render();
	}

	public function update($id)
	{
		$item = BusinessKeyword::getInstance()->findOneCache($id);
		$this->temp['data']['item'] = $item;
		$this->setBreadcrumbs('Cập nhật bài viết', 'Quản lý');
		$this->temp['template'] = 'backend/keywords/update';
		$this->render();
	}


	public function save()
	{
		$model = BusinessKeyword::getModel();
		$data = $this->input->post($model::$fields, TRUE);
		$id = $this->input->post('id', TRUE);

		if ($_POST && $data) {
			if ($id > 0) {

				$data['updated_date'] = date('Y-m-d H:i:s');
				$res = BusinessKeyword::getInstance()->update($id, $data, TRUE);
			} else {
				$data['created_date'] = date('Y-m-d H:i:s');
				$data['status'] = STATUS_ACTIVE;
				$res = BusinessKeyword::getInstance()->save($data, TRUE);
			}
			$this->result = $res;
			$this->response();
		}
	}

	public function delete($id)
	{
		$item = BusinessKeyword::getInstance()->findOne($id);
		if ($item) {
			$res = BusinessKeyword::getInstance()->delete($id, []);
			$this->result = $res;
			$this->response();
		}
	}
}
