<?php

use app\common\utilities\Common;
use app\common\utilities\GoogleCloudStorage;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessItem;
use app\common\business\BusinessXpath;
use app\models\User;
use app\common\business\BusinessInteraction;
use app\common\business\BusinessSocialItem;
use app\common\business\BusinessUser;

class Monitoring extends BackendController
{
    public function index()
    {
        $itemPerPage = ITEM_PER_PAGE_14;
        $conditions = $this->getConditions();
        $items = $this->_items($conditions, $itemPerPage);
        $this->temp['data']['channel_type'] = '';
        $this->temp['template'] = 'backend/monitoring/index';
        $this->render();
    }


    public function clear_cache()
    {
        BusinessInteraction::getModel()->clearCache();
    }

    public function facebook()
    {
        $conditions = $this->getConditions();
        $conditions[]['i.channel_type'] = FALSE;
        $this->temp['data']['channel_type'] = CHANNEL_TYPE_FACEBOOK;
        $this->_items($conditions);
        $this->render();
    }

    public function twitter()
    {
        $conditions = $this->getConditions();
        $conditions[]['i.channel_type'] = CHANNEL_TYPE_TWITTER;
        $this->temp['data']['titleRetweet'] = 'Retweet';
        $this->temp['data']['channel_type'] = CHANNEL_TYPE_TWITTER;
        $this->_items($conditions);
        $this->render();
    }

    public function instagram()
    {
        $conditions = $this->getConditions();
        $conditions[]['i.channel_type'] = CHANNEL_TYPE_INSTAGRAM;
        $this->temp['data']['channel_type'] = CHANNEL_TYPE_INSTAGRAM;
        $this->_items($conditions);
        $this->render();
    }

    public function tiktok()
    {
        $conditions = $this->getConditions();
        $conditions[]['i.channel_type'] = CHANNEL_TYPE_TIKTOK;
        $this->temp['data']['channel_type'] = CHANNEL_TYPE_TIKTOK;
        $this->_items($conditions);
        $this->render();
    }

    private function _items($conditions, $itemPerPage = ITEM_PER_PAGE_14)
    {
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $sort_by = (int)$this->input->get('sort_by', TRUE);
        $orderBy = 'i.id DESC';
        if ($sort_by === 1) {
            $orderBy = 'i.count_d ASC';
        } elseif ($sort_by === 2) {
            $orderBy = 'i.count_d DESC';
        } elseif ($sort_by === 3) {
            $orderBy = 'i.count ASC';
        } elseif ($sort_by === 4) {
            $orderBy = 'i.count DESC';
        }
        $items = BusinessItem::getInstance()->getRangeCache($conditions, $offset, $itemPerPage, $orderBy);
        $total = BusinessItem::getInstance()->getCount($conditions);
        $pagination = Pagination::bootstrap($total, '', $itemPerPage, 'page', 5);
        $channelTypes = $this->config->config['params']['channel_types'];
        $this->temp['user'] = User::getAuthSession();
        $colorBg = ['#ffd6cc', '#ccf2ff', '#ccffee', '#ffffcc', '#ffd6cc'];
        $this->temp['page_title'] = 'Items list';
        $this->temp['data']['items'] = $items;
        $this->temp['data']['total'] = $total;
        $this->temp['data']['filters']['sort_by'] = $sort_by;
        $this->temp['data']['keywordColors'] = [];
        $this->temp['data']['pagination'] = $pagination;
        $this->temp['data']['channelTypes'] = $channelTypes;
        $this->temp['data']['types'] = $this->config->config['params']['types'];
        $this->temp['data']['colorBg'] = $colorBg;
        $this->temp['template'] = 'backend/monitoring/index';
    }


    private function getConditions()
    {
        $filterArr = array('type', 'to_date', 'from_date', 'keyword');
        $filterConditions = $this->input->get($filterArr, TRUE);
        $this->temp['data']['filters'] = $filterConditions;
        $this->temp['filters'] = $filterConditions;
        $conditions = array();
        foreach ($filterConditions as $key => $condition) {
            if ($condition) {
                if ($key === 'keyword') {
                    foreach ($condition as $item) {
                        $conditions[0][] = $this->getSimpleSearchCondition('i.keywords', $item);
                    }
                } elseif ($key === 'q') {
                    $conditions[0][] = $this->getSimpleSearchCondition('i.content', $condition);
                } elseif ($key === 'to_date') {
                    $conditions[] = array(sprintf('%s', 'i.craw_date <=') => $condition . " 23:59:50");
                } elseif ($key === 'from_date') {
                    $conditions[] = array(sprintf('%s', 'i.craw_date >=') => $condition . " 00:00:00");
                } else {
                    $conditions[] = array(sprintf('i.%s', $key) => $condition);
                }
            }
        }

        return $conditions;
    }

