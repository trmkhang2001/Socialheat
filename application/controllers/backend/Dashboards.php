<?php

use app\common\utilities\Common;
use app\common\business\BusinessUser;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;

class Dashboards extends BackendController
{
    public function index()
    {
        $itemPerPage = DEFAULT_ITEM_PER_PAGE;
        $conditions = $this->getConditions();
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $users = BusinessUser::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
        $total = BusinessUser::getInstance()->getCount($conditions);
        $pagination = Pagination::bootstrap($total, '', $itemPerPage);
        $totalName = array("Total Mentions", "Total Audience", "Total Keywords", "Total User Engage");
        $this->temp['data']['totalName'] = $totalName;
        $this->temp['data']['users'] = $users;
        $this->temp['data']['pagination'] = $pagination;
        $this->temp['template'] = 'backend/dashboards/index';
        $this->render();
    }

    private function getConditions()
    {
        $modelUser = BusinessUser::getModel();
        $filterArr = array('role_id', 'keyword');
        $filterConditions = $this->input->get($filterArr, TRUE);
        $conditions = array();
        foreach ($filterConditions as $key => $condition) {
            if ($condition) {
                if ($key === 'keyword') {
                    $conditions[] = [
                        $this->getSimpleSearchCondition($modelUser::tableName() . '.email'),
                        $this->getSimpleSearchCondition($modelUser::tableName() . '.phone'),
                        $this->getSimpleSearchCondition($modelUser::tableName() . '.name')
                    ];
                } else {
                    $conditions[] = array(sprintf('%s.%s', $modelUser::tableName(), $key) => $condition);
                }
            }
        }
        return $conditions;
    }

    public function denied()
    {
        $this->temp['template'] = '/backend/dashboards/denied';
        $this->render();
    }
    public function getTotal()
    {
        $conditions = $this->getConditions();
        $totalUserEngage =  count($conditions);
    }
}
