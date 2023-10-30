<?php

namespace app\common\business;

use app\models\Comment;
use app\models\CommentLog;
use app\models\Item;

class BusinessComment implements BusinessInterface {
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessComment object
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
	 * @return Comment $model
	 */
	public static function getModel($data = array())
	{
		$model = Comment::getInstance();
		return $model;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOneCache($id)
	{
		$query = Comment::getInstance()->findOne(array('id' => $id));
		$nameCache = 'findOne_' . $id;
		return Comment::queryBuilder($nameCache, $query, TRUE);
	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = Comment::getInstance()->find()->where($conditions);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = Comment::queryBuilder($nameCache, $query, $row);
		return $res;
	}

	public function getByIdAsArray($id)
	{
		return Comment::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = Comment::getInstance()->findByMultipleId($ids);
		$dbDatas = Comment::queryBuilder($name, $query, FALSE);
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
		if ($runValidation)
		{
			$validation = $this->validateForm($data);
			if ($validation['validation'])
			{
				return $validation;
			}
		}
		$conditions = getSimpleSearchCondition(Item::tableName() . '.keywords', $data['keywords']);
		try
		{
			trans_begin();
			$commentId = Comment::getInstance()->save($data);
			$conditions[]['craw_date <= '] = date('Y-m-d H:i:s');
			if ($data['from'])
			{
				$conditions['interaction']['from'] = $data['from'];

			}
			if( $data['to']){
				$conditions['interaction']['to'] = $data['to'];

			}
			if ($data['type'])
			{
				$conditions[]['items.type'] = $data['type'];
			}
			$total = BusinessCommentLog::getInstance()->saveDataPostByKeywords($conditions, $commentId);
			if (count($total))
			{
				Comment::getInstance()->update($commentId, ['total_post' => json_encode($total)], TRUE, FALSE);
			}
			trans_end();
			Comment::clearCache();
		} catch (\Exception $e)
		{
			trans_rollback();
			echo "<pre>";
			print_r($e->getMessage());
			die;
		}

		$res = array(
			'success' => TRUE,
			'message' => 'Tạo Comment mới thành công'
		);
		return $res;
	}

	private function validateForm($data)
	{
		return Comment::getInstance()->validateForm($data);

	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		if ($runValidation)
		{
			$validation = $this->validateForm($data);
			if ($validation['validation'])
			{
				return $validation;
			}
		}
		$comment = $this->findOne($id);
		$conditions = getSimpleSearchCondition(Item::tableName() . '.keywords', $data['keywords']);
		try
		{
			trans_begin();
			$conditions[]['craw_date <= '] = $comment->created_date;
			if ($data['from'])
			{
				$conditions['interaction']['from'] = $data['from'];

			}
			if( $data['to']){
				$conditions['interaction']['to'] = $data['to'];

			}
			if ($data['type'])
			{
				$conditions[]['items.type'] = $data['type'];
			}
			CommentLog::deleteBatch(['comment_id' => $id, 'status' => COMMENT_REPORT_STATUS_PENDING]);
			$total = BusinessCommentLog::getInstance()->saveDataPostByKeywords($conditions, $id);
			if ($total)
			{
				$data['total_post'] = json_encode($total);
			}
			Comment::getInstance()->update($id, $data, TRUE, FALSE);
			trans_end();
			Comment::clearCache();
		} catch (\Exception $e)
		{
			trans_rollback();
			echo "<pre>";
			print_r($e->getMessage());
			die;
		}
		$res = array(
			'success' => TRUE,
			'message' => 'Cập nhật Comment thành công'
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
		return Comment::getInstance()->findOne(array('id' => $id))->get()->row();

	}

	public function delete($id, $data)
	{
		//User::getInstance()->delete($id);
		try
		{
			trans_begin();
			Comment::getInstance()->delete($id, $data);
			CommentLog::deleteBatch(['comment_id', $id]);
			trans_end();
		} catch (\Exception $e)
		{
			trans_rollback();
			echo "<pre>";
			print_r($e->getMessage());
			die;
		}

		$res = array(
			'success' => TRUE,
			'message' => 'Xóa Comment thành công'
		);
		return $res;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return Comment::queryBuilder($name, $dbObj, FALSE);
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$dbObj = Comment::getInstance()->find()->select('*,
		(select count(id) from comment_logs where status = 1 and comment_id = comments.id) as number_success,
		(select count(id) from comment_logs where status = 2 and comment_id = comments.id ) as number_error,
		(select count(id) from comment_logs where status = 0 and comment_id = comments.id) as number_pending');
		if ($itemPerPage)
		{
			$dbObj->limit($itemPerPage);
		}
		if ($orderBy)
		{
			$dbObj->order_by($orderBy);
		}
		$dbObj = Comment::getInstance()->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getCount($conditions = array())
	{
		$dbObj = Comment::getInstance()->find();
		$dbObj = Comment::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj->count_all_results();

	}

	public function checkAuth($email, $password)
	{
		$user = $this->findByEmail($email);
		if (empty($user))
		{
			return NULL;
		}
		$isSuccess = password_verify($password, $user->password);
		if ($isSuccess)
		{
			return $user;
		}
		return NULL;
	}

	public function findByEmail($email)
	{
		$query = Comment::getInstance()->findByEmail($email);
		$nameCache = 'findByEmail_' . $email;
		$res = Comment::getInstance()->queryBuilder($nameCache, $query, TRUE);
		return $res;
	}

	public function findByConditionsCache($conditions)
	{
		$name = 'findByConditionsCache' . http_build_query($conditions);
		$dbObj = Comment::getInstance()->findByConditions($conditions);
		$res = Comment::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

	public function findByRoleIds($roleIds)
	{
		$name = 'findByConditionsCache' . http_build_query($roleIds);
		$dbObj = Comment::getInstance()->find()->where_in('role_id', $roleIds);
		$res = Comment::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

}