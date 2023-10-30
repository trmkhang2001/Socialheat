<?php

namespace app\models;

/**
 * @property  $email
 */
class Log extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return Log object
	 */
	public static function getInstance()
	{
		if (self::$_instance === NULL)
		{
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
		'client_id','type','key','additional_data'
	);

	public static function tableName()
	{
		return 'client_logs';
	}
}