<?php

use app\common\business\BusinessApi;
use app\common\business\BusinessCommentLog;
use app\common\business\BusinessItem;
use app\common\business\BusinessKeyword;
use app\common\business\BusinessSocialItem;
use app\common\business\BusinessXpath;
use app\controllers\backend\ApiController;
use app\common\utilities\GoogleCloudStorage;
use app\common\utilities\Common;
use app\models\Interaction;
use app\common\components\Finduid;
use app\models\MissInteraction;

class Api extends ApiController {

	public function __construct()
	{
		parent::__construct();
		$this->checkAuth();
	}

	public function social_items()
	{
		$key = $this->input->get('key', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$type = $this->input->get('type', TRUE);
		$page = intval($this->input->get('page', TRUE));
		$channel_type = $this->input->get('channel_type', TRUE);
		$isPrivate = $this->input->get('is_private',TRUE);
		$keywords = BusinessKeyword::getInstance()->getAllCache();
		$conditions = [];
		if ($type)
		{
			$conditions['type'] = $type;
		}
		if ( ! $limit)
		{
			$limit = ITEM_PER_PAGE_100;
		}
		if ( ! $channel_type)
		{
			$channel_type = CHANNEL_TYPE_FACEBOOK;
		}
		if($isPrivate){
			$conditions['is_private'] = (bool)$isPrivate;
		}
		$conditions['channel_type'] = $channel_type;
		$offset = $page ? $limit * ($page - 1) : 0;
		$conditions['key IS NULL'] = NULL;
		$conditions['status'] = STATUS_ACTIVE;
		$items = BusinessSocialItem::getInstance()->getRangeCache($conditions, $offset, $limit);
		if ($items)
		{
			$updateIds = [];
			//			$res['keywords'] = $keywords->keyword;
			$res = [];
			foreach ($items as $item)
			{
				$updateIds[] = [
					'id' => $item->id,

					'key' => $key
				];
				$res[] = [
					'Id'        => $item->id,
					'FbId'      => $item->social_id,
					'FbType'    => $item->type,
					'IsPrivate' => (bool)$item->is_private,
					'Token'		=> $item->token
				];
			}
			if ($key)
			{
				BusinessSocialItem::getModel()->updateBatch($updateIds, 'id');
			}
			$this->response(['Items' => $res, 'Keywords' => $keywords->keyword]);

			$this->response([], '500');
		}

	}

	public function insert_items()
	{
		ini_set('max_execution_time', 300);
		$postData = $this->inputJson();
		if ($postData['Posts'])
		{
			$dataInsert = [];
			$dataUpdate = [];
			foreach ($postData['Posts'] as $data)
			{
				if ($data['PostId'])
				{
//					$data['PostOwnerId'] = '120551278013175';
					$socialItem = BusinessSocialItem::getInstance()->findBySocialId($data['PostOwnerId']);
					if (in_array($socialItem->channel_type, [CHANNEL_TYPE_INSTAGRAM, CHANNEL_TYPE_FACEBOOK, CHANNEL_TYPE_TWITTER, CHANNEL_TYPE_TIKTOK], FALSE))
					{
						$keywordComments = [];
						$dataPostId = $data['PostId'];
						$channel_type = $socialItem->channel_type;
						$shareCount = self::unFormatNumber($data['ShareCount']);
						if (($channel_type === CHANNEL_TYPE_FACEBOOK)) {
							$countD = 0;
							try
							{
								$findId = new Finduid((object)['link' => $data['PostOriginUrl']]);
								$res = $findId->getIdPostByTraoDoiSub()->getResponse();
								if (empty($res['id'])) {
									$res = $findId->getIdPostByAPT()->getResponse();
								}
								if($res['id']){
									$pos = strpos($res['id'], ":");
									if($pos){
										$arrId = explode(':',$res['id']);
										$res['id'] = $arrId[0];
									}
								}


							} catch (\Exception $e)
							{
								$res['id'] = '';
							}
							$dataPostId = ! empty($res['id']) ? $res['id'] : $data['PostId'];
						}

						if ($channel_type === CHANNEL_TYPE_TIKTOK)
						{
							$shareCount = $data['ViewCount'];
						}
						$check = BusinessItem::getInstance()->findByPostId($dataPostId);
						$temp = [
							'keywords_check'    => $data['KeywordsCheck'],
							'keywords'          => $data['Keywords'],
							'post_id'           => $dataPostId,
							'post_owner_id'     => $data['PostOwnerId'],
							'type'              => $data['PostType'],// 1 fanpage ; 2 groupd ; 3 profile
							'total_like'        => self::unFormatNumber($data['ReactionCount']),
							'total_share'       => $shareCount,// tiktok => viewcount , fb,ins => sharecount
							'total_comment'     => self::unFormatNumber($data['CommentCount']),
							'content'           => $data['PostMessage'],
							'created_post_date' => $data['PostDate'],
							'channel_type'      => $channel_type,
							'post_url'          => $data['PostOriginUrl'],
							'craw_date'         => date(DATE_TIME_FORMAT),
							'keyword_in'        => $data['KeywordsIn'],// 1 in Post Content ; 2 in Post Comment ; 3 in Both
							'keyword_comments'  => is_string($keywordComments) ? $keywordComments : '',
							'status'            => STATUS_ACTIVE
						];
						if ($check)
						{
							$temp['id'] = $check->id;
							$dataUpdate[] = $temp;
						} else
						{
							if (empty($dataInsert[$data['PostId']]))
							{
								$dataInsert[$data['PostId']] = $temp;
							}
						}
					}

				}
			}
			try
			{
				if ($dataInsert)
				{
					BusinessItem::getModel()->insertBatch($dataInsert);
					$msg = 'Insert post thành công';
				}
				if ($dataUpdate)
				{
					BusinessItem::getModel()->updateBatch($dataUpdate, 'id');
					$msg = 'Update post thành công';
				}
				//$this->sendNotice();
				$this->response(['message' => $msg]);


			} catch (\Exception $e)
			{
				echo "<pre>";
				print_r($e->getMessage());
				die;
			}
		}
		$this->response(['message' => 'Không tìm thấy dự liệu đẩy lên'], 400);
	}

	public function posts_interactive()
	{
		$key = $this->input->get('key', TRUE);
		$limit = $this->input->get('limit', TRUE);
		$type = $this->input->get('type', TRUE);
		$page = intval($this->input->get('page', TRUE));
		$isPrivate = $this->input->get('is_private',TRUE);
		$socialId = $this->input->get('social_id',TRUE);
		// 1 fanpage ; 2 groupd ; 3 profile
		$conditions = [];
		if ($type)
		{
			$conditions['i.type'] = $type;
		}
		if ( ! $limit)
		{
			$limit = ITEM_PER_PAGE_100;
		}
		if($isPrivate){
			$conditions['s.is_private'] = (bool)$isPrivate;
		}
		if($socialId){
			$conditions['s.social_id'] = $socialId;
		}
		$offset = $page ? $limit * ($page - 1) : 0;
		$conditions['i.key_craw IS NULL'] = NULL;
		$conditions['i.channel_type'] = CHANNEL_TYPE_FACEBOOK;
		$items = BusinessItem::getInstance()->getRangeCache($conditions, $offset, $limit, 'id ASC');
		//$items = [];
		if ($items)
		{
			$res = [];
			$updateIds = [];
			foreach ($items as $item)
			{
				$typeName = '';
				if ($item->type == 1)
				{
					$typeName = 'fanpage';
				} elseif ($item->type == '2')
				{
					$typeName = 'group';
				} elseif ($item->type == '3')
				{
					$typeName = 'profile';
				}

				$socialItem = BusinessSocialItem::getInstance()->findBySocialId($item->post_owner_id);
				$updateIds[] = [
					'id'  => $item->id,
					'key' => $key
				];

				if ( ! empty($socialItem->name))
				{
					$res[] = [
						'Id'            => $item->id,
						'PostId'        => $item->post_id,
						'Status'        => $item->status,
						'PostType'      => $typeName,
						'PostOwnerId'   => $item->post_owner_id,
						'PostOwnerName' => $socialItem->name,
						'FbType'        => $item->type,
						'IsPrivate'		=> (bool)$socialItem->is_private,
						'Token'			=> $socialItem->token
					];
				}
			}
			if ($key)
			{
				BusinessItem::getModel()->updateBatch($updateIds, 'id');
			}
			echo json_encode($res);
			exit();
		}
		$this->response([]);

	}

	public static function unFormatNumber($numberFormat)
	{
		$numberFormat = strtolower($numberFormat);
		$numberFormat = str_replace('comments', '', $numberFormat);
		if (strpos($numberFormat, 'k'))
		{
			$numberFormat = str_replace('k', '', $numberFormat);
			return $numberFormat * 1000;
		} elseif (strpos($numberFormat, 'm'))
		{
			$numberFormat = str_replace('m', '', $numberFormat);
			return $numberFormat * 1000000;
		} else
		{
			return preg_replace("/[^0-9]/", '', $numberFormat);
		}
	}

	public function xpath()
	{
		$channel_type = $this->input->get('channel_type', TRUE);
		$tool = $this->input->get('type', TRUE);
		$conditions = [];
		if ($channel_type)
		{
			$conditions['channel_type'] = $channel_type;
		}
		if ($tool)
		{
			$conditions['type'] = $tool;
		}
		if ( ! $channel_type)
		{
			$conditions['channel_type'] = CHANNEL_TYPE_FACEBOOK;
		}
		$res = [];
		$items = BusinessXpath::getInstance()->findByConditionsCache($conditions);
		foreach ($items as $index => $item)
		{
			$res[] = json_decode($item->xpath, FALSE);
		}
		if ($tool && $res)
		{

			echo json_encode($res[0]);
			exit();

		}
		echo json_encode($res);
		exit();

	}

	public function import_interactive()
	{
		$request = $this->inputJson([], FALSE);
//		file_put_contents(time().'.json',json_encode($request));
		if (empty($request->PostId))
		{
			$this->response(['message' => 'Field PostId does not exists.'], 500);
		}
		$item = BusinessItem::getInstance()->findByPostId($request->PostId);

		if ( ! $item)
		{
			$this->response(['message' => 'PostId  not exists.'], 500);
		}
		if ($item && $item->channel_type !== CHANNEL_TYPE_FACEBOOK)
		{
			$this->response(['message' => 'Channel type not support'], 200);
			exit();
		}
		$interactions = [];
		$numberComments = 0;
		$numberLikes = 0;
		$numberShares = 0;
		if ( ! empty($request->CommentUID))
		{
			$numberComments = count($request->CommentUID);
			$interactions[] = $request->CommentUID;
		}
		if ( ! empty($request->ReactionUID))
		{
			$numberLikes = count($request->ReactionUID);
			$interactions[] = $request->ReactionUID;
		}
		if ( ! empty($request->ShareUID))
		{
			$numberShares = count($request->ShareUID);
			$interactions[] = $request->ShareUID;
		}
		$interactions = array_merge(...$interactions);
		$interactions = array_unique($interactions);
		$countData = 0;
		if ($interactions)
		{
			$fileName = "$item->post_id.json";
			$currentInteractions = GoogleCloudStorage::getDataFileGetContent($fileName, BUCKET_NAME_ADSSPY);
			$interactions = array_flip($interactions);
			foreach ($currentInteractions as $currentInteraction)
			{
				if (isset($interactions[$currentInteraction['uid']]))
				{
					unset($interactions[$currentInteraction['uid']]);
				}
			}
			$interactions = array_flip($interactions);
			$interactions = array_values($interactions);
			$response = Common::getRequest(API_GET_USER_INFO_BY_UIDS, $interactions, [], 'POST');
			$response = json_decode($response['response'], TRUE);
			if ($response['success'])
			{
				$newInteractions = $response['data']?? [];
				if ($newInteractions)
				{
					$interactions = array_flip($interactions);
					$tempInteractions = [];
 					foreach ($newInteractions as  $index => $interaction)
					{
						$interaction['keywords'] = $item->keywords;
						$interaction['created_date'] = date('Y-m-d');
						$interaction['post_id'] = $item->post_id;
						$tempInteractions[] = $interaction;
						$newInteractions[$index]['created_date'] = date(DATE_TIME_FORMAT);

						if (isset($interactions[$interaction['uid']]))
						{
							unset($interactions[$interaction['uid']]);
						}
					}
					if ($tempInteractions)
					{
						Interaction::insertBatch($tempInteractions);
					}
					$dataInteractions = array_merge($newInteractions, $currentInteractions);
					$infoProfiles = BusinessItem::getInstance()->getCharts($dataInteractions);
					$interactions = array_flip($interactions);
					$interactions = array_values($interactions);

					GoogleCloudStorage::uploadFiles(
						[
							[
								'name'  => $fileName,
								'value' => json_encode($dataInteractions)
							]
						],
						BUCKET_NAME_ADSSPY,
						NULL
					);
					$countData = count($dataInteractions);
				}
			}

			if($interactions){
				$dataBulkMiss = [];
				foreach ($interactions as  $uid){
					$dataBulkMiss[] = [
						'uid' => $uid,
						'item_id' => $item->id,
						'created_date' => date(DATE_TIME_FORMAT),
					];
				}
				MissInteraction::getInstance()->insertBatch($dataBulkMiss);
			}
		}

		$dataUpdate = [
			'total_like'    => $numberLikes > 0 ? $numberLikes : $item->total_like,
			'total_share'   => $numberShares > 0 ? $numberShares : $item->total_share,
			'total_comment' => $numberComments > 0 ? $numberComments : $item->total_comment,
			'count_d'       => $countData > 0 ? $countData : $item->count_d,
		];
		if(!empty($infoProfiles)){
			$dataUpdate['charts'] = json_encode($infoProfiles);
		}
		$isUpdate = BusinessItem::getModel()->update($item->id, $dataUpdate, TRUE, FALSE);

		BusinessItem::getModel()->clearCache();
		if ( ! empty($isUpdate['code']))
		{
			$this->response($isUpdate, 200);
		}
		$res = array('status' => 1, 'msg' => 'Update success', 'data' => $countData, "post_id" => $request->PostId);
		$this->response($res);
	}

	/**
	 * @throws JsonException
	 */
	public function comments()
	{

		$limit = $this->input->get('limit', TRUE);
		$type = $this->input->get('type', TRUE);
		$page = intval($this->input->get('page', TRUE));
		$channelType = intval($this->input->get('channel_type', TRUE));
		$commentId = $this->input->get('comment_id', TRUE);
		$conditions = [];
		if ($type)
		{
			$conditions['type'] = $type;
		}
		if ( ! $limit)
		{
			$limit = ITEM_PER_PAGE_100;
		}
		if ($channelType)
		{
			$conditions['channel_type'] = $channelType;
		}
		if ($commentId)
		{
			$conditions['comment_id'] = $commentId;
		}
		$conditions['comment_logs.status'] = COMMENT_REPORT_STATUS_PENDING;
		$offset = $page ? $limit * ($page - 1) : 0;
		$items = BusinessCommentLog::getInstance()->getRangeCache($conditions, $offset, $limit);
		$res = [];
		if ($items)
		{
			foreach ($items as $item)
			{
				$res[] = [
					'Id'            => $item->id,
					'PostId'        => $item->post_id,
					'PostType'      => 'link',
					'PostOwnerId'   => $item->post_owner_id,
					'PostOwnerName' => '',
					'FbType'        => $item->type,
					'ChannelType'   => $item->channel_type,
					'Comment'       => $item->comment,
					'Status'        => $item->status,
					'CommentId'     => $item->comment_id
				];
			}
		}
		echo json_encode($res, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		exit();
	}

	public function comment_reports()
	{
		$postData = $this->inputJson();
		$res['message'] = 'Cập nhật comment reports thất bại';
		$statusCode = 500;
		if ($postData['Items'])
		{
			$dataUpdate = [];

			foreach ($postData['Items'] as $data)
			{
				if ($data['Id'])
				{
					$dataUpdate[] = [
						'id'           => $data['Id'],
						'status'       => $data['Status'], //1 thanh công, 2 là thất bại ,
						'comment_date' => date('Y-m-d H:i:s')
					];

				}
			}
			if ($dataUpdate)
			{
				$isUpdate = BusinessCommentLog::getModel()->updateBatch($dataUpdate, 'id');
				\app\models\Comment::clearCache();
				if ($isUpdate)
				{
					$res['message'] = 'Cập nhật comment reports thành công';
					$statusCode = 200;
				}
			}
		}
		$this->response($res, $statusCode);
	}



}