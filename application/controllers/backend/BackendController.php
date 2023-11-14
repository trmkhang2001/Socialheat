<?php

namespace app\controllers\backend;

use app\common\business\BusinessRole;
use app\models\User;
use app\common\utilities\Pagination;

class BackendController extends \CI_Controller
{

    protected $userInfo;
    protected $result = array();
    protected $temp = array();
    public $input;
    public $router;


    public function __construct()
    {
        parent::__construct();
        $this->load->helper('text');
        $this->input = new \CI_Input();
        $this->router = new \CI_Router();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $this->temp = array(
            'title'     => '', 'style'  => '', 'data' => array(),
            'menu_cate' => '', 'layout' => 'frontend/layout/master_view'
        );
        $this->result['success'] = FALSE;
        $this->userInfo = User::getAuthSession();
        // check phân quyền
        if ($this->router->fetch_class() !== 'admin' && $this->router->fetch_class() !== 'auth') {
            $permission = BusinessRole::getInstance()->getPermission();
            if (!$permission['hasPermission'] && $permission['redirectUrl']) {
                redirect($permission['redirectUrl']);
            }
        }
        $this->temp['baseLink'] = '/backend/' . $this->router->class;
        $this->temp['layout'] = '/backend/layout/admin_master_view';
        $this->result = array('success' => FALSE, 'message' => NULL);
        $this->temp['userInfo'] = $this->userInfo;
        $this->temp['breadcrumbs'] = array();
    }

    public function render(): void
    {
        $this->load->view($this->temp['layout'], $this->temp);
    }

    //    public function render()
    protected function response($json = NULL): void
    {
        if ($json) {
            $this->result = $json;
        }
        echo json_encode($this->result);
        exit;
    }
    // ko support nên xài cái cũ search like
    // SELECT  keywords FROM items WHERE MATCH(keywords) AGAINST('biệt thự biển,Wyndham,BTC,DOT' IN BOOLEAN MODE)
    public function getSimpleSearchCondition($field = 'name', $keywords = '')
    {
        if (empty($keywords)) {
            $keywords = $this->input->get('keyword', TRUE);
        }
        $conditions = array();
        if ($keywords) {
            $conditions = array('CONVERT(' . $field . ' USING utf8) like ' =>  '%' . $keywords . '%');
        }
        return $conditions;
    }

    public function getSimpleSearchFulltext($field = 'name', $keywords = '')
    {
        if (empty($keywords)) {
            $keywords = $this->input->get('keyword', TRUE);
        }
        $conditions = array();
        if ($keywords) {
            $conditions = array('MATCH(keywords)  AGAINST(' . $keywords . ' IN BOOLEAN MODE)' =>  NULL);
        }
        return $conditions;
    }


    public function setBreadcrumbs($labelMethod = 'Danh sách nhân viên', $labelClass = 'Quản lý'): void
    {
        $this->temp['breadcrumbs'] = array(
            array(
                'url' => sprintf('/backend/%s', $this->router->fetch_class()),
                'label' => $labelClass,
            ),
            $labelMethod
        );
    }

    public function pagination($total, $itemPerPage = ITEM_PER_PAGE_14, $baseurl = ''): string
    {
        return Pagination::bootstrap($total, $baseurl, $itemPerPage);
    }
}
