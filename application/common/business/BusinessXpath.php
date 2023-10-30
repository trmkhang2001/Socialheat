<?php

namespace app\common\business;

use app\common\components\Upload;
use app\models\Xpath;

class BusinessXpath implements BusinessInterface {
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessXpath object
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
	 * @return Xpath $model
	 */
	public static function getModel($data = array())
	{
		$model = Xpath::getInstance();
		return $model;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOneCache($id)
	{
		$query = Xpath::getInstance()->findOne(array('id' => $id));
		$nameCache = 'findOne_' . $id;
		return Xpath::queryBuilder($nameCache, $query, TRUE);
	}

	/**
	 * find one by id
	 * @param $id
	 * @return  Object
	 */
	public function findOne($id)
	{
		return Xpath::getInstance()->findOne(array('id' => $id))->get()->row();

	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = Xpath::getInstance()->find()->where($conditions);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = Xpath::queryBuilder($nameCache, $query, $row);
		return $res;
	}

	public function getByIdAsArray($id)
	{
		return Xpath::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = Xpath::getInstance()->findByMultipleId($ids);
		$dbDatas = Xpath::queryBuilder($name, $query, FALSE);
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
		Xpath::getInstance()->save($data);
		$res = array(
			'success' => TRUE,
			'message' => 'Tạo Xpath mới thành công'
		);
		return $res;
	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		if($runValidation){
			$validation =  $this->validateForm($data);
			$oldItem = $this->findOne($id);
			if ($oldItem && $oldItem->channel_type === $data['channel_type'] && $oldItem->type === $data['type']);
			{
				unset($validation['validation']['type']);
			}
		}
		Xpath::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Cập nhật Xpath thành công'
		);
		return $res;
	}

	private function validateForm($data)
	{
		$validation = Xpath::getInstance()->validateForm($data);

		if($data['type']){

			$item = $this->findByConditions(['channel_type' => $data['channel_type'],'type' => $data['type']],TRUE);

			if ($item)
			{
				$validation['validation']['type'] = 'Xpath đã tồn tại ';
			}
		}
		return $validation;
	}

	public function delete($id, $data)
	{
		//User::getInstance()->delete($id);
		Xpath::getInstance()->delete($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Xóa thành công'
		);
		return $res;
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$dbObj = Xpath::getInstance()->find();
		if ($itemPerPage)
		{
			$dbObj->limit($itemPerPage);
		}
		if ($orderBy)
		{
			$dbObj->order_by($orderBy);
		}
		$dbObj = Xpath::getInstance()->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return Xpath::queryBuilder($name, $dbObj, FALSE);
	}

	public function getCount($conditions = array())
	{
		$dbObj = Xpath::getInstance()->find();
		$dbObj = Xpath::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj->count_all_results();

	}

	public function findByEmail($email)
	{
		$query = Xpath::getInstance()->findByEmail($email);
		$nameCache = 'findByEmail_' . $email;
		$res = Xpath::getInstance()->queryBuilder($nameCache, $query, TRUE);
		return $res;
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



	public function findByConditionsCache($conditions)
	{
		$name = 'findByConditionsCache' . http_build_query($conditions);
		$dbObj = Xpath::getInstance()->findByConditions($conditions);
		$res = Xpath::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

	public function findByRoleIds($roleIds)
	{
		$name = 'findByConditionsCache' . http_build_query($roleIds);
		$dbObj = Xpath::getInstance()->find()->where_in('role_id', $roleIds);
		$res = Xpath::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

}