<?php
namespace app\models;

class Role extends MyModel
{
    static protected $_instance = NULL;
    /**
     * Use singleton pattern
     * @return Role object
     */
    static public function getInstance(){
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    static public function clearInstance(){
        self::$_instance = null;
    }
    public static function tableName()
    {
        return 'user_role';
    }

    public static $fields = array('name', 'status');
    public static $excludeRequire = array(
        'users/denied',
        'users/index',
    );

}