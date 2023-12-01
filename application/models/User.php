<?php

namespace app\models;

/**
 * @property  $email
 */
class User extends MyModel
{

    static protected $_instance = NULL;

    /**
     * Use singleton pattern
     * @return User object
     */
    static public function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    static public function clearInstance()
    {
        self::$_instance = null;
    }
    /**
     * @inheritdoc
     */
    public static $fields = array(
        'name', 'role_id', 'email', 'phone', 'password', 'expire_date'
    );
    public static $requiredFiled = array(
        'email' => 'Mail nhân viên',
        'role_id' => 'Quyền',
        'name' => 'Tên nhân viên',
    );

    public static function tableName()
    {
        return 'users';
    }

    public static function getAuthSession()
    {
        $CI = &get_instance();

        return $CI->session->userdata('userinfo');
    }
    public static  function setAuthSession($userData)
    {
        $CI = &get_instance();
        $res = $CI->session->set_userdata('userinfo', (array) $userData);
        return $res;
    }

    public static function delAuthSession()
    {
        $CI = &get_instance();
        $CI->session->sess_destroy();
    }
}
