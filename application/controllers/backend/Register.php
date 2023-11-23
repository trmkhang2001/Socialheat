<?php

use app\common\business\BusinessUser;
use app\common\business\BusinessSession;
use app\controllers\backend\BackendController;
use app\models\Role;
use app\models\User;

class Register extends BackendController
{
    public function index()
    {
        $this->temp['template'] = 'backend/register/index';
        $this->render();
    }
    function register()
    {
        $post = $this->input->post(array('name', 'email', 'password', 'confirm_password', 'phone'), TRUE);
        $data = array('msg' => NULL, 'name' => $post['name'], 'email' => $post['email'], 'password' => $post['password'], 'phone' => $post['phone']);
        $id = 0;
        $is_post = $this->input->method();
        if ($is_post && !empty($post['email']) && !empty($post['password'])) {
            $user = BusinessUser::getInstance()->findByEmail($post['email']);
            if (!empty($user)) {
                $data['msg'] = 'Email đã tồn tại vui lòng sử dụng email khác';
            } else {
                if ($post['password'] === $post['confirm_password']) {
                    $data_user['name'] = $post['name'];
                    $data_user['email'] = $post['email'];
                    $data_user['password'] =  password_hash($post['password'], PASSWORD_BCRYPT);
                    $data_user['phone'] = $post['phone'];
                    $res = BusinessUser::getInstance()->save($data_user, TRUE);
                    $this->result = $res;
                    $data['msg'] = 'Đăng ký thành công';
                } else {
                    $data['msg'] = 'Mật khẩu không khớp nhau';
                }
            }
        }
        $this->load->view('backend/layout/admin_login_view', $data);
    }
}
