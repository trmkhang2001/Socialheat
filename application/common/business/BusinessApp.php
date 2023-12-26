<?php

namespace app\common\business;

use app\models\App;

class BusinessApp implements BusinessInterface
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
     * @return App|null
     */
    public static function getModel($data = array())
    {
        return App::getInstance();
    }

    public function findOne($id)
    {
        $model = App::getInstance()->findOne(array('id' => $id));
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
        return App::queryBuilder($name, $dbObj, FALSE);
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
    public function findByConditions($conditions = array())
    {
        $dbObj = App::getInstance()->find(false);
        $dbObj = App::getInstance()->getConditions($conditions, $dbObj);
        return $dbObj;
    }
}
