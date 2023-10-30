<?php

namespace app\models;

/**
 * @property  $email
 */
class Socialtem extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return Socialtem object
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
		'name', 'social_id', 'note', 'image','type','status','channel_type'
	);
	public static $requiredFiled = array(
		'name'      => 'Name',
		'social_id' => 'Social Id',
		'type'      => 'Type',
		'channel_type' => 'Chanel type'
	);

	public static function tableName()
	{
		return 'social_items';
	}
}