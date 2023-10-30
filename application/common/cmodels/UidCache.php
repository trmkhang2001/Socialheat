<?php

namespace app\common\cmodels;

class UidCache extends BaseCacheModel {
	public $cachePrefix = CACHE_KEY_PREFIX_UID;
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 * @return UidCache object
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
