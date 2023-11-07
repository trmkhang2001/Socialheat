<?php

use app\common\business\BusinessUser;
use app\common\business\BusinessSession;
use app\controllers\backend\BackendController;
use app\models\Role;
use app\models\User;

class Auth extends BackendController
{
    function index()
    {
        $post = $this->input->post(array('email', 'password'), TRUE);
        $data = array('msg' => NULL, 'email' => $post['email']);
        $is_post = $this->input->method();
        $loggerUser = BusinessUser::getInstance()->getUserSession();
        if ($loggerUser !== NULL) {
            $sessionUser = Role::getInstance()->getCache(BusinessSession::getName($loggerUser['id']));
            if ($loggerUser['session_id'] === $sessionUser['session'] && $loggerUser && $sessionUser) {
                $this->redirectSuccess($loggerUser['role_id']);
            }
        }
        if ($is_post && !empty($post['email']) && !empty($post['password'])) {
            $user = BusinessUser::getInstance()->checkAuth($post['email'], $post['password']);

            if (empty($user)) {
                $data['msg'] = 'Email hoặc mật khẩu không đúng';
            } else if ((int)$user->status === STATUS_DELETE) {
                $data['msg'] = 'Tài khoản này đã bị xóa vui lòng liên hệ Admin đễ biết thêm chi tiết';
            } else {
                $user->session_id = session_id();
                BusinessUser::getInstance()->setUserSession($user);
                BusinessSession::insertSession($user);
                $this->redirectSuccess($user->role_id);
            }
        }
        $this->load->view('backend/layout/admin_login_view', $data);
    }

    private function redirectSuccess($roleId)
    {
        $link = '/backend/dashboards';
        if ($roleId !== ROLE_ADMIN) {
            $link = '/backend/clients';
        }
        $continueUrl = $this->input->get('continue', TRUE);
        if ($continueUrl) {
            $link = $continueUrl;
        }
        redirect($link);
    }

    private function initAdmin()
    {

        $passWord = password_hash('123456', PASSWORD_BCRYPT);
        $data = array(
            'id' => 1,
            'name' => 'Administrator',
            'email' => 'admin@mail.com',
            'password' => $passWord,
            'avatar' => 'https://cdn4.iconfinder.com/data/icons/mayssam/512/user-128.png',
            'role_id' => 1,
            'created_date' => date('Y-m-d H:i:s'),
        );
        $admin = BusinessUser::getInstance()->findByEmail('admin@email.com');
        if (empty($admin)) {
            User::getInstance()->save($data);
            echo "Admin init success!";
        } else {
            echo "Admin is exit!! can use admin to login!!";
        }
    }
    function logOut()
    {
        $this->session->sess_destroy();
        redirect('/admin');
    }
}
