<?php

use app\common\utilities\Common;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessItem;
use app\common\business\BusinessSocialItem;
use app\common\components\Upload;

class Items extends BackendController
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
		$items = BusinessItem::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
		$total = BusinessItem::getInstance()->getCount($conditions);
		$pagination = Pagination::bootstrap($total, '', $itemPerPage, 'page', '3');
		$this->setBreadcrumbs('Danh sách items', 'Quản lý');
		$this->temp['data']['total'] = $total;
		$this->temp['data']['items'] = $items;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/items/index';
		$this->render();
	}

	private function getConditions()
	{
		$modelDbSetting = BusinessItem::getModel();
		$filterArr = array('post_id', 'uid', 'type', 'keyword', 'status');
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

	public function create()
	{
		$model = BusinessItem::getModel();
		$item = Common::getFieldObj($model::$fields);
		$item->id = 0;
		$this->temp['data']['item'] = $item;
		// $this->setBreadcrumbs('Thêm bài viết', 'Quản lý');
		$socialItems = BusinessSocialItem::getInstance()->getRangeCache([], 0, 10000, 'id DESC');
		$this->temp['data']['socialItems'] = $socialItems;
		$this->temp['template'] = 'backend/items/update';
		$this->render();
	}

	public function update($id)
	{
		$item = BusinessItem::getInstance()->findOneCache($id);
		$socialItems =  BusinessSocialItem::getInstance()->getRangeCache([], 0, 10000, 'id DESC');
		$this->temp['data']['socialItems'] = $socialItems;
		$this->temp['data']['item'] = $item;
		$this->setBreadcrumbs('Cập nhật bài viết', 'Quản lý');
		$this->temp['template'] = 'backend/items/update';
		$this->render();
	}

	public function deactive($id)
	{
		$item = BusinessItem::getInstance()->findOneCache($id);
		if ($item) {
			BusinessItem::getInstance()->update($id, ['status' => STATUS_DEACTIVE], FALSE);
			redirect('/backend/items');
		}
	}

	public function active($id)
	{
		$item = BusinessItem::getInstance()->findOneCache($id);
		if ($item) {
			BusinessItem::getInstance()->update($id, ['status' => STATUS_ACTIVE], FALSE);
			redirect('/backend/items');
		}
	}

	public function save()
	{
		$model = BusinessItem::getModel();
		$data = $this->input->post($model::$fields, TRUE);
		unset($data['status']);
		$id = $this->input->post('id', TRUE);

		if ($_POST && $data) {
			$objImage = Upload::isEmpty('image');

			if (!$objImage) {
				$image = BusinessItem::getInstance()->upload('image');
				if (!empty($image['file_path'])) {
					$data['image_url'] = $image['file_path'];
				} else {
					$res['validation']['image'] = $image['error_message'];
					$this->response($res);
				}
			}

			if ($id > 0) {

				$data['updated_date'] = date('Y-m-d H:i:s');
				$res = BusinessItem::getInstance()->update($id, $data, TRUE);
			} else {
				// $data['total_like'] = 0;
				// $data['total_share'] = 0;
				$data['craw_date'] = date('Y-m-d H:i:s');
				$data['status'] = STATUS_ACTIVE;
				$res = BusinessItem::getInstance()->save($data, TRUE);
			}
			$this->result = $res;
			$this->response();
		}
	}

	public function delete($id)
	{
		$item = BusinessItem::getInstance()->findOne($id);
		if ($item) {
			$res = BusinessItem::getInstance()->delete($id, []);
			$this->result = $res;
			$this->response();
		}
	}


	public function clear_cache()
	{

		BusinessItem::getModel()->clearCache();
	}
}
