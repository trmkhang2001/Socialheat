<?php

namespace app\models;

/**
 * @property  $email
 */
class CRM extends MyModel
{

    static protected $_instance = NULL;

    /**
     * Use singleton pattern
     * @return CRM object
     */
    public static function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public static function clearInstance()
    {
        self::$_instance = NULL;
    }

    /**
     * @inheritdoc
     */
    public static $fields = array(
        'phone'
    );
    public static $requiredFiled = array(
        'phone'    => 'Số điện thoại môi giới',
    );

    public static function tableName()
    {
        return 'crm';
    }
}
