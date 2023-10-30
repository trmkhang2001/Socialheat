<?php

use app\controllers\backend\ApiController;

class Posts extends ApiController {

	public function __construct()
	{
		parent::__construct();
		$this->authRequire();
	}

	public function index()
	{
		$uids = $this->input->get('uids', TRUE);
		$listUids = explode(',', $uids);
		$db = $this->input->get('db', TRUE);
		if ($listUids)
		{
			if ($db)
			{
				$db = explode(',', $db);
				$dbSettings = BusinessDbSetting::getInstance()->findByDatabaseName($db);
				if (empty($dbSettings))
				{
					$this->response(['message' => 'DB Không tồn tại'], 404);
				}
			} else
			{
				$dbSettings = BusinessDbSetting::getInstance()->getRangeCache(['status' => STATUS_ACTIVE]);
			}
			$res = [];
			$limit = count($listUids);
			if ($dbSettings)
			{
				foreach ($dbSettings as $dbInfo)
				{
					$data = BusinessDbSetting::getInstance()->findByKey($listUids, $dbInfo, $limit, 'uid');
					if ($data)
					{
						$res = $data;
						BusinessLogs::getInstance()->saveLogs($data, $uids, $this->auth->id, 'uid');
					}
				}
				$this->data['data'] = $res;
			}
			$this->response_success($this->data);
		}
	}
}