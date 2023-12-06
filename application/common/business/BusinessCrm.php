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
        $validation = $this->validateForm($data);
        if (($validation['validation'])) {
            return $validation;
        }
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
        //User::getInstance()->delete($id);
        Crm::getInstance()->delete($id, $data);
        $res = array(
            'success' => TRUE,
            'message' => 'Xóa thành công'
        );
        return $res;
    }

    public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
    {
        $dbObj = Crm::getInstance()->find();
        if ($itemPerPage) {
            $dbObj->limit($itemPerPage);
        }
        if ($orderBy) {
            $dbObj->order_by($orderBy);
        }
        $dbObj = Crm::getInstance()->getConditions($conditions, $dbObj);
        $dbObj->offset($offset);
        return $dbObj;
    }

    public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
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

    public function getCount($conditions = array())
    {
        $dbObj = Crm::getInstance()->find();
        $dbObj = Crm::getInstance()->getConditions($conditions, $dbObj);
        return $dbObj->count_all_results();
    }

    public function findByConditionsCache($conditions)
    {
        $name = 'findByConditionsCache' . http_build_query($conditions);
        $dbObj = Crm::findByConditions($conditions);
        $res = Crm::queryBuilder($name, $dbObj, FALSE);
        return $res;
    }
    public function getAllPhone()
    {
        $name = 'getAllPhone';
        $dbObj = Crm::getInstance()->find();
        $res = array();
        $dbData = Crm::queryBuilder($name, $dbObj, FALSE);
        if ($dbData) {
            foreach ($dbData as $data) {
                $res[] = $data->phone;
            }
        }
        return $res;
    }
}
