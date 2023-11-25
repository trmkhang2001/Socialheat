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
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $phone = $this->input->post('phone');
        $data = array('msg' => NULL, 'name' => $name, 'email' => $email, 'password' => $pass, 'phone' => $phone);
        $this->load->view('backend/layout/admin_sigup_view', $data);
    }
    function register()
    {
        $model = BusinessUser::getModel();
        $data = $this->input->post($model::$fields, TRUE);
        $cf_pass = $this->input->post('confirm_password');
        $data_rep = array('msg' => NULL, 'name' => $data['name'], 'email' => $data['email'], 'phone' => $data['phone']);
        $data_rep['msg'] = 'Đăng ký không thành công liên hệ admin';
        if (!empty($data['email']) && !empty($data['password'])) {
            if ($data['password'] === $cf_pass) {
                $data['role_id'] = ROLE_CLIENTS;
                $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                $data['created_date'] = date('Y-m-d H:i:s');
                $data['avatar'] = '/assets/images/no_avatar.png';
                $data['status'] = STATUS_ACTIVE;
                $res = BusinessUser::getInstance()->register($data);
                if ($res) {
                    $data_rep['msg'] = 'Đăng ký thành công';
                    return redirect('/admin');
                } else {
                    $data_rep['email'] = '';
                    $data_rep['msg'] = 'Email đã tồn tại';
                }
            } else {
                $data_rep['msg'] = 'Mật khẩu không khớp nhau';
            }
        }
        return $this->load->view('backend/layout/admin_sigup_view', $data_rep);
    }
}
