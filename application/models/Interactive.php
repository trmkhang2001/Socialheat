<?php

namespace app\models;

/**
 * @property  $email
 */
class Interactive extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return Interactive object
	 */
	static public function getInstance()
	{
		if (self::$_instance === NULL)
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	static public function clearInstance()
	{
		self::$_instance = NULL;
	}

	/**
	 * @inheritdoc
	 */
	public static $fields = array(
		'uid', 'name', 'email', 'phone', 'note', 'address', 'source'
	);
	public static $requiredFiled = array(
//		'email'   => 'Email',
		'phone'   => 'Số điện thoại',
		'name'    => 'Tên user',
//		'note'    => 'Note',
//		'address' => 'Address',
		'source'  => 'Source',
	//	'uid'     => 'Uid'
	);

	public static function tableName()
	{
		return 'interactivities';
	}


}