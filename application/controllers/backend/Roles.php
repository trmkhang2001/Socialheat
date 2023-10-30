<?php

use app\common\utilities\Common;
use app\models\Role;
use app\models\RoleRight;
use App\common\business\BusinessUser;
use App\common\business\BusinessRole;
use app\controllers\backend\BackendController;

class Roles extends BackendController
{
    public function __construct()
    {
        parent::__construct();
    }

    private function initRoleRight($role_id){
        $controller = 'letters';
        $data = array(
            1 => array(
                'role_id' => $role_id,
                'controller' => $controller,
                'action' => 'index',
                'created_by' => $this->userInfo['id'],
                'created_date' => date('Y-m-d H:i:s'),
            ),
            2 => array(
                'role_id' => $role_id,
                'controller' => $controller,
                'action' => 'create',
                'created_by' => $this->userInfo['id'],
                'created_date' => date('Y-m-d H:i:s'),
            ),
            3 => array(
                'role_id' => $role_id,
                'controller' => $controller,
                'action' => 'update',
                'created_by' => $this->userInfo['id'],
                'created_date' => date('Y-m-d H:i:s'),
            ),
            4 => array(
                'role_id' => $role_id,
                'controller' => $controller,
                'action' => 'save',
                'created_by' => $this->userInfo['id'],
                'created_date' => date('Y-m-d H:i:s'),
            ),
            5 => array(
                'role_id' => $role_id,
                'controller' => $controller,
                'action' => 'delete',
                'created_by' => $this->userInfo['id'],
                'created_date' => date('Y-m-d H:i:s'),
            )


        );

        $res = RoleRight::getInstance()->insertBatch($data);
        if($res)
            echo 'init ss';

    }

}

/* End of file Roles.php */