<?php

namespace app\common\business;

use app\common\components\Upload;
use app\models\GroupKeys;

class BusinessGroupKeys implements BusinessInterface
{
    static protected $_instance = NULL;

    /**
     * Use singleton pattern
     *
     * @return BusinessGroupKeys object
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
     * @return GroupKeys $model
     */
    public static function getModel($data = array())
    {
        $model = GroupKeys::getInstance();
        return $model;
    }

    /**
     * find one by id
     * @param $id
     * @return \CI_DB_query_builder Object
     */
    public function findOneCache($id)
    {
        $query = GroupKeys::getInstance()->findOne(array('id' => $id));
        $nameCache = 'findOne_' . $id;
        return GroupKeys::queryBuilder($nameCache, $query, TRUE);
    }

    /**
     * find one by id
     * @param $id
     * @return  Object
     */
    public function findOne($id)
    {
        return GroupKeys::getInstance()->findOne(array('id' => $id))->get()->row();
    }

    public function findByConditions($conditions = array(), $row = FALSE)
    {
        $query = GroupKeys::getInstance()->find()->where($conditions);
        $nameCache = 'findByConditions' . http_build_query($conditions);
        $res = GroupKeys::queryBuilder($nameCache, $query, $row);
        return $res;
    }


    public function getByIdAsArray($id)
    {
        return GroupKeys::getInstance()->getByIdAsArray($id);
    }

    public function findByMultipleId($ids = array())
    {
        $name = 'findByMultipleId' . http_build_query($ids);
        $query = GroupKeys::getInstance()->findByMultipleId($ids);
        $dbDatas = GroupKeys::queryBuilder($name, $query, FALSE);
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
        GroupKeys::getInstance()->save($data);
        $res = array(
            'success' => TRUE,
            'message' => 'Tạo nhóm từ khóa thành công'
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
        GroupKeys::getInstance()->update($id, $data);
        $res = array(
            'success' => TRUE,
            'message' => 'Cập nhật nhóm từ khóa thành công'
        );
        return $res;
    }

    private function validateForm($data)
    {
        $validation = GroupKeys::getInstance()->validateForm($data);
        return $validation;
    }

    public function delete($id, $data)
    {
        //User::getInstance()->delete($id);
        GroupKeys::getInstance()->delete($id, $data);
        $res = array(
            'success' => TRUE,
            'message' => 'Xóa thành công'
        );
        return $res;
    }

    public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
    {
        $dbObj = GroupKeys::getInstance()->find();
        if ($itemPerPage) {
            $dbObj->limit($itemPerPage);
        }
        if ($orderBy) {
            $dbObj->order_by($orderBy);
        }
        $dbObj = GroupKeys::getInstance()->getConditions($conditions, $dbObj);
        $dbObj->offset($offset);
        return $dbObj;
    }

    public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
    {
        $name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
        $dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
        return GroupKeys::queryBuilder($name, $dbObj, FALSE);
    }

    public function getAllCache()
    {
        $name = 'getAll';
        $dbObj = GroupKeys::getInstance()->find();
        return GroupKeys::queryBuilder($name, $dbObj, TRUE);
    }

    public function getCount($conditions = array())
    {
        $dbObj = GroupKeys::getInstance()->find();
        $dbObj = GroupKeys::getInstance()->getConditions($conditions, $dbObj);
        return $dbObj->count_all_results();
    }

    public function findByEmail($email)
    {
        $query = GroupKeys::getInstance()->findByEmail($email);
        $nameCache = 'findByEmail_' . $email;
        $res = GroupKeys::getInstance()->queryBuilder($nameCache, $query, TRUE);
        return $res;
    }



    public function findByConditionsCache($conditions)
    {
        $name = 'findByConditionsCache' . http_build_query($conditions);
        $dbObj = GroupKeys::findByConditions($conditions);
        $res = GroupKeys::queryBuilder($name, $dbObj, FALSE);
        return $res;
    }
}
