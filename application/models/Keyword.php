<?php

namespace app\models;

/**
 * @property  $email
 */
class Keyword extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return Keyword object
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
		'keyword'
	);
	public static $requiredFiled = array(
		'keyword'    => 'Từ khóa',
	);

	public static function tableName()
	{
		return 'keywords';
	}
}