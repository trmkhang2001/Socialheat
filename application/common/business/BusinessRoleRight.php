<?php
namespace app\common\business;
use app\models\RoleRight;

class BusinessRoleRight implements BusinessInterface
{
    static protected $_instance = NULL;

    static public function getInstance(){
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public static function getModel($data = array())
    {
        // TODO: Implement getModel() method.
    }

    public function findOne($id)
    {
        $model = RoleRight::getInstance()->findOne(array('id' => $id));
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

    public function save($data = array(), $runValidation = true)
    {
        // TODO: Implement save() method.
    }

    public function update($id, $data = array(), $runValidation = true)
    {
        // TODO: Implement update() method.
    }

    public function delete($id, $data)
    {
        // TODO: Implement delete() method.
    }

    public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
    {
        // TODO: Implement getRange() method.
    }

    public function getCount($conditions = array())
    {
        // TODO: Implement getCount() method.
    }

    public function findByConditions($condtions = array())
    {
        $model = RoleRight::getInstance()->findOne($condtions);
        return $model;
    }
}