    public function detail($postId)
    {
        $colorBg = ['#ffd6cc', '#ccf2ff', '#ccffee', '#ffffcc', '#ffd6cc'];
        $group = BusinessItem::getInstance()->findByPostId($postId);
        // $social_item = BusinessSocialItem::getInstance()->findBySocialId($group['post_owner_id"']);

        if (($group->channel_type && $group->channel_type !== CHANNEL_TYPE_FACEBOOK) || !$group) {
            show_404('Post id không tồn tại');
        }
        if (empty($group)) {
            redirect(site_url('/backend/monitoring/index'));
        }
        $group->from_name = 'Detail list';
        //		$group->count_d = 100000;
        $data['page_title'] = $group->from_name;
        $data['is_page_detail'] = TRUE;
        // check permision
        $is_download = 10000;
        $group_data = array(
            'friend'       => array(),
            'follow'       => array(),
            'sex'          => array('female' => 0, 'male' => 0, 'Other' => 0),
            'relationship' => array(),
        );
        $total_records = $group->count_d;
        $group_data['email_count'] = 0;
        $group_data['birthday_count'] = 0;
        $group_data['relationship_count'] = 0;
        $group_data['fields_count'] = array();
        $data['group_data'] = $group_data;
        $current_user = $this->userInfo;
        $user_id = $current_user['id'];
        $data['user_id'] = $user_id;
        $data['items']['limit'] = 10;
        $data['items']['totals'] = $total_records;
        $data['items']['group_id'] = $group->post_id;
        $data['can_download'] = $is_download;
        $data['total_like'] = $group->total_like;
        $data['total_share'] = $group->total_share;
        $data['total_comment'] = $group->total_comment;
        $data['total'] = 1000;
        $data['content'] = (array)$group;
        $id = "1003543184091350";
        $fileName = "$id.json";
        // $fileName = "$group->post_id.json";
        $data['items']['numpages'] = ceil($total_records / ITEM_PER_PAGE_10);
        $fileContent = GoogleCloudStorage::getDataFileJson($fileName, BUCKET_NAME_ADSSPY);
        $profiles = [];
        $page = $this->input->get('page', TRUE);
        $limit = $this->input->get('limit', TRUE);
        $itemPerPage = ITEM_PER_PAGE_10;
        if ($limit) {
            $itemPerPage = $limit;
        }
        $user = $this->userInfo;

        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $count = $itemPerPage + $offset;
        foreach ($fileContent as $index => $profile) {
            if ($index >= $offset && $index < $count) {
                $profiles[] = $profile;
            }
            if ($index > $count) {
                break;
            }
        }
        $pagination = Pagination::bootstrap($group->count_d, '', $itemPerPage, 'page', 5);
        $data['interactions'] = $profiles;
        $data['pagination'] = $pagination;
        $this->temp['colorBg'] = $colorBg;
        $this->temp['page_title'] = 'Detail item';
        $this->temp['data'] = $data;
        $this->temp['template'] = 'backend/monitoring/uids';
        $this->render();
    }


    public function get_last_item()
    {
        $item = BusinessItem::getInstance()->findByLastUpdate();
        $types = $this->config->config['params']['types'];
        $html = $this->load->view('backend/clients/_item', ['item' => $item, 'is_animation' => TRUE, 'types' => $types], TRUE);
        $this->response(['html' => $html, 'success' => TRUE]);
    }

    public function getDataCity($postId)
    {
        $city = BusinessItem::getInstance()->getCountCities($postId);
        $group = BusinessItem::getInstance()->findByPostId($postId);
        $res = [
            'city'    => [],
            'success' => FALSE
        ];
        if ($city) {
            $res['success'] = TRUE;
            foreach ($city as $index => $count) {
                $group_count = 1;
                if ($group->count) {
                    $group_count = $group->count;
                }
                $count = round($count * 100 / $group_count);
                $res['city'][] = [$index, $count];
            }
        }
        echo json_encode($res);
        exit();
    }

