<?php

namespace app\models;

/**
 * @property  $email
 */
class App extends MyModel
{

    static protected $_instance = NULL;

    /**
     * Use singleton pattern
     * @return App object
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
        'app_name'
    );
    public static $requiredFiled = array(
        'app_name'    => 'Tên app',
    );

    public static function tableName()
    {
        return 'app';
    }
}
