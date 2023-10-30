<?php

namespace app\models;

/**
 * @property  $email
 */
class CommentLog extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return CommentLog object
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
	public static $fields = NULL;

	public static $requiredFiled = [];

	public static function tableName()
	{
		return 'comment_logs';
	}
}