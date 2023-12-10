<?php

use app\common\business\BusinessUser;
use app\models\Role;
use app\models\User;

class Sigup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index()
    {
        $data_rep = array('msg' => NULL);
        $this->load->view('backend/layout/admin_sigup_view', $data_rep);
    }
    function register()
    {
        $formValidation = new CI_Form_validation();
        $formValidation->set_rules('name', 'Name', 'required');
        $formValidation->set_rules('email', 'Email', 'required|valid_email');
        $formValidation->set_rules('password', 'Password', 'trim|required');
        $formValidation->set_rules('confirm_password', 'Confirm Password', 'trim|required');
        $formValidation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9]{10}$/]');
        if (!$formValidation->run()) {
            $errorArray = $formValidation->error_array();
            $data_rep = array('msg' => reset($errorArray));
            $this->load->view('backend/layout/admin_sigup_view', $data_rep);
        } else {
            $model = User::getInstance();
            $data = $this->input->post($model::$fields, TRUE);
            $id = $this->input->post('id', TRUE);
            $cf_pass = $this->input->post('confirm_password');
            if ($data['password'] === $cf_pass) {
                if ($_POST && $data) {
                    if (!empty($data['password'])) {
                        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                    }
                    if ($data['expire_date'] == NULL) {
                        unset($data['expire_date']);
                    }
                    $data['role_id'] = ROLE_CLIENTS;
                    $data['created_date'] = date('Y-m-d H:i:s');
                    $data['avatar'] = '/assets/images/no_avatar.png';
                    $data['status'] = STATUS_DEACTIVE;
                    $dbObj = User::getInstance()->find()->where_in('email', $data['email']);
                    $db = $dbObj->count_all_results();
                    if ($db > 0) {
                        $data_rep['msg'] = 'Email đã tồn tại';
                    } else {
                        $res = User::getInstance()->save($data);
                        return redirect('/admin');
                    }
                }
            } else {
                $data_rep['msg'] = 'Mật khẩu không khớp nhau';
            }
            return $this->load->view('backend/layout/admin_sigup_view', $data_rep);
        }
    }
}
