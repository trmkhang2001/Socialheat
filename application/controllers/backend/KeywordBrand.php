<?php


use app\controllers\backend\BackendController;


class KeywordBrand extends BackendController
{
    public function index()
    {
        $this->temp['template'] = 'backend/keyword_brand/index';
        $this->render();
    }
}
