<?php

namespace app\models;

/**
 * @property  $email
 */
class Client extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return Client object
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
		'name', 'email', 'phone', 'password', 'user_id', 'expired_date', 'ip', 'type', 'username', 'status'
	);
	public static $requiredFiled = array(
		'email'    => 'Mail khách hàng',
//        'expire_date' => 'Ngày hết hạn',
		'ip'       => 'Ip',
		'type'     => 'Type',
		'username' => 'Username',
	);

	public static function tableName()
	{
		return 'clients';
	}

}