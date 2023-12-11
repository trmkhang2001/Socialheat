<?php

namespace app\common\business;

use app\common\components\Upload;
use app\models\Crm;

class BusinessCrm implements BusinessInterface
{
    static protected $_instance = NULL;

    /**
     * Use singleton pattern
     *
     * @return BusinessCrm object
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
     * @return Crm $model
     */
    public static function getModel($data = array())
    {
        $model = Crm::getInstance();
        return $model;
    }

    /**
     * find one by id
     * @param $id
     * @return \CI_DB_query_builder Object
     */
    public function findOneCache($id)
    {
        $query = Crm::getInstance()->findOne(array('id' => $id));
        $nameCache = 'findOne_' . $id;
        return Crm::queryBuilder($nameCache, $query, TRUE);
    }

    /**
     * find one by id
     * @param $id
     * @return  Object
     */
    public function findOne($id)
    {
        return Crm::getInstance()->findOne(array('id' => $id))->get()->row();
    }

    public function findByConditions($conditions = array(), $row = FALSE)
    {
        $query = Crm::getInstance()->find()->where($conditions);
        $nameCache = 'findByConditions' . http_build_query($conditions);
        $res = Crm::queryBuilder($nameCache, $query, $row);
        return $res;
    }


    public function getByIdAsArray($id)
    {
        return Crm::getInstance()->getByIdAsArray($id);
    }

    public function findByMultipleId($ids = array())
    {
        $name = 'findByMultipleId' . http_build_query($ids);
        $query = Crm::getInstance()->findByMultipleId($ids);
        $dbDatas = Crm::queryBuilder($name, $query, FALSE);
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
        Crm::getInstance()->save($data);
        $res = array(
            'success' => TRUE,
            'message' => 'Thêm số phone môi giới thành công'
        );
        return $res;
    }

    public function update($id, $data = array(), $runValidation = TRUE)
    {
        if ($runValidation) {
            $validation = $this->validateForm($data);
            if ($validation['validation']) {
                return $validation;
            }
        }
        Crm::getInstance()->update($id, $data);
        $res = array(
            'success' => TRUE,
            'message' => 'Cập nhật phone môi giới thành công'
        );
        return $res;
    }

    private function validateForm($data)
    {
        $validation = Crm::getInstance()->validateForm($data);
        return $validation;
    }

    public function delete($id, $data)
    {
        Crm::getInstance()->delete($id, $data);
        $res = array(
            'success' => TRUE,
            'message' => 'Xóa thành công'
        );
        return $res;
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
        return Crm::queryBuilder($name, $dbObj, FALSE);
    }

    public function getAllCache()
    {
        $name = 'getAll';
        $dbObj = Crm::getInstance()->find();
        return Crm::queryBuilder($name, $dbObj, TRUE);
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

    public function findByConditionsCache($conditions)
    {
        $name = 'findByConditionsCache' . http_build_query($conditions);
        $dbObj = Crm::findByConditions($conditions);
        $res = Crm::queryBuilder($name, $dbObj, FALSE);
        return $res;
    }
    public function findByMultiplePhone($phones)
    {
        $name = 'findByMultiplePhone' . http_build_query($phones);
        $dbObj = Crm::getInstance()->find(FALSE)->where_in('phone', $phones);
        $dbDatas = Crm::queryBuilder($name, $dbObj, FALSE);
        $res = [];
        foreach ($dbDatas as $data) {
            $res[] = $data->phone;
        }
        return $res;
    }
}
