<?php

namespace app\models;

/**
 * @property  $email
 */
class Comment extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return Comment object
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
		'comment', 'keywords','status','type','from','to'
	);

	public static $requiredFiled = array(
		'comment' => 'Comment',
		'keywords'    => 'Keywords',
	);

	public static function tableName()
	{
		return 'comments';
	}
}