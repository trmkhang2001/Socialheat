<?php

namespace app\common\business;

use app\models\Client;
use app\models\Log;

class BusinessLogs implements BusinessInterface {
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessLogs object
	 */
	public static function getInstance()
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
	 * @return Log $model
	 */
	public static function getModel($data = array())
	{
		return Log::getInstance();
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOne($id)
	{
		return Log::getInstance()->findOne(array('id' => $id))->get()->row();
	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = Log::getInstance()->find()->where($conditions);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = Log::queryBuilder($nameCache, $query, $row);
		return $res;
	}


	public function getByIdAsArray($id)
	{
		return Log::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = Log::getInstance()->findByMultipleId($ids);
		$dbDatas = Log::queryBuilder($name, $query, FALSE);
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
		$id = Log::getInstance()->save($data);
		return $id;

	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		$client = $this->findOne($id);
		$id = Log::getInstance()->update($id, $data);
		return $id;
	}

	public function delete($id, $data)
	{
		Log::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Xóa thành công'
		);
		return $res;
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$dbObj = Log::getInstance()->find();
		$dbObj->select('client_logs.*,count(client_logs.id) as number,clients.name as client_name');
		if ($itemPerPage)
		{
			$dbObj->limit($itemPerPage);
		}
		if ($orderBy)
		{
			$dbObj->order_by($orderBy);
		}
		$dbObj->join('clients','clients.id = client_logs.client_id','inner');
		if ($conditions !== NULL)
		{
			if (isset($conditions[0]) && is_array($conditions[0]))
			{
				foreach ($conditions as $condition)
				{
					if (isset($condition[0]) && is_array($condition))
					{
						foreach ($condition as $c)
						{
							$dbObj->or_where($c);
						}
					} else
					{
						$dbObj->where($condition);
					}
				}
			} else
			{
				$dbObj->where($conditions);
			}
		}
		$dbObj->offset($offset);
		$dbObj->group_by('client_logs.client_id','ASC');
		$dbObj->group_by('DAY(client_logs.created_date)','ASC');
		return $dbObj;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return Log::queryBuilder($name, $dbObj, FALSE);
	}

	public function getCount($conditions = array())
	{
		$dbObj = Log::getInstance()->find();
		$dbObj->select('client_logs.id as id');
		$dbObj->join('clients','clients.id = client_logs.client_id','inner');
		if ($conditions !== NULL)
		{
			if (isset($conditions[0]) && is_array($conditions[0]))
			{
				foreach ($conditions as $condition)
				{
					if (isset($condition[0]) && is_array($condition))
					{
						foreach ($condition as $c)
						{
							$dbObj->or_where($c);
						}
					} else
					{
						$dbObj->where($condition);
					}
				}
			} else
			{
				$dbObj->where($conditions);
			}
		}
		$dbObj->group_by('client_logs.client_id','ASC');
		$dbObj->group_by('DAY(client_logs.created_date)','ASC');
		$res = $dbObj->count_all_results();
		return $res;

	}

	public function findByConditionsCache($conditions)
	{
		$name = 'findByConditionsCache' . http_build_query($conditions);
		$dbObj = Log::findByConditions($conditions);
		$res = Log::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

	public function saveLogs($data, $listKey, $client_id, $type = 'phone')
	{
		$logs = [];
		foreach ($data as $value)
		{
			$logs[] = [
				'client_id'       => $client_id,
				'type'            => $type,
				'key'             => $value[$type],
				'created_date'    => date('Y-m-d H:i:s'),
				'status'          => STATUS_ACTIVE,
				'additional_data' => $listKey
			];
		}
		Log::getInstance()->insertBatch($logs);
		$numberQuery = count($data);
		$client = BusinessClient::getInstance()->findOne($client_id);
		$queryTotal = (int)$client->query_total + (int)$numberQuery;
		Client::getInstance()->update($client_id,['query_total' => $queryTotal]);
	}

}