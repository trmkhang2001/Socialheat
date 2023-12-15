<?php

namespace app\common\business;

use app\models\Brand;

class BusinessBrand implements BusinessInterface
{
    static protected $_instance = NULL;

    static public function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @param array $data
     * @return Brand|null
     */
    public static function getModel($data = array())
    {
        return Brand::getInstance();
    }

    public function findOne($id)
    {
        $model = Brand::getInstance()->findOne(array('id' => $id));
        return $model;
    }

    public function findByMultipleId($ids = array())
    {
        // TODO: Implement findByMultipleId() method.
    }

    public function getByIdAsArray($id)
    {
        // TODO: Implement getByIdAsArray() method.
    }

    public function save($data = array(), $runValidation = TRUE)
    {

        // TODO: Implement save() method.
    }

    public function update($id, $data = array(), $runValidation = TRUE)
    {
        // TODO: Implement update() method.
    }

    public function delete($id, $data)
    {
        // TODO: Implement delete() method.
    }

    public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
    {

        $modelInstance = self::getModel();
        /**
         * @var $dbObj \CI_DB_query_builder
         */
        $dbObj = $modelInstance::find(FALSE)->order_by($orderBy);
        if ($itemPerPage) {
            $dbObj->limit($itemPerPage);
        }
        $dbObj = $modelInstance->getConditions($conditions, $dbObj);
        $dbObj->offset($offset);
        return $dbObj;
    }

    public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
    {
        $name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
        $dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
        return Brand::queryBuilder($name, $dbObj, FALSE);
    }

    public function getCount($conditions = array(), $alias = '')
    {
        $modelInstance = self::getModel();
        $nameCache = 'getCount' . http_build_query($conditions);
        $res = $modelInstance::getCache($nameCache);
        if ($res) {
            return $res;
        }
        /**
         * @var $dbObj \CI_DB_query_builder
         */
        if ($alias) {
            $dbObj = $modelInstance::find(FALSE, $alias);
        } else {
            $dbObj = $modelInstance::find(FALSE);
        }

        $dbObj = $modelInstance->getConditions($conditions, $dbObj);
        $number =   $dbObj->count_all_results();
        $modelInstance::setCache($nameCache, $number, 60 * 60 * 24 * 30);
        return  $number;
    }
    public function findByConditions($conditions = array())
    {
        $dbObj = Brand::getInstance()->find(false);
        $dbObj = Brand::getInstance()->getConditions($conditions, $dbObj);
        return $dbObj;
    }
    // public function findIdBrandByMultipleItemId($items_id, $rate)
    // {
    //     if (!$items_id) {
    //         return  [];
    //     }
    //     $name = 'findIdByMultipleItem' . http_build_query($items_id);
    //     $dbObj = Brand::getInstance()->find(FALSE)->where_in('item_id', $items_id)->where('rate=', $rate);
    //     $listBrand = Brand::queryBuilder($name, $dbObj, FALSE);
    //     $res = [];
    //     if ($listBrand) {
    //         foreach ($listBrand as $brand) {
    //             $res[] = $brand->item_id;
    //         }
    //     }
    //     return $res;
    // }
    // public function findKeywordBrandByMultipleItemId($items_id, $rate)
    // {
    //     if (!$items_id) {
    //         return  [];
    //     }
    //     $name = 'findKeywordByMultipleItem' . http_build_query($items_id);
    //     $dbObj = Brand::getInstance()->find(FALSE)->where_in('item_id', $items_id)->where('rate=', $rate);
    //     $listBrand = Brand::queryBuilder($name, $dbObj, FALSE);
    //     $res = [];
    //     if ($listBrand) {
    //         foreach ($listBrand as $brand) {
    //             $res[] = $brand->keywords;
    //         }
    //     }
    //     return $res;
    // }
    public function findBrandByMultipleItemId($items_id)
    {
        if (!$items_id) {
            return  [];
        }
        $name = 'findBrandByMultipleItemId' . http_build_query($items_id);
        $dbObj = Brand::getInstance()->find(FALSE)->where_in('item_id', $items_id);
        $listBrand = Brand::queryBuilder($name, $dbObj, FALSE);
        $res = [];
        if ($listBrand) {
            foreach ($listBrand as $brand) {
                $res[] = $brand;
            }
        }
        return $res;
    }
}
