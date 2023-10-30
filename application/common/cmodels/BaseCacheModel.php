<?php

namespace app\common\cmodels;

class BaseCacheModel {

    public $cachePrefix = '';
	/**
	 * @var \CI_Cache
	 */
    public $cache;

	function __construct()
	{
		$this->cache = &get_instance()->cache;
	}

	/**
     * @param $id
     * @return string
     */
    public function getCacheKey($id){
        $key = $this->cachePrefix . $id;
        return $key;
    }
    public function getId($cacheKey = ''){
        $prefixLength = strlen($this->cachePrefix);
        $id = substr($cacheKey, $prefixLength);
        return $id;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getCache($id = 0){
        $cacheKey = $this->getCacheKey($id);
        return $this->cache->get($cacheKey);
    }



    /**
     * @param $id
     * @param $data
     * @param int $duration
     * @return bool
     */
    public function setCache($id, $data, $duration = CACHE_OBJECT_EXPIRED_SECONDS_ONE_HOUR){
        $cacheKey = $this->getCacheKey($id);
		return $this->cache->save($cacheKey, $data, $duration);
    }

    /**
     * @param $id
     * @return bool
     */
    public function deleteCache($id){
        $cacheKey = $this->getCacheKey($id);
		return $this->cache->delete($cacheKey);
    }
}
