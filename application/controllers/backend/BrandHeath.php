<?php

use app\common\business\BusinessBrand;
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
use app\models\Brand;
use app\models\CRM;
use app\models\MissInteraction;

class BrandHeath extends BackendController
{
    public function index()
    {
        $itemPerPage = ITEM_PER_PAGE_14;
        $conditions = $this->_getConditions();
        $conditions[]['i.channel_type'] = FALSE;
        $this->_items($conditions, $itemPerPage);
        $this->temp['data']['channel_type'] = CHANNEL_TYPE_FACEBOOK;
        $this->temp['template'] = 'backend/brand/index';
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
        $new_items = [];
        foreach ($items as $item) {
            $keywords = explode(',', $item->keywords);
            foreach ($keywords as $keyword) {
                $item->keyword = $keyword;
                $item->rate = BusinessBrand::getInstance()->findRateByKeywordItemId($item->keyword, $item->id);
                if (isset($item->rate['error'])) {
                    $this->session->set_flashdata('error', $item->rate['message']);
                    $this->session->keep_flashdata('error');
                    break;
                } else {
                    $new_items[] = $item;
                }
            }
            if (isset($item->rate['error'])) {
                break;
            }
        }
        $total = BusinessItem::getInstance()->getCount($conditions);
        $pagination = Pagination::bootstrap($total, '', $itemPerPage, 'page', 5);
        $channelTypes = $this->config->config['params']['channel_types'];
        $this->temp['user'] = User::getAuthSession();
        $colorBg = ['#ffd6cc', '#ccf2ff', '#ccffee', '#ffffcc', '#ffd6cc'];
        $this->temp['page_title'] = 'Items list';
        $this->temp['data']['items'] = $new_items;
        $this->temp['data']['total'] = $total;
        $this->temp['data']['filters']['sort_by'] = $sort_by;
        $this->temp['data']['keywordColors'] = [];
        $this->temp['data']['pagination'] = $pagination;
        $this->temp['data']['channelTypes'] = $channelTypes;
        $this->temp['data']['types'] = $this->config->config['params']['types'];
        $this->temp['data']['colorBg'] = $colorBg;
        $this->temp['template'] = 'backend/brand/index';
    }

    private function _getConditions()
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
