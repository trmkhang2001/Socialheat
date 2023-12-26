<?php

use app\common\business\BusinessApi;
use app\common\business\BusinessApp;
use app\common\business\BusinessInteraction;
use app\common\business\BusinessInterface;
use app\common\business\BusinessItem;
use app\common\business\BusinessKeyword;
use app\common\business\BusinessSocialItem;
use app\common\utilities\Common;
use app\common\business\BusinessUser;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;
use app\models\Interaction;
use app\models\Item;
use app\models\User;

class Dashboards extends BackendController
{
	public function index()
	{
		$user = BusinessUser::getInstance()->getCount();
		$app = BusinessApp::getInstance()->getCount();
		$this->temp['data']['user_total'] = $user;
		$this->temp['data']['app_total'] = $app;
		$chartInteractions = $this->_getChartInteractionByType();
		$chartPosts = $this->_getChartPostByRangeDate();
		$this->temp['data']['chartInteractions'] = $chartInteractions;
		$this->temp['data']['chartPosts'] = $chartPosts;
		$this->temp['template'] = 'backend/dashboards/index';
		$this->render();
	}


	private function _getChartPostByRangeDate()
	{
		$charts = [];
		return $charts;
	}

	private function _getChartInteractionByType()
	{
		$charts = [];
		return $charts;
	}
}
