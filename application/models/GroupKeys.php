<?php

namespace app\models;

/**
 * @property  $email
 */
class GroupKeys extends MyModel
{

    static protected $_instance = NULL;

    /**
     * Use singleton pattern
     * @return GroupKeys object
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
        'group_keys'
    );
    public static $requiredFiled = array(
        'group_keys'    => 'Nhóm từ khóa',
    );

    public static function tableName()
    {
        return 'group_keys';
    }
}
