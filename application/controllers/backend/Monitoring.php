<?php

use app\common\utilities\Common;
use app\common\utilities\GoogleCloudStorage;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessItem;
use app\common\business\BusinessXpath;
use app\models\User;
use app\common\business\BusinessInteraction;
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

        $data['content'] = (array)$group;
        $id = "1003543184091350";
        $fileName = "$id.json";
        // $fileName = "$group->post_id.json";
        $fileContent = GoogleCloudStorage::getDataFileJson($fileName, BUCKET_NAME_ADSSPY);
        $profiles = [];
        $page = $this->input->get('page', TRUE);
        $limit = $this->input->get('limit', TRUE);
        $itemPerPage = ITEM_PER_PAGE_10;
        if ($limit) {
            $itemPerPage = $limit;
        }
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



	public function downloads($id){
		$user = $this->userInfo;
		if($user['role_id'] !== ROLE_ADMIN && $user['role_id'] !== ROLE_DOWNLOAD){
			$this->response(['status' => FALSE, 'msg' => 'Permission denied']);
		}
		$item = BusinessItem::getInstance()->findOne($id);
		if($item){
			$fileName = "$item->post_id.json";
			$interactions = GoogleCloudStorage::getDataFileJson($fileName, BUCKET_NAME_ADSSPY);
			$filePath = 'downloads/' . sprintf('SocialHeat-%s.csv',time());
			$out = fopen($filePath, 'wb');
			fwrite($out, "\xEF\xBB\xBF");       // Write UTF-8 BOM
			fputcsv($out, ['Social Profile URL', 'Name', 'Gender', 'Phone', 'Email', 'Location', 'Relationship']);
			foreach ($interactions as $interaction) {
				fputcsv(
					$out,
					[
						'https://www.facebook.com/'.$interaction['uid'],
						$interaction['name'],
						$interaction['sex'],
						$interaction['phone'],
						$interaction['email'],
						$interaction['city'],
						$interaction['relationship'],
					]
				);
			}
			fclose($out);
			$fileName = sprintf('SocialHeat-%s.csv', date('Y-m-d-H:i:s'));
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $fileName);
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize($filePath));
			ob_clean();
			flush();
			readfile($filePath);
			@unlink($filePath);
			exit();
		}
	}

}
