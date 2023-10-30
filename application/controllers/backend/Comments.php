<?php

use app\common\utilities\Common;
use app\controllers\backend\BackendController;
use app\common\business\BusinessComment;
use app\common\business\BusinessKeyword;
use app\common\business\BusinessCommentLog;
class Comments extends BackendController {


	public function __construct()
	{
		parent::__construct();
		$this->temp['layout'] = '/backend/clients/layout';
	}
	public function index()
	{
		$itemPerPage = DEFAULT_ITEM_PER_PAGE;
		$conditions = $this->getConditions();
		$page = intval($this->input->get('page', TRUE));
		$offset = $page ? $itemPerPage * ($page - 1) : 0;
		$items = BusinessComment::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
		$total = BusinessComment::getInstance()->getCount($conditions);
		$pagination = $this->pagination($total,$itemPerPage);
		$this->setBreadcrumbs('Danh sách Comments', 'Quản lý');
		$this->temp['page_title'] = 'Danh sách Comments';
		$this->temp['data']['items'] = $items;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/comments/index';
		$this->render();
	}

	private function getConditions()
	{
		$modelDbSetting = BusinessComment::getModel();
		$filterArr = array('keywords');
		$filterConditions = $this->input->get($filterArr, TRUE);
		$conditions = array();
		foreach ($filterConditions as $key => $condition)
		{
			if ( $condition)
			{
				if ($key === 'keyword')
				{
					foreach ($condition as $item)
					{
						$conditions[0][] = getSimpleSearchCondition($modelDbSetting::tableName().'.keywords', $item);
					}
				}
				$conditions[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $condition);
			}
		}
		$this->temp['data']['filters'] = $filterConditions;
		return $conditions;
	}

	public function create()
	{
		$model = BusinessComment::getModel();
		$item = Common::getFieldObj($model::$fields);
		$keyword = BusinessKeyword::getInstance()->findByConditions([],TRUE);
		$item->id = 0;
		$this->temp['data']['item'] = $item;
		$this->temp['data']['keyword'] = $keyword;
		$this->setBreadcrumbs('Thêm Comments', 'Quản lý');
		$this->temp['page_title'] = 'Tạo Comments';
		$this->temp['template'] = 'backend/comments/update';
		$this->render();
	}

	public function update($id)
	{
		$item = BusinessComment::getInstance()->findOneCache($id);
		$this->temp['data']['item'] = $item;
		$keyword = BusinessKeyword::getInstance()->findByConditions([],TRUE);
		$this->temp['data']['keyword'] = $keyword;
		$this->setBreadcrumbs('Cập nhật Xpath', 'Quản lý');
		$this->temp['page_title'] = 'Cập nhật Comments';

		$this->temp['template'] = 'backend/comments/update';
		$this->render();
	}


	public function save()
	{
		$model = BusinessComment::getModel();
		$data = $this->input->post($model::$fields,TRUE);
		unset($data['status']);
		$id = $this->input->post('id', TRUE);

		if ($_POST && $data)
		{
			$data['type'] = (int)$data['type'];
			$data['from'] = (int)$data['from'];
			$data['to'] = (int)$data['to'];
			if ($id > 0)
			{
				$data['updated_date'] = date('Y-m-d H:i:s');
				$data['updated_by'] = $this->userInfo['id'];
				$res = BusinessComment::getInstance()->update($id, $data, TRUE);
			} else
			{
				$data['created_date'] = date('Y-m-d H:i:s');
				$data['created_by'] = $this->userInfo['id'];
				$data['status'] = STATUS_ACTIVE;
				$res = BusinessComment::getInstance()->save($data, TRUE);
			}
			$this->result = $res;
			$this->response();
		}
	}

	public function delete($id)
	{
		$item = BusinessComment::getInstance()->findOne($id);
		if ($item)
		{
			$res = BusinessComment::getInstance()->delete($id, []);
			$this->result = $res;
			redirect('/backend/comments');

//			$this->response();
		}
	}


	public function deactive($id)
	{
		$item = BusinessComment::getInstance()->findOneCache($id);
		if($item){
			BusinessComment::getModel()->update($id, ['status' => STATUS_DEACTIVE], FALSE);
			\app\common\business\BusinessCommentLog::getModel()->clearCache();
			redirect('/backend/comments');
		}
	}
	public function active($id)
	{
		$item = BusinessComment::getInstance()->findOneCache($id);
		if($item){
			BusinessComment::getModel()->update($id, ['status' => STATUS_ACTIVE], FALSE);
			\app\common\business\BusinessCommentLog::getModel()->clearCache();

			redirect('/backend/comments');
		}
	}

	public function detail($commentId){
		$itemPerPage = DEFAULT_ITEM_PER_PAGE;
		$comment = BusinessComment::getInstance()->findOne($commentId);
		$status = $this->input->get('status',TRUE);
		$conditions['comment_logs.comment_id'] = $commentId;
		if($status || $status === '0'){
			$conditions['comment_logs.status'] = $status;
		}
		$page = intval($this->input->get('page', TRUE));
		$offset = $page ? $itemPerPage * ($page - 1) : 0;
		$items = BusinessCommentLog::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
		$total = BusinessCommentLog::getInstance()->getCount($conditions);
		$pagination = $this->pagination($total,$itemPerPage);
		$this->setBreadcrumbs('Danh sách Comments', 'Quản lý');
		$this->temp['page_title'] = 'Danh sách Comments';
		$this->temp['data']['items'] = $items;
		$this->temp['data']['comment'] = $comment;
		$this->temp['data']['filterStatus'] = $status;
		$this->temp['data']['pagination'] = $pagination;
		$this->temp['template'] = 'backend/comments/detail';
		$this->render();
	}

}