<?php

use app\common\business\BusinessUser;
use app\common\business\BusinessSession;
use app\controllers\backend\BackendController;
use app\models\Role;
use app\models\User;

class Sigup extends CI_Controller
{
    public function index()
    {
        $data_rep = array('msg' => NULL);
        $this->load->view('backend/layout/admin_sigup_view', $data_rep);
    }
    function register()
    {
        $model = BusinessUser::getModel();
        $data = $this->input->post($model::$fields, TRUE);
        $cf_pass = $this->input->post('confirm_password');
        $data_rep = array('msg' => NULL);
        if ($data['password'] === $cf_pass) {
            $data['role_id'] = ROLE_CLIENTS;
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['status'] = STATUS_DEACTIVE;
            $res = BusinessUser::getInstance()->register($data);
            if ($res) {
                return redirect('/admin');
            } else {
                $data_rep['msg'] = 'Email đã tồn tại';
            }
        } else {
            $data_rep['msg'] = 'Mật khẩu không khớp nhau';
        }
        return $this->load->view('backend/layout/admin_sigup_view', $data_rep);
    }
}
