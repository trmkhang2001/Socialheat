<?php

namespace app\common\business;

use app\models\Interaction;

class BusinessInteraction implements BusinessInterface
{
	static protected $_instance = NULL;

	static public function getInstance()
	{
		if (self::$_instance === NULL) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * @param array $data
	 * @return Interaction|null
	 */
	public static function getModel($data = array())
	{
		return Interaction::getInstance();
	}

	public function findOne($id)
	{
		$model = Interaction::getInstance()->findOne(array('id' => $id));
		return $model;
	}

	public function findByMultipleId($ids = array())
	{
		// TODO: Implement findByMultipleId() method.
	}

	public function getByIdAsArray($id)
	{
		// TODO: Implement getByIdAsArray() method.
	}

	public function save($data = array(), $runValidation = TRUE)
	{

		// TODO: Implement save() method.
	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		// TODO: Implement update() method.
	}

	public function delete($id, $data)
	{
		// TODO: Implement delete() method.
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{

		$modelInstance = self::getModel();
		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		$dbObj = $modelInstance::find(FALSE)->order_by($orderBy);
		if ($itemPerPage) {
			$dbObj->limit($itemPerPage);
		}
		$dbObj = $modelInstance->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return Interaction::queryBuilder($name, $dbObj, FALSE);
	}


	public function getDataDownload($conditions, $offset, $itemPerPage, $endId)
	{
		$modelInstance = self::getModel();
		$dbObj = $modelInstance::find(FALSE);
		$dbObj = $modelInstance->getConditions($conditions, $dbObj);
		if ($endId) {
			$dbObj->where('id > ', $endId);
		} else {
			$dbObj->offset($offset);
		}
		$dbObj->limit($itemPerPage);
		return $dbObj->get()->result();
	}

	public function getCount($conditions = array(), $alias = '')
	{
		$modelInstance = self::getModel();
		$nameCache = 'getCount' . http_build_query($conditions);
		$res = $modelInstance::getCache($nameCache);
		if ($res) {
			return $res;
		}
		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		if ($alias) {
			$dbObj = $modelInstance::find(FALSE, $alias);
		} else {
			$dbObj = $modelInstance::find(FALSE);
		}

		$dbObj = $modelInstance->getConditions($conditions, $dbObj);
		$number =   $dbObj->count_all_results();
		$modelInstance::setCache($nameCache, $number, 60 * 60 * 24 * 30);
		return  $number;
	}
	// public function getCountPostId($conditions = array(), $postId)
	// {
	// 	$modelInstance = self::getModel();
	// 	$na
	// }
	public function findByConditions($conditions = array())
	{
		$dbObj = Interaction::getInstance()->find(false);
		$dbObj = Interaction::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj;
	}
}
