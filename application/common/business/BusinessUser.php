<?php

namespace app\common\business;

use app\models\User;

class BusinessUser implements BusinessInterface
{
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessUser object
	 */
	static public function getInstance()
	{
		if (self::$_instance === NULL) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * get model instance
	 * @param mixed $data
	 * @return User $model
	 */
	public static function getModel($data = array())
	{
		$model = User::getInstance();
		return $model;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOneCache($id)
	{
		$query = User::getInstance()->findOne(array('id' => $id));
		$nameCache = 'findOne_' . $id;
		return User::queryBuilder($nameCache, $query, TRUE);
	}

	/**
	 * find one by id
	 * @param $id
	 * @return  Object
	 */
	public function findOne($id)
	{
		return User::getInstance()->findOne(array('id' => $id))->get()->row();
	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = User::getInstance()->find()->where($conditions);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = User::queryBuilder($nameCache, $query, $row);
		return $res;
	}


	public function getByIdAsArray($id)
	{
		return User::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = User::getInstance()->findByMultipleId($ids);
		$dbDatas = User::queryBuilder($name, $query, FALSE);
		$ret = array();
		if ($dbDatas) {
			foreach ($dbDatas as $dbData) {
				$ret[$dbData['id']] = $dbData;
			}
		}
		return $ret;
	}

	public function save($data = array(), $runValidation = TRUE)
	{
		$validation = $this->validateForm($data);
		if (($validation['validation'])) {
			return $validation;
		}
		User::getInstance()->save($data);
		$res = array(
			'success' => TRUE,
			'message' => 'Tạo nhân viên mới thành công'
		);
		return $res;
	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		if ($runValidation === TRUE) {
			$validation = $this->validateForm($data);
			$oldUser = $this->findOne($id);
			if ($oldUser && $oldUser->email === $data['email']) {
				unset($validation['validation']['email']);
			}

			if ($validation['validation']) {
				return $validation;
			}
			if (empty($data['password'])) {
				unset($data['password']);
			}
		}
		User::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Cập nhật nhân viên thành công'
		);
		return $res;
	}
	private function validateForm($data)
	{
		$validation = User::getInstance()->validateForm($data);
		if ($data['email']) {
			$user = $this->findByEmail($data['email']);
			if ($user) {
				$validation['validation']['email'] = 'Email đã tồn tại ';
			}
		}
		return $validation;
	}

	public function delete($id, $data)
	{
		User::getInstance()->delete($id, []);
		//User::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Xóa thành công'
		);
		return $res;
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$dbObj = User::getInstance()->find();
		if ($itemPerPage) {
			$dbObj->limit($itemPerPage);
		}
		$dbObj->order_by('created_date', 'DESC');
		if ($orderBy) {
			$dbObj->order_by($orderBy);
		}
		$dbObj = User::getInstance()->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return User::queryBuilder($name, $dbObj, FALSE);
	}

	public function getCount($conditions = array())
	{
		$dbObj = User::getInstance()->find();
		$dbObj = User::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj->count_all_results();
	}

	public function findByEmail($email)
	{
		$query = User::getInstance()->findByEmail($email);
		$nameCache = 'findByEmail_' . $email;
		$res = User::getInstance()->queryBuilder($nameCache, $query, TRUE);
		return $res;
	}

	public function checkAuth($email, $password)
	{
		$user = $this->findByEmail($email);
		if (empty($user)) {
			return NULL;
		}
		$isSuccess = password_verify($password, $user->password);
		if ($isSuccess) {
			return $user;
		}
		return NULL;
	}

	public function getUserSession()
	{
		$res = User::getInstance()->getAuthSession();
		return $res;
	}

	public function setUserSession($userInfo)
	{
		User::getInstance()->setAuthSession($userInfo);
		return TRUE;
	}

	public function findByConditionsCache($conditions)
	{
		$name = 'findByConditionsCache' . http_build_query($conditions);
		$dbObj = User::findByConditions($conditions);
		$res = User::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

	public function findByRoleIds($roleIds)
	{
		$name = 'findByConditionsCache' . http_build_query($roleIds);
		$dbObj = User::getInstance()->find()->where_in('role_id', $roleIds);
		$res = User::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}
	public function register($data = array())
	{
		$user = User::getInstance()->getByIdAsArray(array('email' => $data['email']));
		if ($user) {
			return false;
		} else {
			User::getInstance()->save($data);
			return true;
		}
	}
}
