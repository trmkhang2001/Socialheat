<?php

use app\common\utilities\Common;
use app\common\utilities\Pagination;
use app\controllers\backend\BackendController;

class Config extends BackendController {


	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$channelTypes = $this->config->config['params']['channel_types'];
		$this->temp['data']['channelTypes'] = $channelTypes;
		$this->temp['data']['types'] = $this->config->config['params']['types'];
		$this->temp['template'] = 'backend/config/index';
		$this->render();
	}


}
