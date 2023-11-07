<?php

use app\common\business\BusinessUser;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;

class Profile extends BackendController
{
    public function index()
    {
        $itemPerPage = DEFAULT_ITEM_PER_PAGE;
        $conditions = $this->getConditions();
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $users = BusinessUser::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
        $this->temp['data']['users'] = $users;
        $this->temp['template'] = 'backend/profile/index';
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

    public function update($id)
    {
        $item = BusinessUser::getInstance()->findOne($id);
        $this->temp['data']['item'] = $item;
        $this->temp['template'] = 'backend/user/update';
        $this->render();
    }

    public function denied()
    {
        $this->temp['template'] = '/backend/user/denied';
        $this->render();
    }

    public function save()
    {
        $model = BusinessUser::getModel();
        $data = $this->input->post($model::$fields, TRUE);
        $id = $this->input->post('id', TRUE);
        if ($_POST && $data) {
            if (!empty($data['password'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            }
            if ($id > 0) {
                $data['updated_date'] = date('Y-m-d H:i:s');
                $res = BusinessUser::getInstance()->update($id, $data, TRUE);
            } else {
                $data['created_date'] = date('Y-m-d H:i:s');
                $data['avatar'] = '/assets/images/no_avatar.png';
                $data['status'] = STATUS_ACTIVE;
                $res = BusinessUser::getInstance()->save($data, TRUE);
            }
            $this->result = $res;
            $this->response();
        }
    }
}
