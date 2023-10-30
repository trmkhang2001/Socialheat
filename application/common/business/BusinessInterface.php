<?php

namespace app\common\business;

interface BusinessInterface
{
    static public function getInstance();
    public static function getModel($data = array());
    public function findOne($id);
    public function findByMultipleId($ids = array());
    public function getByIdAsArray($id);
    public function save($data = array(), $runValidation = true);
    public function update($id, $data = array(), $runValidation = true);
    public function delete($id, $data);
    public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '');
    public function getCount($conditions = array());
    public function findByConditions($conditions = array());
}