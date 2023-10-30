<?php

namespace app\models;

/**
 * @property  $email
 */
class Item extends MyModel {

	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return Item object
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


	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @inheritdoc
	 */
	public static $fields = array(
		'name', 'post_id', 'type','image_url','status','content','channel_type','keywords','post_owner_id','craw_date'
	);
	public static $requiredFiled = array(
		//'name'    => 'Name',
		'post_id' => 'Post Id',
		'type'    => 'Type',
		'channel_type' => 'Channel tpye',
		'keywords' => 'Keywords',
		'post_owner_id' => 'Social Item'
	);

	public static function tableName()
	{
		return 'items';
	}
}