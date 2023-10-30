<?php

namespace app\common\business;

use app\models\Item;
use app\models\Interaction;

class BusinessApi {
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessApi object
	 */
	public static function getInstance()
	{
		if (self::$_instance === NULL)
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function createTableAndSaveData($postId, $data)
	{
		$isCreated = $this->createTableV($postId);
		//$isCreated = TRUE;
		$isSuccess = FALSE;
		if ($isCreated)
		{
			$res = [];
			$keywordComments = [];
			if ($data)
			{
				foreach ($data as $i)
				{
					$res[] = [
						'is_comment'   => TRUE,
						'keywords'     => $i['Keywords'],
						'updated_date' => date(DATE_TIME_FORMAT),
						'content'      => json_encode($i),
						'uid'          => $i['OwnerId']
					];
					$keywordComments = array_merge(explode(',', $i['Keywords']), $keywordComments);
				}
				if ($res)
				{
					//$CI =&get_instance();
					/**
					 * @var $dbObj \CI_DB_query_builder
					 */
					//$dbObj = $CI->db;
					//$tableName = 'v_'.$postId;
					//$dbObj->insert_batch($tableName,$res);
					//Item::clearCache();
					//$error =$dbObj->error();
					//if (!$error['code'])
					//{
					$keywordComments = array_unique($keywordComments);
					$isSuccess = implode(',', $keywordComments);
					//}
				}
			} else
			{
				$isSuccess = TRUE;
			}

		}
		return $isSuccess;
	}

	public function handle_file($post_id, $uids, $type)
	{
		$data = [];
		$CI = &get_instance();
		foreach ($uids as $uid)
		{
			$data[] = [
				'uid'        => $uid,
				'is_share'   => FALSE,
				'is_like'    => FALSE,
				'is_comment' => FALSE,
			];
		}
		if ($data)
		{
			$this->createTableV($post_id);
			$CI->db->insert_batch('v_' . $post_id, $data, TRUE, count($data));
		}
		$stringUids = implode(',', $uids);
		$uids = $this->getInfoUids($stringUids);
		if ($uids)
		{
			$data = [];
			foreach ($uids as $uid)
			{
				$data[] = [
					'uid'         => $uid->uid,
					'is_' . $type => TRUE
				];
			}
			$CI->db->update_batch('v_' . $post_id, $data, 'uid', count($data));
		}
	}

	public function getInfoUids($stringUids)
	{
		$apiUrl = URL_API_FLASH . 'uids?%s';
		$queryParams = [
			'email' => USER_API_FLASH,
			'pass'  => PASSWORD_API_FLASH,
			'token' => USER_TOKEN_API,
			//				'uids'  => $stringUids
		];
		$apiUrl = sprintf($apiUrl, http_build_query($queryParams));
		$paramQuery = http_build_query(['uids' => $stringUids]);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $apiUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $paramQuery);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$content = curl_exec($ch);
		if (curl_errno($ch))
		{
			echo "\nURL: " . $apiUrl . " Error is : " . curl_error($ch) . "\n";
		}
		curl_close($ch);
		$content = json_decode($content);
		if (isset($content->data))
		{
			return $content->data;
		}
		echo json_encode($content);
		die();
	}

	/**
	 * @param $post_id
	 * @param $uids
	 * @param $postInfo
	 */
	public function getInfoInteractions($post_id, $uids, $postInfo)
	{
		$data = [];
		$CI = &get_instance();
		$dataInteractions = [];
		foreach ($uids as $item)
		{
			foreach ($item as $uid)
			{
				$data[$uid] = [
					'uid'        => $uid,
					'is_share'   => FALSE,
					'is_like'    => FALSE,
					'is_comment' => FALSE,
				];
				$dataInteractions[$uid] = $uid;
			}
		}
		$stringUids = implode(',', $dataInteractions);
		$dataInteractions = $this->getInfoUids($stringUids);
		try
		{
			trans_begin();
			if ($dataInteractions)
			{
				foreach ($dataInteractions as $index => $uidInfo)
				{
					$uidInfo->is_comment = FALSE;
					$uidInfo->is_share = FALSE;
					$uidInfo->is_like = FALSE;
					$uid = $uidInfo->uid;
					if (in_array($uid, $uids['comment']))
					{
						$data[$uid]['is_comment'] = TRUE;
						$uidInfo->is_comment = TRUE;
					} elseif (in_array($uid, $uids['like']))
					{
						$data[$uid]['is_like'] = TRUE;
						$uidInfo->is_like = TRUE;
					} elseif (in_array($uid, $uids['share']))
					{
						$data[$uid]['is_share'] = TRUE;
						$uidInfo->is_share = TRUE;
					}
					$dataInteractions[$index] = (array)$uidInfo;
					$dataInteractions[$index]['keywords'] = $postInfo->keywords;
					$dataInteractions[$index]['created_date'] = date('Y-m-d');
					$dataInteractions[$index]['post_id'] = $postInfo->post_id;
				}
				Interaction::insertBatch($dataInteractions);
			}

			if ($data)
			{
				$this->createTableV($post_id);
				$CI->db->insert_batch('v_' . $post_id, $data, TRUE, count($data));
			}
			trans_end();
		} catch (\Exception $e)
		{
			trans_rollback();
			echo "<pre>";
			print_r($e->getMessage());
			die;
		}

	}


	public function createTableV($postId)
	{
		$number = preg_replace("/[^0-9]/", '', $postId);
		$sql = "CREATE TABLE IF NOT EXISTS   `v_" . $number . "`  (
          			`uid` bigint(20) UNSIGNED PRIMARY KEY,
				  `is_share` int(10) NOT NULL DEFAULT 0,
				  `is_like` int(10) NOT NULL DEFAULT 0,
				  `is_comment` int(10) NOT NULL DEFAULT 0
	 )";
		$CI = &get_instance();
		return $CI->db->query($sql);
	}

	/**
	 * @param $postId
	 * @param $conditions
	 * @return int
	 */
	public function countByConditions($postId, $conditions)
	{
		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		$CI = &get_instance();
		$dbObj = $CI->db;
		return $dbObj->from('v_' . $postId)->where($conditions)->count_all_results();
	}

	/**
	 * @param $postId
	 * @param $conditions
	 * @return int
	 */
	public function countALLTableV($postId)
	{
		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		$CI = &get_instance();
		$dbObj = $CI->db;
		return $dbObj->from('v_' . $postId)->distinct()->count_all_results();
	}
}