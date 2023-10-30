<?php
namespace app\common\business;
use app\models\Role;
use app\models\Session;

class BusinessSession implements BusinessInterface
{

    static protected $_instance = NULL;
    /**
     * Use singleton pattern
     *
     * @return BusinessSession object
     */
    static public function getInstance(){
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    /**
     * get model instance
     * @param mixed $data
     * @return Session $model
     */
    public static function getModel($data = array()){
        $model = Session::getInstance();
        return $model;
    }
    /**
     * find one by id
     * @param $id
     * @return \CI_DB_query_builder Object
     */
    public function findOne($id){
		return Session::getInstance()->findOne(array('id' => $id));

    }

    public function findByConditions($condtions = array()){
        return Role::getInstance()->find()->where($condtions);
    }

    public function getByIdAsArray($id){
        return Role::getInstance()->getByIdAsArray($id);
    }

    public function findByMultipleId($ids = array())
    {
        $name = 'findByMultipleId'.http_build_query($ids);
        $query = Role::getInstance()->findByMultipleId($ids);
        $dbDatas = Role::queryBuilder($name,$query,FALSE);
        $ret = array();
        if ($dbDatas) {
            foreach ($dbDatas as $dbData) {
                $ret[$dbData['id']] = $dbData;
            }
        }
        return $ret;
    }
    public function save($data = array(), $runValidation = true){

    }
    public function update($id, $data = array(), $runValidation = true){

    }
    public function delete($id, $data){

    }
    public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = ''){

    }
    public function getCount($conditions = array()){

    }
    public static function insertSession($userInfo){
        $conditions = array('session' => $userInfo->session_id,'user_id'  => $userInfo->id);
        $name = self::getName($conditions['user_id']);
        Session::setCache($name,$conditions,24*60*60*365);
    }

    public static function getName($userId){
        $name = Session::tableName().'_sessionLogin_'.$userId.'_.cache';
        return $name;
    }


}