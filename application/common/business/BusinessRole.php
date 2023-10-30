<?php
namespace app\common\business;
use app\models\RoleRight;
use app\models\Role;
use app\models\User;

class BusinessRole implements BusinessInterface
{

    static protected $_instance = NULL;
    /**
     * Use singleton pattern
     *
     * @return BusinessRole object
     */
     public static function getInstance(){
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    /**
     * get model instance
     * @param mixed $data
     * @return Role $model
     */
    public static function getModel($data = array()){
		return Role::getInstance();
    }
    /**
     * find one by id
     * @param $id
     * @return User Object
     */
    public function findOne($id){
        $model = Role::getInstance()->findOne(array('id' => $id));
        return $model;
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

    public static function checkPermission($currentUrl, $roleId){
        $isCheck = FALSE;
        $roleRight = RoleRight::getRights();
        $currentUrl = mb_strtolower($currentUrl);
        if(in_array($currentUrl,$roleRight[$roleId],FALSE)){
            $isCheck = TRUE;
        }
        return $isCheck;
    }

    public function getPermission(){
        $router = new \CI_Router();
        $returnData = array();
        $hasPermission= FALSE;
        $currentController = $router->fetch_class();
        $currentAction = $router->fetch_method();
        $loggerUser = User::getAuthSession();
        $currentUrl = $currentController.'/'.$currentAction;
        $excludeRequire = Role::$excludeRequire;
        if(empty($loggerUser)){
            $continueUrl = $_SERVER['REQUEST_URI'];
            $returnData['redirectUrl'] = '/admin';
            if($continueUrl){
                $returnData['redirectUrl'] = sprintf('%s?continue=%s','/admin',base_url($continueUrl));
            }
        }else{
            $sessionUser = Role::getInstance()->getCache(BusinessSession::getName($loggerUser['id']));
            if($sessionUser['session'] !== $loggerUser['session_id']){
                $returnData['redirectUrl'] = '/admin';
            }else{
				if($loggerUser['role_id'] === ROLE_ADMIN){
					$hasPermission = TRUE;
                }else{
                    if(in_array(mb_strtolower($currentUrl), $excludeRequire,FALSE)){
                        $hasPermission = TRUE;
                    }else{
                        $roleRight = self::checkPermission($currentUrl, $loggerUser['role_id']);
                        if($roleRight){
                            $hasPermission = TRUE;
                        }
                    }
                }
                if(!$hasPermission){
                    $returnData['redirectUrl'] = '/backend/users/denied';
                }
            }

        }
        $returnData['hasPermission'] = $hasPermission;
        return $returnData;
    }

    public function findAll(){
        $query = Role::getInstance()->find();
        $nameCache = 'findAll';
        $res = Role::queryBuilder($nameCache,$query,FALSE);
        return $res;
    }

    public function renderDropDown($data){
        $option = '';
        if(!empty($data)){
            foreach ($data as $value) {
                $option  .= "<option value='$value->id'> $value->name </option>";
            }
        }
        return $option;
    }
}