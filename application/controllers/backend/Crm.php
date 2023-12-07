<?php

use app\common\utilities\Common;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessCrm;

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
        $items = BusinessCrm::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
        $total = BusinessCrm::getInstance()->getCount($conditions);
        $pagination = Pagination::bootstrap($total, '', $itemPerPage);
        $this->temp['data']['items'] = $items;
        $this->temp['data']['pagination'] = $pagination;
        $this->temp['template'] = 'backend/crm/index';
        $this->render();
    }

    private function getConditions()
    {
        $conditions = array();
        return $conditions;
    }

    public function create()
    {
        $model = BusinessCrm::getModel();
        $item = Common::getFieldObj($model::$fields);
        $item->id = 0;
        $this->temp['data']['item'] = $item;
        $this->temp['template'] = 'backend/crm/update';
        $this->render();
    }
    public function save()
    {
        $model = BusinessCrm::getModel();
        $data = $this->input->post($model::$fields, TRUE);
        $id = $this->input->post('id', TRUE);

        if ($_POST && $data) {
            if ($id > 0) {
                $res = BusinessCrm::getInstance()->update($id, $data, TRUE);
            } else {
                $res = BusinessCrm::getInstance()->save($data, TRUE);
            }
            $this->result = $res;
            $this->response();
        }
    }

    public function delete($id)
    {
        $item = BusinessCrm::getInstance()->findOne($id);
        if ($item) {
            $res = BusinessCrm::getInstance()->delete($id, []);
            $this->result = $res;
            $this->response();
        }
    }
}
