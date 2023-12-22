<?php

use app\common\business\BusinessBrand;
use app\common\business\BusinessItem;
use app\controllers\backend\BackendController;


class KeywordBrand extends BackendController
{
    public function index()
    {
        $totalMentions = BusinessBrand::getInstance()->getCount();
        $totalEngage = BusinessItem::getInstance()->getTotalUserEngage();
        $totalData = BusinessItem::getInstance()->getTotalCountD();
        $total = array(
            'totalMentions' => $totalMentions,
            'totalEngage' => $totalEngage,
            'totalData' => $totalData,
        );
        $chartRate = $this->_getChartRateByRangeDate();
        $chartSentiment = $this->_getChartSentimentByRate();
        $this->temp['data']['chartRate'] = $chartRate;
        $this->temp['data']['chartSentiment'] = $chartSentiment;
        $this->temp['data']['total'] = $total;
        $this->temp['template'] = 'backend/keyword_brand/index';
        $this->render();
    }
    private function _getChartRateByRangeDate()
    {
        $posts_item = BusinessBrand::getInstance()->getRateByRangeDate();
        $posts = array_reverse($posts_item);
        $charts = [];
        foreach ($posts as $post) {
            $charts['label'][] = date('d/m', strtotime($post->date_format));
            $charts['positive'][] = $post->count_positive ?? 0;
            $charts['negative'][] = $post->count_negative ?? 0;
            $charts['neutral'][] = $post->count_neutral ?? 0;
        }
        return $charts;
    }
    private function _getChartSentimentByRate()
    {
        $sentiment = BusinessBrand::getInstance()->getTotalSentimentByRate();
        $charts = [];
        $label = ['POSITIVE', 'NEGATIVE', 'NEUTRAL'];
        if ($sentiment) {
            $charts['label'] = $label;
            $charts['data'][] = $sentiment['0']->total_posivite ?? 0;
            $charts['data'][] = $sentiment['0']->total_negative ?? 0;
            $charts['data'][] = $sentiment['0']->total_neutral ?? 0;
        }
        return $charts;
    }
}
