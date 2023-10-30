<?php

namespace app\common\business;

use app\common\components\Upload;
use app\models\Socialtem;

class BusinessSocialItem implements BusinessInterface {
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessSocialItem object
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
	 * @return Socialtem $model
	 */
	public static function getModel($data = array())
	{
		$model = Socialtem::getInstance();
		return $model;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOneCache($id)
	{
		$query = Socialtem::getInstance()->findOne(array('id' => $id));
		$nameCache = 'findOne_' . $id;
		return Socialtem::queryBuilder($nameCache, $query, TRUE);
	}

	/**
	 * find one by id
	 * @param $id
	 * @return  Object
	 */
	public function findOne($id)
	{
		return Socialtem::getInstance()->findOne(array('id' => $id))->get()->row();

	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = Socialtem::getInstance()->find()->where($conditions);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = Socialtem::queryBuilder($nameCache, $query, $row);
		return $res;
	}


	public function getByIdAsArray($id)
	{
		return Socialtem::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = Socialtem::getInstance()->findByMultipleId($ids);
		$dbDatas = Socialtem::queryBuilder($name, $query, FALSE);
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
		Socialtem::getInstance()->save($data);
		$res = array(
			'success' => TRUE,
			'message' => 'Create new social successfully'
		);
		return $res;
	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		if($runValidation){
			$validation = $this->validateForm($data);
			$oldItem = $this->findOne($id);
			if ($oldItem && $oldItem->social_id === $data['social_id'])
			{
				unset($validation['validation']['social_id']);
			}
			if ($validation['validation'])
			{
				return $validation;
			}
		}
		Socialtem::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Successful Social update'
		);
		return $res;
	}

	private function validateForm($data)
	{
		$validation = Socialtem::getInstance()->validateForm($data);

		if(isset($data['social_id'])){
			$uid = $this->findByConditions(['social_id'=>  $data['social_id'],'channel_type' => $data['channel_type']]);
			if ($uid)
			{
				$validation['validation']['social_id'] = 'Social id already exists ';
			}
		}
		return $validation;
	}

	public function delete($id, $data)
	{
		//User::getInstance()->delete($id);
		Socialtem::getInstance()->delete($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Deleted successfully'
		);
		return $res;
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		$dbObj = Socialtem::getInstance()->find();
		if ($itemPerPage)
		{
			$dbObj->limit($itemPerPage);
		}
		if ($orderBy)
		{
			$dbObj->order_by($orderBy);
		}
		$dbObj = Socialtem::getInstance()->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return Socialtem::queryBuilder($name, $dbObj, FALSE);
	}

	public function getCount($conditions = array())
	{
		$dbObj = Socialtem::getInstance()->find();
		$dbObj = Socialtem::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj->count_all_results();

	}

	public function findByEmail($email)
	{
		$query = Socialtem::getInstance()->findByEmail($email);
		$nameCache = 'findByEmail_' . $email;
		$res = Socialtem::getInstance()->queryBuilder($nameCache, $query, TRUE);
		return $res;
	}

	public function findBySocialId($socialId)
	{
		$query = Socialtem::getInstance()->find()->where('social_id',$socialId);
		$nameCache = 'findBySocialId' . $socialId;
		return Socialtem::getInstance()->queryBuilder($nameCache, $query, TRUE);
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
		$dbObj = Socialtem::findByConditions($conditions);
		$res = Socialtem::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}
	public function findByRoleIds($roleIds)
	{
		$name = 'findByConditionsCache' . http_build_query($roleIds);
		$dbObj = Socialtem::getInstance()->find()->where_in('role_id', $roleIds);
		$res = Socialtem::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

	public function validateData($datas)
	{
		$validate = array();
		if ($datas) {
			foreach ($datas as $index => $data) {
				$validation = Item::getInstance()->validateForm($data);
				if (($validation['validation']))
				{
					foreach ($validation['validation'] as $key => $val){
						$validate[sprintf('interactive[%s][%s]', $index,$key)]  = $val;
					}
				}
			}
		}$res['validate'] = $validate;
		return $res;
	}


	public function upload($attributeName, $estatesId = null)
	{
		$data = array();
		if(!Upload::isEmpty($attributeName)){
			$imagesInfo = Upload::getFileObjByAttributeName($attributeName);
			if ($imagesInfo ) {
				$fileData = Upload::uploadMultipleFile($imagesInfo, UPLOAD_BASE_IMAGES);
				if ($fileData['error'] === 0) {//if error
					$data = array(
						'file_path' => $fileData['file_path']
					);
				} else {
					$data['error_message'] = $fileData['message'];
				}
			}
		}
		return $data;
	}


}