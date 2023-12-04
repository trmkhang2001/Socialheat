<?php

use app\common\utilities\Common;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessCRM;

class CRM extends BackendController
{


    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $itemPerPage = DEFAULT_ITEM_PER_PAGE;
        $conditions = $this->getConditions();
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $items = BusinessCRM::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
        $total = BusinessCRM::getInstance()->getCount($conditions);
        $pagination = Pagination::bootstrap($total, '', $itemPerPage);
        $this->temp['data']['items'] = $items;
        $this->temp['data']['pagination'] = $pagination;
        $this->temp['template'] = 'backend/CRM/index';
        $this->render();
    }

    private function getConditions()
    {
        $modelDbSetting = BusinessCRM::getModel();
        $filterArr = array('phone');
        $filterConditions = $this->input->get($filterArr, TRUE);
        $conditions = array();
        foreach ($filterConditions as $key => $condition) {
            if ($condition === '0' || $condition) {
                $conditions[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $condition);
            }
        }
        return $conditions;
    }

    public function create()
    {
        $model = BusinessCRM::getModel();
        $item = Common::getFieldObj($model::$fields);
        $item->id = 0;
        $this->temp['data']['item'] = $item;
        $this->temp['template'] = 'backend/crm/update';
        $this->render();
    }
    public function save()
    {
        $model = BusinessCRM::getModel();
        $data = $this->input->post($model::$fields, TRUE);
        $id = $this->input->post('id', TRUE);

        if ($_POST && $data) {
            if ($id > 0) {
                $res = BusinessCRM::getInstance()->update($id, $data, TRUE);
            } else {
                $data['created_date'] = date('Y-m-d H:i:s');
                $data['status'] = STATUS_ACTIVE;
                $res = BusinessCRM::getInstance()->save($data, TRUE);
            }
            $this->result = $res;
            $this->response();
        }
    }

    public function delete($id)
    {
        $item = BusinessCRM::getInstance()->findOne($id);
        if ($item) {
            $res = BusinessCRM::getInstance()->delete($id, []);
            $this->result = $res;
            $this->response();
        }
    }
}
