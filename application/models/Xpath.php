<?php

namespace app\models;

/**
 * @property  $email
 */
class Xpath extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return xpath object
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
		'type', 'channel_type', 'xpath'
	);
	public static $requiredFiled = array(
		//'name'    => 'Name',
		'channel_type' => 'Channel type',
		'type'    => 'Type',
		'xpath'    => 'Xpath',
	);

	public static function tableName()
	{
		return 'xpath';
	}
}