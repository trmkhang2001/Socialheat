<?php
namespace app\models;

class Interaction extends MyModel
{
    static protected $_instance = NULL;
    /**
     * Use singleton pattern
     * @return Interaction object
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
        return 'interactions';
    }

    public static $fields = NULL;

}