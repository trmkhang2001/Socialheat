<?php

namespace app\common\business;

use app\models\Comment;
use app\models\CommentLog;

class BusinessCommentLog implements BusinessInterface {
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessCommentLog object
	 */
	static public function getInstance()
	{
		if (self::$_instance === NULL)
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * get model instance
	 * @param mixed $data
	 * @return CommentLog $model
	 */
	public static function getModel($data = array())
	{
		$model = CommentLog::getInstance();
		return $model;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOneCache($id)
	{
		$query = CommentLog::getInstance()->findOne(array('id' => $id));
		$nameCache = 'findOne_' . $id;
		return CommentLog::queryBuilder($nameCache, $query, TRUE);
	}

	public function getByIdAsArray($id)
	{
		return CommentLog::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = CommentLog::getInstance()->findByMultipleId($ids);
		$dbDatas = CommentLog::queryBuilder($name, $query, FALSE);
		$ret = array();
		if ($dbDatas)
		{
			foreach ($dbDatas as $dbData)
			{
				$ret[$dbData['id']] = $dbData;
			}
		}
		return $ret;
	}

	public function save($data = array(), $runValidation = TRUE)
	{
		$validation = $this->validateForm($data);
		if (($validation['validation']))
		{
			return $validation;
		}
		CommentLog::getInstance()->save($data);
		$res = array(
			'success' => TRUE,
			'message' => 'Tạo Xpath mới thành công'
		);
		return $res;
	}

	private function validateForm($data)
	{
		$validation = CommentLog::getInstance()->validateForm($data);

		if ($data['type'])
		{

			$item = $this->findByConditions(['channel_type' => $data['channel_type'], 'type' => $data['type']], TRUE);

			if ($item)
			{
				$validation['validation']['type'] = 'CommentLog đã tồn tại ';
			}
		}
		return $validation;
	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = CommentLog::getInstance()->find()->where($conditions);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = CommentLog::queryBuilder($nameCache, $query, $row);
		return $res;
	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		if ($runValidation)
		{
			$validation = $this->validateForm($data);
			$oldItem = $this->findOne($id);
			if ($oldItem && $oldItem->channel_type === $data['channel_type'] && $oldItem->type === $data['type']) ;
			{
				unset($validation['validation']['type']);
			}
		}
		CommentLog::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Cập nhật Xpath thành công'
		);
		return $res;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return  Object
	 */
	public function findOne($id)
	{
		return CommentLog::getInstance()->findOne(array('id' => $id))->get()->row();

	}

	public function delete($id, $data)
	{
		//User::getInstance()->delete($id);
		CommentLog::getInstance()->delete($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Xóa thành công'
		);
		return $res;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return CommentLog::queryBuilder($name, $dbObj, FALSE);
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$tableComment = Comment::tableName();
		$tableCommentLog = CommentLog::tableName();
		/**
		 * @var  $dbObj \CI_DB_query_builder
		 */
		$dbObj = CommentLog::getInstance()->find(FALSE)
			->select($tableCommentLog . '.*,' . $tableComment . '.comment,' .
				"(select post_url from items where post_id = comment_logs.post_id limit 1) as post_url,
			(select type from items where post_id = comment_logs.post_id limit 1) as type
			"
			)
			->join($tableComment, $tableComment . '.id =' . $tableCommentLog . '.comment_id')
			->where($tableComment . '.status', STATUS_ACTIVE);
		if ($itemPerPage)
		{
			$dbObj->limit($itemPerPage);
		}
		if ($orderBy)
		{
			$dbObj->order_by($orderBy);
		}
		$dbObj->group_by($tableCommentLog . '.post_id');
		$dbObj = CommentLog::getInstance()->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getCount($conditions = array())
	{
		$tableComment = Comment::tableName();
		$tableCommentLog = CommentLog::tableName();
		$dbObj = CommentLog::getInstance()->find(FALSE)
			->select($tableCommentLog . '.*,' . $tableComment . '.comment')
			->join($tableComment, $tableComment . '.id =' . $tableCommentLog . '.comment_id')
			->where($tableComment . '.status', STATUS_ACTIVE);
		$dbObj->group_by($tableCommentLog . '.post_id');
		$dbObj = CommentLog::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj->count_all_results();

	}

	public function findByConditionsCache($conditions)
	{
		$name = 'findByConditionsCache' . http_build_query($conditions);
		$dbObj = CommentLog::getInstance()->findByConditions($conditions);
		$res = CommentLog::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}


	/**
	 * @param $conditions
	 * @param $commentId
	 * @return array
	 */
	public function saveDataPostByKeywords($conditions, $commentId): array
	{
		$havingCount = [];
		if ( !empty($conditions['interaction']['from']))
		{
			$havingCount['from'] = $conditions['interaction']['from'];
		}
		if ( !empty($conditions['interaction']['to']))
		{
			$havingCount['to'] = $conditions['interaction']['to'];
		}
		unset($conditions['interaction']);
		$items = BusinessItem::getInstance()->findByConditionsVsGroupBy($conditions, $havingCount);
		$total = [];
		if ($items)
		{
			$dataCommentLogs = [];
			foreach ($items as $item)
			{
				$dataCommentLogs[] = [
					'comment_id'    => $commentId,
					'item_id'       => $item->id,
					'post_id'       => $item->post_id,
					'created_date'  => date('Y-m-d H:i:s'),
					'channel_type'  => $item->channel_type,
					'post_owner_id' => $item->post_owner_id,
					'type'          => $item->type
				];
				if ( ! isset($total[$item->channel_type]))
				{
					$total[$item->channel_type] = 1;
				} else
				{
					++$total[$item->channel_type];
				}
			}
			CommentLog::insertBatch($dataCommentLogs);
		}
		return $total;
	}

}