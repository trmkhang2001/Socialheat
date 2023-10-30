<?php

namespace app\models;

/**
 * @property  $email
 */
class DbSetting extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return DbSetting object
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
		'name', 'hostname', 'username', 'password', 'database', 'table_name', 'status', 'select_index'
	);
	public static $requiredFiled = array(
		'hostname'     => 'Hostname',
//		'password'   => 'Password',
		'database'     => 'Database',
		'table_name'   => 'Table name',
		'username'     => 'Username',
		'select_index' => 'Select fields'
	);

	public static function tableName()
	{
		return 'db_settings';
	}
}