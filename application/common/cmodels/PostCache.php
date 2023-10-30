<?php

namespace app\common\cmodels;

class PostCache extends BaseCacheModel {
	public $cachePrefix = CACHE_KEY_PREFIX_POST;
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return PostCache object
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
}
