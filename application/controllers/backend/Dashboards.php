<?php

use app\common\business\BusinessInteraction;
use app\common\business\BusinessItem;
use app\common\business\BusinessKeyword;
use app\common\business\BusinessSocialItem;
use app\common\utilities\Common;
use app\common\business\BusinessUser;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\models\Item;

class Dashboards extends BackendController
{
    public function index()
    {
        $itemPerPage = DEFAULT_ITEM_PER_PAGE;
        $conditions = $this->getConditions();
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $users = BusinessUser::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
        $total = BusinessUser::getInstance()->getCount($conditions);
        $pagination = Pagination::bootstrap($total, '', $itemPerPage);
        $totalSocial = array();
        $totalKeywords = $this->getKeywordsCount();
        $totalAudience = $this->getAudienceCount();
        $totalMentions = $this->getMentionsCount();
        $topKey = $this->getTopKey();
        $totalSocial['Total Mentions'] = $totalMentions;
        $totalSocial['Total Audience'] = $totalAudience;
        $totalSocial['Total Keywords'] = $totalKeywords;
        $totalSocial['Total User Engage'] = $totalAudience;
        $this->temp['data']['totalSocial'] = $totalSocial;
        $this->temp['data']['users'] = $users;
        $this->temp['data']['topKey'] = $topKey;
        $this->temp['data']['pagination'] = $pagination;
        $this->temp['template'] = 'backend/dashboards/index';
        $this->render();
    }

    private function getConditions()
    {
        $modelUser = BusinessUser::getModel();
        $filterArr = array('role_id', 'keyword');
        $filterConditions = $this->input->get($filterArr, TRUE);
        $conditions = array();
        foreach ($filterConditions as $key => $condition) {
            if ($condition) {
                if ($key === 'keyword') {
                    $conditions[] = [
                        $this->getSimpleSearchCondition($modelUser::tableName() . '.email'),
                        $this->getSimpleSearchCondition($modelUser::tableName() . '.phone'),
                        $this->getSimpleSearchCondition($modelUser::tableName() . '.name')
                    ];
                } else {
                    $conditions[] = array(sprintf('%s.%s', $modelUser::tableName(), $key) => $condition);
                }
            }
        }
        return $conditions;
    }
    public function getKeywordsCount()
    {
        $itemPerPage = DEFAULT_ITEM_PER_PAGE;
        $getConditionsKeys = $this->getConditionsKeys();
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $keywords = BusinessKeyword::getInstance()->getRangeCache($getConditionsKeys, $offset, $itemPerPage);
        $totalKeywords = 0;
        foreach ($keywords as $item) {
            $totalKeywords += substr_count($item->keyword, ',');
        }
        if ($totalKeywords != 0) {
            $totalKeywords += 1;
        }
        return $totalKeywords;
    }
    private function getConditionsKeys()
    {
        $modelDbSetting = BusinessKeyword::getModel();
        $filterArr = array('status_api', 'uid', 'email', 'keyword');
        $filterConditions = $this->input->get($filterArr, TRUE);
        $getConditionsKeys = array();
        foreach ($filterConditions as $key => $getConditionsKey) {
            if ($key === 'keyword') {
                $getConditionsKeys[] = $this->getSimpleSearchCondition($modelDbSetting::tableName() . '.phone');
            } elseif ($getConditionsKey === '0' || $getConditionsKey) {
                $getConditionsKeys[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $getConditionsKey);
            }
        }
        return $getConditionsKeys;
    }
    public function getAudienceCount()
    {
        $filterArr = array('keywords', 'from_date', 'to_date', 'uid');
        $filterConditions = $this->input->get($filterArr, TRUE);
        $conditions = array();
        foreach ($filterConditions as $key => $condition) {
            if ($condition) {
                if ($key === 'keyword') {
                    $keywords = explode(',', $condition);
                    foreach ($keywords as $item) {
                        $conditions[0][] = $this->getSimpleSearchCondition('keywords', $item);
                    }
                } elseif ($key === 'to_date') {
                    $conditions[] = array(sprintf('%s', 'DATE(created_date) <=') => $condition);
                } elseif ($key === 'from_date') {
                    $conditions[] = array(sprintf('%s', 'DATE(created_date) >=') => $condition);
                } else {
                    $conditions[] = array(sprintf('%s', $key) => $condition);
                }
            }
        }
        $itemPerPage = ITEM_PER_PAGE_20;
        $conditions = $this->getConditions();
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $items = BusinessInteraction::getInstance()->getRangeCache($conditions, $offset, $itemPerPage, 'id DESC');
        $total = BusinessInteraction::getInstance()->getCount($conditions);
        return $total;
    }
    public function getMentionsCount()
    {
        $modelDbSetting = BusinessSocialItem::getModel();
        $filterArr = array('social_id', 'type', 'keyword', 'status', 'channel_type');
        $filterConditions = $this->input->get($filterArr, TRUE);
        $conditions = array();
        foreach ($filterConditions as $key => $condition) {
            if ($key === 'keyword') {
                $conditions[] = $this->getSimpleSearchCondition($modelDbSetting::tableName() . '.name');
            } elseif ($condition === '0' || $condition) {
                $conditions[] = array(sprintf('%s.%s', $modelDbSetting::tableName(), $key) => $condition);
            }
        }
        $itemPerPage = DEFAULT_ITEM_PER_PAGE;
        $conditions = $this->getConditions();
        $page = intval($this->input->get('page', TRUE));
        $offset = $page ? $itemPerPage * ($page - 1) : 0;
        $items = BusinessSocialItem::getInstance()->getRangeCache($conditions, $offset, $itemPerPage);
        $total = BusinessSocialItem::getInstance()->getCount($conditions);
        return $total;
    }
    public function denied()
    {
        $this->temp['template'] = '/backend/dashboards/denied';
        $this->render();
    }
    public function getTopKey()
    {
        $conditions = array();
        $items = BusinessItem::getInstance()->getRangeCache($conditions);
        $keywords = BusinessKeyword::getInstance()->getRangeCache($conditions);
        $allKey = array();
        foreach ($keywords as $item) {
            $allKey = $item->keyword;
        }
        $allKey = explode(',', $allKey);
        $topKey = array();
        foreach ($allKey as $key => $value) {
            $oneKey = array();
            $count = 0;
            $engage = 0;
            foreach ($items as $item) {
                if (!strpos($item->keywords, $value)) {
                    $count++;
                    $engage += ($item->total_share + $item->total_like + $item->total_comment);
                }
            }
            $oneKey['key'] = $value;
            $oneKey['count'] = $count;
            $oneKey['engage'] = $engage;
            $topKey[$key] = $oneKey;
        }
        usort($topKey, function ($a, $b) {
            return (int)($a['count'] <= $b['count']);
        });
        $top = array();
        foreach ($topKey as $key => $item) {
            if ($key <= 9) {
                $top[$key] = $item;
            }
        }
        return $top;
    }
}
