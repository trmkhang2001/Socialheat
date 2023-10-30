<?php

namespace app\common\business;

use app\common\components\Upload;
use app\models\Keyword;

class BusinessKeyword implements BusinessInterface {
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessKeyword object
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
	 * @return Keyword $model
	 */
	public static function getModel($data = array())
	{
		$model = Keyword::getInstance();
		return $model;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOneCache($id)
	{
		$query = Keyword::getInstance()->findOne(array('id' => $id));
		$nameCache = 'findOne_' . $id;
		return Keyword::queryBuilder($nameCache, $query, TRUE);
	}

	/**
	 * find one by id
	 * @param $id
	 * @return  Object
	 */
	public function findOne($id)
	{
		return Keyword::getInstance()->findOne(array('id' => $id))->get()->row();

	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = Keyword::getInstance()->find()->where($conditions);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = Keyword::queryBuilder($nameCache, $query, $row);
		return $res;
	}


	public function getByIdAsArray($id)
	{
		return Keyword::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = Keyword::getInstance()->findByMultipleId($ids);
		$dbDatas = Keyword::queryBuilder($name, $query, FALSE);
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
		Keyword::getInstance()->save($data);
		$res = array(
			'success' => TRUE,
			'message' => 'Tạo từ khóa mới thành công'
		);
		return $res;
	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		if($runValidation){
			$validation = $this->validateForm($data);
			if ($validation['validation'])
			{
				return $validation;
			}
		}
		Keyword::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Cập nhật từ khóa thành công'
		);
		return $res;
	}

	private function validateForm($data)
	{
		$validation = Keyword::getInstance()->validateForm($data);
		return $validation;
	}

	public function delete($id, $data)
	{
		//User::getInstance()->delete($id);
		Keyword::getInstance()->delete($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Xóa thành công'
		);
		return $res;
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$dbObj = Keyword::getInstance()->find();
		if ($itemPerPage)
		{
			$dbObj->limit($itemPerPage);
		}
		if ($orderBy)
		{
			$dbObj->order_by($orderBy);
		}
		$dbObj = Keyword::getInstance()->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return Keyword::queryBuilder($name, $dbObj, FALSE);
	}

	public function getAllCache(){
		$name = 'getAll';
		$dbObj = Keyword::getInstance()->find();
		return Keyword::queryBuilder($name, $dbObj, TRUE);
	}

	public function getCount($conditions = array())
	{
		$dbObj = Keyword::getInstance()->find();
		$dbObj = Keyword::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj->count_all_results();

	}

	public function findByEmail($email)
	{
		$query = Keyword::getInstance()->findByEmail($email);
		$nameCache = 'findByEmail_' . $email;
		$res = Keyword::getInstance()->queryBuilder($nameCache, $query, TRUE);
		return $res;
	}



	public function findByConditionsCache($conditions)
	{
		$name = 'findByConditionsCache' . http_build_query($conditions);
		$dbObj = Keyword::findByConditions($conditions);
		$res = Keyword::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

}