    public function ajax()
    {
        $can_download = FALSE;
        $user = $this->userInfo;
        $get = $this->input->get();
        if ($user['role_id'] === ROLE_ADMIN || $user['role_id'] === ROLE_DOWNLOAD) {
            $can_download = TRUE;
        }
        if ($can_download === FALSE && isset($get['export'])) {
            $msg = 'You have not enough credit for download ';

            $data = array(
                'uids'       => "",
                'pagination' => "",
                'totals'     => "",
                'msg'        => $msg,
                'status'     => FALSE
            );
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }
        $group = BusinessItem::getInstance()->findByPostId($get['group_id']);
        $get['friend_start'] = '';
        $get['friend_end'] = '';
        $conditions = [];
        if ($get['friends']) {
            if ($get['friends'] == '> 5000') {
                $conditions['friend_start'] = 5001;
                $conditions['friend_end'] = '';
            } elseif ($get['friends'] == '<1000') {
                $conditions['friend_start'] = 0;
                $conditions['friend_end'] = 999;
            } else {
                $v = explode('-', $get['friends']);
                $conditions['friend_start'] = $v[0] + 1;
                $conditions['friend_end'] = $v[1];
            }
        }

        $get['follow_start'] = '';
        $get['follow_end'] = '';
        if (isset($get['follows']) && $get['follows']) {
            if ($get['follows'] == '> 5000') {
                $conditions['follow_start'] = 5001;
                $conditions['follow_end'] = '';
            } elseif ($get['follows'] == '<1000') {
                $conditions['follow_start'] = 0;
                $conditions['follow_end'] = 999;
            } else {
                $v = explode('-', $get['follows']);
                $conditions['follow_start'] = $v[0] + 1;
                $conditions['follow_end'] = $v[1];
            }
        }
        if ($get['city']) {
            $conditions['city'] = $get['city'];
        }
        if ($get['Sex']) {
            $conditions['sex'] = $get['Sex'];
        }
        $get['birthday'] = '';
        if ($get['ages']) {
            $conditions['birthday'] = explode('_', $get['ages']);
        }
        if ($get['type']) {
            if ($get['type'] === 'is_like') {
                $conditions['is_like'] = TRUE;
            }
            if ($get['type'] === 'is_comment') {
                $conditions['is_comment'] = TRUE;
            }
        }
        // check permision
        $totals = $group->count_d;
        $itemPerPage = $get['limit'];
        $page = $this->input->get('current_page', TRUE);
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        if (!$conditions) {
            $uids = BusinessItem::getInstance()->getRangeUids($get['group_id'], $offset, $itemPerPage);
            $stringUids = implode(',', array_column($uids, 'uid'));
            $uids = $this->get_info_uids($stringUids);
        } else {
            $res = BusinessItem::getInstance()->filterConditions($get['group_id'], $conditions);
            $total = $itemPerPage + $offset;
            $uids = [];
            for ($i = $offset; $i < $total; $i++) {
                if (!empty($res[$i])) {
                    $uids[] = $res[$i];
                }
            }
        }
        if (empty($uids)) {
            $data = array(
                'uids'       => "",
                'pagination' => "",
                'totals'     => "",
                'msg'        => 'No data',
                'status'     => TRUE
            );
            header('Content-Type: application/json');
            echo json_encode($data);
            exit;
        }
        //$account_type = $this->session->userdata('account_type');
        $token = BusinessXpath::getInstance()->findByConditions(['channel_type' => CHANNEL_TYPE_FACEBOOK_TOKEN], TRUE);
        if ($token) {
            $access_token = $token->xpath;
        } else {
            $access_token = FB_TOKEN;
        }
        $urlCheckToken = sprintf('https://graph.facebook.com/%s/picture?type=square&access_token=%s', $uids[0]->uid, $access_token);
        $res = json_decode(Common::getFileContent($urlCheckToken), FALSE);
        $tokenDie = FALSE;
        if (!empty($res->error)) {
            $tokenDie = TRUE;
        }
        foreach ($uids as $key => $uid) {
            $uids[$key]->Uid = $uid->uid;
            $uids[$key]->Name = $uid->name;
            $uids[$key]->Sex = $uid->sex;
            $uids[$key]->Relationship = $uid->relationship;
            if ($tokenDie === TRUE) {
                $url_thumb = '/assets/images/icon_person.png';
                if ($uid->sex === 'female') {
                    $url_thumb = '/assets/images/female.png';
                } elseif ($uid->sex === 'male') {
                    $url_thumb = '/assets/images/male.png';
                }
            } else {
                $url_thumb = sprintf('https://graph.facebook.com/%s/picture?type=square&access_token=%s', $uid->uid, $access_token);
            }
            $uids[$key]->url_thumb = $url_thumb;
            $uids[$key]->Phone_Original = '';
            if (isset($uids[$key]->phone)) {
                $uids[$key]->Phone_Original = $uids[$key]->phone;
            }
            $uids[$key]->email_Original = $uids[$key]->email;
            if ($can_download || !isset($get['export'])) {
                $uids[$key]->Phone = '';
                $uids[$key]->Phone2 = '';
                if (isset($uids[$key]->phone)) {
                    $uids[$key]->Phone = substr($uids[$key]->phone, 0, -4) . '****';
                    $uids[$key]->Phone2 = substr($uids[$key]->phone, 0, -4) . '****';
                }

                if (isset($uids[$key]->email)) {
                    $mail = explode('@', $uids[$key]->email);
                    $uids[$key]->email = '*****@' . $mail[1];
                }

                if (isset($uids[$key]->Birthday)) {
                    $uids[$key]->Birthday = $uids[$key]->birthday ? my_date_show($uids[$key]->birthday) : '';
                } else {
                    $uids[$key]->Birthday = '';
                }
                $uids[$key]->Friends = number_format($uids[$key]->friends);
                $uids[$key]->Follow = number_format($uids[$key]->follow);
                $uids[$key]->Location = "";
            }
        }
        if (!isset($get['export'])) {
            ob_start();
            helper_pagination(ceil($totals / $itemPerPage), $page);
            $pagination = ob_get_clean();
        } else {
            $pagination = '';
            //			if ($get['current_page'] == 1)
            //			{
            //				$download_time = update_user_download('Download list from group ' . $group->from_name . ', id ' . $group->post_id, $totals, $get);
            //				$user_data = $this->session->userdata();
            //				$user_data['download_time'] = $download_time;
            //				$this->session->set_userdata($user_data);
            //			}
        }

        $data = array(
            'uids'         => $uids,
            'pagination'   => $pagination,
            'totals'       => number_format($totals),
            'total_emails' => 0,
            'status'       => TRUE
        );

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function get_info_uids($uids, $limit = '')
    {
        $nameCache = 'getCountRangeUids_v_' . $uids;
        $nameCache .= '.cache';
        $res = $this->cache->get($nameCache);
        if ($res) {
            return $res;
        }
        //		$apiUrl = URL_API_FLASH . 'uids?email=%s&pass=%s&token=%s&uids=%s&db=' . DB_NAME_SELECT_API;
        $apiUrl = URL_API_FLASH . 'uids?email=%s&pass=%s&token=%s&uids=%s&db=';
        $email = USER_API_FLASH;
        $pass = PASSWORD_API_FLASH;
        $token = USER_TOKEN_API;
        $apiUrl = sprintf($apiUrl, $email, $pass, $token, $uids);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $content = json_decode($server_output);
        if (isset($content->data)) {
            if ($content->data) {
                $this->cache->save($nameCache, $content->data, 3600);
            }
            return $content->data;
        }
        if (isset($content->mesage)) {
            return $content->message;
        }
        return [];
    }

    public function reports()
    {
        $params = $this->input->get('keyword', TRUE);
        $types = $this->config->config['params']['types'];
        $res = [];
        $conditions = $this->getConditions();
        $conditionKeyword  = $conditions;
        $total_posts = 0;
        $total_socials = 0;
        $item['count_like_share'] = 0;
        $item['count_comment'] = 0;
        $item['total_comment'] = 0;
        $item['total_share'] = 0;
        $item['total_like'] = 0;
        $nameCache = 'getTotalPost_' . http_build_query($params ?: []);
        foreach ($types as $type) {
            $total_post = 0;
            $total_social = 0;
            if ($params) {
                $nameCache .= $type['value'];
                $conditions[1] = ['type' => $type['value']];
            } else {
                $conditions[0] = ['type' => $type['value']];
            }
            $nameCache .= http_build_query($conditions);
            $totalData = BusinessItem::getInstance()->getTotalPost($conditions, $nameCache);

            if ($totalData) {
                $total_post = $totalData->total_post;
                $total_social = $totalData->total_social;
                $total_posts += $totalData->total_post;
                $total_socials += $totalData->total_social;
                $item['count_like_share'] += $totalData->count_like_share;
                $item['count_comment'] += $totalData->count_comment;
                $item['total_comment'] += $totalData->total_comment;
                $item['total_share'] += $totalData->total_share;
                $item['total_like'] += $totalData->total_like;
            }

            $res['posts'][] = [
                'className' => 'custom',
                'value'     => $total_post,
                'meta'      => ['color' => $type['color']],
                'label'     => $type['name']
            ];
            $res['socials'][] = [
                'className' => 'custom',
                'value'     => $total_social,
                'meta'      => ['color' => $type['color']],
                'label'     => $type['name']
            ];
        }
        $channelTypes = $this->config->config['params']['channel_types'];
        $totalPostByChannelType  = BusinessItem::getInstance()->getTotalPostByChannel($conditionKeyword);
        if ($totalPostByChannelType) {
            foreach ($totalPostByChannelType as $v) {
                $res['channelTypes'][] = [
                    'className' => 'custom',
                    'value'     => $v->number,
                    'meta'      => ['color' => $channelTypes[$v->channel_type]['color']],
                    'label'     => $channelTypes[$v->channel_type]['name']
                ];
            }
        } else {
            foreach ($channelTypes as $v) {
                $res['channelTypes'][] = [
                    'className' => 'custom',
                    'value'     => 0,
                    'meta'      => ['color' => $v['color']],
                    'label'     => $v['name']
                ];
            }
        }
        $conditionsEmail = $conditionKeyword;
        $conditionsEmail[]['email is not null'] = NULL;
        $conditionsBirthDay = $conditionKeyword;
        $conditionsBirthDay[]['birthday is not null'] = NULL;
        $conditionsBirthDayRelationShip = $conditionKeyword;
        $conditionsBirthDayRelationShip[]['relationship is not null'] = NULL;
        $totalEmail = BusinessInteraction::getInstance()->getCount($conditionsEmail, 'i');
        $totalBirthDay = BusinessInteraction::getInstance()->getCount($conditionsBirthDay, 'i');
        $totalRelationShip = BusinessInteraction::getInstance()->getCount($conditionsBirthDayRelationShip, 'i');
        $this->temp['data']['ages'] = [
            '0'  => 176858,
            '18' => 204,
            '25' => 7514,
            '35' => 2271,
            '45' => 215,
            '55' => 78,
            '65' => 139
        ];
        $this->temp['page_title'] = 'Reports';
        $this->temp['item'] = (object)$item;
        $this->temp['posts'] = $res['posts'];
        $this->temp['socials'] = $res['socials'];
        $this->temp['channelTypes'] = $res['channelTypes'];
        $this->temp['total_posts'] = $total_posts;
        $this->temp['total_social'] = $total_socials;
        $this->temp['data']['totalEmail'] = $totalEmail;
        $this->temp['data']['totalBirthDay'] = $totalBirthDay;
        $this->temp['data']['totalRelationShip'] = $totalRelationShip;
        $this->temp['template'] = 'backend/monitoring/reports';
        $this->render();
    }

    public function password()
    {
        $data = array();
        $this->temp['page_title'] = 'Change password';
        $data['msg'] = '';
        $post = $this->input->post(['current_password', 'new_password', 'confirm_password'], TRUE);
        $this->temp['template'] = 'backend/clients/password';
        if ($this->input->post()) {
            $currentPassCorrect = BusinessUser::getInstance()->checkAuth($this->userInfo['email'], $post['current_password']);

            if (!$currentPassCorrect) {
                $this->session->set_flashdata('error_msg', 'Current password is not correct.');
                $this->temp['data'] = $data;
                $this->render();
                return FALSE;
            }
            if ($post['new_password'] !== $post['confirm_password']) {
                $this->session->set_flashdata('error_msg', 'Confirm password and password mismatch.');
                $this->temp['data'] = $data;
                $this->render();
                return FALSE;
            }
            $data['password'] = password_hash($post['new_password'], PASSWORD_BCRYPT);
            BusinessUser::getInstance()->update($this->userInfo['id'], $data, FALSE);
            $this->session->set_flashdata('msg', 'Your password has been updated successfully.');
        }
        $this->temp['data'] = $data;
        $this->render();
    }

    public function download()
    {
        $user = $this->userInfo;
        if ($user['role_id'] !== ROLE_ADMIN && $user['role_id'] !== ROLE_DOWNLOAD) {
            $this->response(['status' => FALSE, 'msg' => 'Permission denied']);
        }

        $conditions = $this->getConditions();
        $conditions[]['i.channel_type'] = FALSE;
        $itemPerPage = $this->input->get('limit', TRUE);
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $sort_by = (int)$this->input->get('sort_by', TRUE);
        $orderBy = 'i.id DESC';
        if ($sort_by === 1) {
            $orderBy = 'i.count_d ASC';
        } elseif ($sort_by === 2) {
            $orderBy = 'i.count_d DESC';
        } elseif ($sort_by === 3) {
            $orderBy = 'i.count ASC';
        } elseif ($sort_by === 4) {
            $orderBy = 'i.count DESC';
        }
        $items = BusinessItem::getInstance()->getRangeCache($conditions, $offset, $itemPerPage, $orderBy);
        $this->response(['uids' => $items, 'status' => TRUE]);
    }
}
