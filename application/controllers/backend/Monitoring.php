<?php

use app\common\business\BusinessCrm;
use app\common\utilities\Common;
use app\common\utilities\GoogleCloudStorage;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\common\business\BusinessItem;
use app\common\business\BusinessXpath;
use app\models\User;
use app\common\business\BusinessInteraction;
use app\common\business\BusinessMissInteraction;
use app\common\business\BusinessSocialItem;
use app\common\business\BusinessUser;
use app\models\CRM;

class Monitoring extends BackendController
{
    public function index()
    {
        $itemPerPage = ITEM_PER_PAGE_14;
        $conditions = $this->getConditions();
        $conditions[]['i.channel_type'] = FALSE;
        $this->_items($conditions, $itemPerPage);
        $this->temp['data']['channel_type'] = CHANNEL_TYPE_FACEBOOK;
        $this->temp['template'] = 'backend/monitoring/index';
        $this->render();
    }


    public function clear_cache()
    {
        BusinessInteraction::getModel()->clearCache();
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
    public function getMissInteraction($item_id, $itemPerPage = ITEM_PER_PAGE_14)
    {
        $itemPerPage = ITEM_PER_PAGE_14;
        $conditions = array();
        $conditions[] = array(sprintf('i.%s', 'item_id') => $item_id);
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $missinteraction = BusinessMissInteraction::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
        $total = BusinessMissInteraction::getInstance()->getCount($conditions);
        $pagination = Pagination::bootstrap($total, '', $itemPerPage, 'page', 5);
        $data['missinteraction'] = $missinteraction;
        $data['misspagination'] = $pagination;
        return $data;
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
                    $conditions[] = array(sprintf('%s', 'i.craw_date <') => $condition . " 23:59:50");
                } elseif ($key === 'from_date') {
                    $conditions[] = array(sprintf('%s', 'i.craw_date >') => $condition . " 00:00:00");
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
        $item = BusinessItem::getInstance()->findByPostId($postId);
        if (($item->channel_type && $item->channel_type !== CHANNEL_TYPE_FACEBOOK) || !$item) {
            show_404('Post id không tồn tại');
        }
        if (empty($item)) {
            redirect(site_url('/backend/monitoring/index'));
        }
        $data['content'] = (array)$item;
        $fileName = "$item->post_id.json";
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
        $crm = BusinessCrm::getInstance()->getAllPhone();
        foreach ($fileContent as $index => $profile) {
            if ($index >= $offset && $index < $count) {
                if (in_array($profile['phone'], $crm, TRUE)) {
                    $profile['crm'] = TRUE;
                } else {
                    $profile['crm'] = FALSE;
                }
                $profiles[] = $profile;
            }
            if ($index > $count) {
                break;
            }
        }
        $total['totalMail'] = !empty($item->totalMail) ? $item->totalMail : 0;
        $total['totalLocation'] = !empty($item->totalLocation) ? $item->totalLocation : 0;
        $total['totalRelationship'] = !empty($item->totalRelationship) ? $item->totalRelationship : 0;
        $charts =  !empty($item->charts) ? json_decode($item->charts, TRUE) : [];
        $pagination = Pagination::bootstrap($item->count_d, '', $itemPerPage, 'page', 5);
        $data['interactions'] = $profiles;
        $data['pagination'] = $pagination;
        $this->temp['colorBg'] = $colorBg;
        $this->temp['page_title'] = 'Detail item';
        $this->temp['data'] = $data;
        $this->temp['total'] = $total;
        $this->temp['charts'] = $charts['charts'] ?? [];
        $this->temp['template'] = 'backend/monitoring/uids';
        $this->render();
    }



    public function downloads($id)
    {
        $user = $this->userInfo;
        if ($user['role_id'] !== ROLE_ADMIN && $user['role_id'] !== ROLE_DOWNLOAD) {
            $this->response(['status' => FALSE, 'msg' => 'Permission denied']);
        }
        $item = BusinessItem::getInstance()->findOne($id);
        if ($item) {
            $fileName = "$item->post_id.json";
            $interactions = GoogleCloudStorage::getDataFileJson($fileName, BUCKET_NAME_ADSSPY);
            $filePath = 'downloads/' . sprintf('SocialHeat-%s.csv', time());
            $out = fopen($filePath, 'wb');
            fwrite($out, "\xEF\xBB\xBF");       // Write UTF-8 BOM
            fputcsv($out, ['Social Profile URL', 'Name', 'Gender', 'Phone', 'Email', 'Location', 'Relationship']);
            foreach ($interactions as $interaction) {
                fputcsv(
                    $out,
                    [
                        'https://www.facebook.com/' . $interaction['uid'],
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
