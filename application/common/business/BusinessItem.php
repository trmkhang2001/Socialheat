<?php

namespace app\common\business;

use app\common\components\Upload;
use app\models\Item;
use app\common\utilities\Common;
use app\models\Keyword;
use DateTime;
use FFI;

class BusinessItem implements BusinessInterface
{
	static protected $_instance = NULL;

	/**
	 * Use singleton pattern
	 *
	 * @return BusinessItem object
	 */
	static public function getInstance()
	{
		if (self::$_instance === NULL) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * get model instance
	 * @param mixed $data
	 * @return Item $model
	 */
	public static function getModel($data = array())
	{
		$model = Item::getInstance();
		return $model;
	}

	/**
	 * find one by id
	 * @param $id
	 * @return \CI_DB_query_builder Object
	 */
	public function findOneCache($id)
	{
		$query = Item::getInstance()->findOne(array('id' => $id));
		$nameCache = 'findOne_' . $id;
		return Item::queryBuilder($nameCache, $query, TRUE);
	}

	/**
	 * find one by id
	 * @param $id
	 * @return  Object
	 */
	public function findOne($id)
	{
		return Item::getInstance()->findOne(array('id' => $id))->get()->row();
	}

	public function findByConditions($conditions = array(), $row = FALSE)
	{
		$query = Item::getInstance()->find();
		$query = Item::getInstance()->getConditions($conditions, $query);
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = Item::queryBuilder($nameCache, $query, $row);
		return $res;
	}


	public function findByConditionsVsGroupBy($conditions, $havingCount)
	{
		$query = Item::getInstance()->find();
		$query = Item::getInstance()->getConditions($conditions, $query);
		if (!empty($havingCount['from']) || !empty($havingCount['to'])) {
			$query->group_by('items.post_id');
			if (!empty($havingCount['from']) && empty($havingCount['to'])) {
				$query->having('sum(items.total_like + items.total_share + items.total_comment) >=', $havingCount['from']);
			} elseif (!empty($havingCount['to']) && empty($havingCount['from'])) {
				$query->having('sum(items.total_like + items.total_share + items.total_comment) <=', $havingCount['to']);
			} elseif ($havingCount['from'] && $havingCount['to']) {
				$query->having("sum(items.total_like + items.total_share + items.total_comment) BETWEEN '{$havingCount['from']}' and  '{$havingCount['to']}'");
			}
		}
		$nameCache = 'findByConditions' . http_build_query($conditions);
		$res = Item::queryBuilder($nameCache, $query, FALSE);
		return $res;
	}

	public function findByPostId($postId)
	{
		$query = Item::getInstance()->find()->where('post_id', $postId);
		$nameCache = 'findByPostId' . $postId;
		return Item::queryBuilder($nameCache, $query, TRUE);
	}

	public function getByIdAsArray($id)
	{
		return Item::getInstance()->getByIdAsArray($id);
	}

	public function findByMultipleId($ids = array())
	{
		$name = 'findByMultipleId' . http_build_query($ids);
		$query = Item::getInstance()->findByMultipleId($ids);
		$dbDatas = Item::queryBuilder($name, $query, FALSE);
		$ret = array();
		if ($dbDatas) {
			foreach ($dbDatas as $dbData) {
				$ret[$dbData['id']] = $dbData;
			}
		}
		return $ret;
	}

	public function save($data = array(), $runValidation = TRUE)
	{
		$validation = $this->validateForm($data);
		if (($validation['validation'])) {
			return $validation;
		}
		Item::getInstance()->save($data);
		$res = array(
			'success' => TRUE,
			'message' => 'Tạo bài viết mới thành công'
		);
		return $res;
	}

	public function update($id, $data = array(), $runValidation = TRUE)
	{
		if ($runValidation) {
			$validation = $this->validateForm($data);
			$oldItem = $this->findOne($id);
			if ($oldItem && $oldItem->post_id === $data['post_id']) {
				unset($validation['validation']['post_id']);
			}
			if ($validation['validation']) {
				return $validation;
			}
		}
		Item::getInstance()->update($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Cập nhật bài viết thành công'
		);
		return $res;
	}

	private function validateForm($data)
	{
		$validation = Item::getInstance()->validateForm($data);

		if ($data['post_id']) {
			$uid = $this->findByPostId($data['post_id']);
			if ($uid) {
				$validation['validation']['post_id'] = 'Post id đã tồn tại ';
			}
		}
		return $validation;
	}

	public function delete($id, $data)
	{
		//User::getInstance()->delete($id);
		Item::getInstance()->delete($id, $data);
		$res = array(
			'success' => TRUE,
			'message' => 'Xóa thành công'
		);
		return $res;
	}

	public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
	{
		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		//Item::getInstance();
		$model = self::getModel();
		$dbObj = $model::find(TRUE, 'i')->select('i.*,s.image as image,s.name as social_name')
			->join('social_items s', 'i.post_owner_id = s.social_id', 'inner');
		$dbObj->order_by($orderBy);
		//		if ($orderBy)
		//		{
		//			$dbObj = Item::getInstance()->find()->select('*');
		//			$dbObj->order_by($orderBy);
		//		} else
		//		{
		//			$dbObj = get_instance()->db->select('*, type, idx
		//		from (select a.*,
		//             (@seqnum := if(@type = type, @seqnum + 1,
		//                            if(@type := type, 1, 1)
		//                           )
		//             ) as idx
		//		  from items a cross join
		//			   (select @type := NULL, @seqnum := 0) vars
		//		 order by type ASC, craw_date DESC
		//    	 ) a', FALSE);
		//			$dbObj->order_by('idx, type');
		//		}
		if ($itemPerPage) {
			$dbObj->limit($itemPerPage);
		}
		$dbObj = Item::getInstance()->getConditions($conditions, $dbObj);
		$dbObj->offset($offset);
		return $dbObj;
	}

	public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = 'id DESC')
	{
		$name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
		$dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
		return Item::queryBuilder($name, $dbObj, FALSE);
	}




	public function getCount($conditions = array())
	{
		$model = self::getModel();
		$dbObj = $model::$db->from(Item::tableName() . ' i');
		$dbObj = Item::getInstance()->getConditions($conditions, $dbObj);
		return $dbObj->count_all_results();
	}

	public function findByEmail($email)
	{
		$query = Item::getInstance()->findByEmail($email);
		$nameCache = 'findByEmail_' . $email;
		$res = Item::getInstance()->queryBuilder($nameCache, $query, TRUE);
		return $res;
	}

	public function checkAuth($email, $password)
	{
		$user = $this->findByEmail($email);
		if (empty($user)) {
			return NULL;
		}
		$isSuccess = password_verify($password, $user->password);
		if ($isSuccess) {
			return $user;
		}
		return NULL;
	}


	public function findByConditionsCache($conditions)
	{
		$name = 'findByConditionsCache' . http_build_query($conditions);
		$dbObj = Item::findByConditions($conditions);
		$res = Item::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

	public function findByLastUpdate()
	{
		$name = 'findByLastUpdate';
		$dbObj = Item::getInstance()->find()->order_by('craw_date', 'DESC');
		return Item::queryBuilder($name, $dbObj, TRUE);
	}

	public function findByRoleIds($roleIds)
	{
		$name = 'findByConditionsCache' . http_build_query($roleIds);
		$dbObj = Item::getInstance()->find()->where_in('role_id', $roleIds);
		$res = Item::queryBuilder($name, $dbObj, FALSE);
		return $res;
	}

	public function sendApiDatXanh($item)
	{
		$ch = curl_init(API_URL_DAT_XANH);
		curl_setopt($ch, CURLOPT_URL, API_URL_DAT_XANH);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		$head[] = "Content-Type: application/json";
		$postFields = [
			'params' => [
				'key'     => API_KEY_DAT_XANH,
				'name'    => $item->name,
				'email'   => $item->email,
				'mobile'  => (int)$item->phone,
				'note'    => $item->note,
				'address' => $item->address
			]
		];
		curl_setopt($ch, CURLOPT_POST, 1); // cai nay phai nam giua khong loi [Request Entity Too Large (E1235)]
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$content = curl_exec($ch);
		if (curl_errno($ch)) {
			echo "\nURL: " . API_URL_DAT_XANH . " Error is : " . curl_error($ch) . "\n";
		}
		curl_close($ch);
		return json_decode($content);
	}

	public function validateData($datas)
	{
		$validate = array();
		if ($datas) {
			foreach ($datas as $index => $data) {
				$validation = Item::getInstance()->validateForm($data);
				if (($validation['validation'])) {
					foreach ($validation['validation'] as $key => $val) {
						$validate[sprintf('interactive[%s][%s]', $index, $key)] = $val;
					}
				}
			}
		}
		$res['validate'] = $validate;
		return $res;
	}


	public function upload($attributeName, $estatesId = NULL)
	{
		$data = array();
		if (!Upload::isEmpty($attributeName)) {
			$imagesInfo = Upload::getFileObjByAttributeName($attributeName);
			if ($imagesInfo) {
				$fileData = Upload::uploadMultipleFile($imagesInfo, UPLOAD_BASE_IMAGES);
				if ($fileData['error'] === 0) { //if error
					$data = array(
						'file_path' => $fileData['file_path']
					);
				} else {
					$data['error_message'] = $fileData['message'];
				}
			}
		}
		return $data;
	}

	public function getCountCities($postId)
	{
		$nameCache = 'getCountCities_' . $postId;
		$nameCache .= '.cache';
		$res = Item::getCache($nameCache);
		if ($res) {
			return $res;
		}
		$itemPerPage = 1000;
		$totalRecords = self::getInstance()->getCountRangeTableV($postId);
		$numberPages = ceil($totalRecords / $itemPerPage);
		$res = [];
		for ($i = 1; $i <= $numberPages; $i++) {
			$offset = $i ? $itemPerPage * ($i - 1) : 0;
			$uids = self::getUids($postId, $itemPerPage, $offset);
			$uids = ids_from($uids, 'uid');
			$paramQuery = http_build_query(['uids' => $uids]);
			$content = Common::getInfoUids($paramQuery, URL_API_FLASH . 'posts?%s&post_id=' . $postId . '_' . $i);
			if ($content) {
				foreach ($content as $index => $value) {
					if ($index < 15) {
						if (!empty($res[$value->city])) {
							$res[trim($value->city)] += (int)$value->count;
						} else {
							$res[trim($value->city)] = (int)$value->count;
						}
					}
				}
			}
		}
		Item::setCache($nameCache, $res, 3600 * 24 * 30);
		return $res;
	}


	public static function getUids($postId, $limit, $offset, $conditions = [])
	{
		$CI = &get_instance();
		$name = 'getUids' . $postId;
		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		$dbObj = $CI->db->from('v_' . $postId);
		$dbObj->select('uid');

		if (!empty($conditions['is_like'])) {
			$name .= 'is_like' . $conditions['is_like'];
			$dbObj->or_where('is_like', TRUE)
				->or_where('is_share', TRUE);
		}
		if (!empty($conditions['is_comment'])) {
			$name .= 'is_comment' . $conditions['is_comment'];
			$dbObj->or_where('is_comment', TRUE);
		}
		if (empty($conditions)) {
			$dbObj->or_where('is_like', TRUE)
				->or_where('is_share', TRUE)
				->or_where('is_comment', TRUE);
		}
		$dbObj->limit($limit, $offset);
		return Item::getInstance()->queryBuilder($name, $dbObj, FALSE, 300, FALSE);
	}

	public static function getCountRangeTableV($postId)
	{
		$name = 'getCountRangeTableV_' . $postId;
		$dbObj = get_instance()->db->from('v_' . $postId);
		$dbObj->or_where('is_like', TRUE)
			->or_where('is_share', TRUE)
			->or_where('is_comment', TRUE);
		return Item::getInstance()->queryBuilder($name, $dbObj, TRUE, 300, TRUE, TRUE, FALSE);
	}

	public function getRangeUids($groupTable, $offset, $itemPerPage, $select = '')
	{
		$nameCache = 'getRangeUids_v_' . $groupTable . '_' . ($offset) . '_' . $itemPerPage;
		$nameCache .= '.cache';
		$res = Item::getCache($nameCache);
		if ($res) {
			return $res;
		}

		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		$dbObj = &get_instance()->db;
		if ($select) {
			$dbObj->select($select);
		}
		$dbObj->from('v_' . $groupTable)
			->or_where('is_like', TRUE)
			->or_where('is_share', TRUE)
			->or_where('is_comment', TRUE);
		$dbObj->limit($itemPerPage);
		$dbObj->offset($offset);
		//		$dbObj->get_compiled_select()
		//		$dbObj->order_by('uid','DESC');
		$query = $dbObj->get();
		$query = $query->result_array();
		Item::setCache($nameCache, $query, 3600 * 24 * 30);
		return $query;
	}

	public function filterConditions($postId, $conditions)
	{
		$nameCache = 'filterConditions_' . $postId . '_' . http_build_query($conditions);
		$nameCache .= '.cache';
		$res = Item::getCache($nameCache);
		if ($res) {
			return $res;
		}
		$itemPerPage = 1000;
		$totalRecords = self::getInstance()->getCountRangeTableV($postId);
		$numberPages = ceil($totalRecords / $itemPerPage);

		$res = [];
		for ($i = 1; $i <= $numberPages; $i++) {
			$offset = $i ? $itemPerPage * ($i - 1) : 0;

			$uids = self::getUids($postId, $itemPerPage, $offset, $conditions);
			$uids = ids_from($uids, 'uid');
			$paramQuery = http_build_query(['uids' => $uids]);
			$url = URL_API_FLASH . 'filters?%s&post_id=' . $postId;
			$content = Common::getInfoUids($paramQuery, $url, $conditions);
			if (!empty($content->data)) {
				$res = array_merge($content->data, $res);
			}
		}
		Item::setCache($nameCache, $res, 3600 * 24 * 30);
		return $res;
	}

	public function getTotalPost($conditions, $nameCache)
	{
		/**
		 * @var $dbObj \CI_DB_query_builder
		 */
		$dbObj = Item::getInstance()->find(TRUE, 'i')
			->select('count(i.id) as total_post , sum(i.count_d) as total_social,
		 sum(i.count_like_share) as count_like_share,
		 sum(i.count_comment) as count_comment,
		  sum(i.total_comment) as total_comment,
		  sum(i.total_share) as total_share,
		  sum(i.total_like) as total_like,
		 ');
		$dbObj = Item::getInstance()->getConditions($conditions, $dbObj);
		return Item::queryBuilder($nameCache, $dbObj, TRUE);
	}

	public function getTotalPostByChannel($conditions)
	{
		$nameCache = 'getTotalPostByChannel_' . http_build_query($conditions);
		$dbObj = Item::getInstance()->find(TRUE, 'i')
			->select('count(id) as number, channel_type')->group_by('channel_type');
		$dbObj = Item::getInstance()->getConditions($conditions, $dbObj);
		return Item::queryBuilder($nameCache, $dbObj, FALSE);
	}


	public function getCharts($users): array
	{
		// gender => male,female,other
		$totalGenderMale = 0;
		$totalMail = 0;
		$totalDob = 0;
		$totalRelationship = 0;
		$totalLocation = 0;
		$totalGenderFemale = 0;
		$totalGenderOther = 0;
		// age
		$ageRange0_18 = 0;
		$ageRange18_30 = 0;
		$ageRange30_60 = 0;
		$ageRange60_80 = 0;
		// relationship
		$totalRelationshipSingle = 0;
		$totalRelationshipDating = 0;
		$totalRelationshipMarried = 0;
		$totalRelationshipDivorce = 0;
		//friends
		$friendRange0_200 = 0;
		$friendRange200_1000 = 0;
		$friendRange1000_3000 = 0;
		$friendRange3000 = 0;
		// follows
		$followRange0_200 = 0;
		$followRange200_1000 = 0;
		$followRange1000_3000 = 0;
		$followRange3000 = 0;
		$numberCities = [];
		$numberLocations = [
			'Vietnam'                => 0,
			'United States & Canada' => 0,
			'France'                 => 0,
			'Italy'                  => 0,
			'Japan'                  => 0,
			'Singapore'              => 0,
			'United Kingdom'         => 0,
			'Australia'              => 0,
			'Other'                  => 0

		];
		$total = 0;
		if ($users) {
			foreach ($users as $user) {
				++$total;
				self::countGender($totalGenderMale, $totalGenderFemale, $totalGenderOther, $user);
				self::countMail($totalMail, $user);
				self::countDob($totalDob, $user);
				self::countRelationship($totalRelationship, $user);
				self::countLocation($totalLocation, $user);
				self::rangeAge($ageRange0_18, $ageRange18_30, $ageRange30_60, $ageRange60_80, $user);
				self::checkRelationship(
					$totalRelationshipSingle,
					$totalRelationshipDating,
					$totalRelationshipMarried,
					$totalRelationshipDivorce,
					$user
				);
				self::rangeFriends(
					$friendRange0_200,
					$friendRange200_1000,
					$friendRange1000_3000,
					$friendRange3000,
					$user
				);
				self::rangeFollows(
					$followRange0_200,
					$followRange200_1000,
					$followRange1000_3000,
					$followRange3000,
					$user
				);
				self::getNumberCities($numberCities, $user);
				self::getNumberLocations($numberLocations, $user);
			}
			arsort($numberCities);
			$numberCities = array_splice($numberCities, 0, 10);
		}

		//		['#0BB783', '#3699FF', '#F64E60', '#8950FC', '#FFD74A']


		return [
			'total'             => $total,
			'totalMail'         => $totalMail,
			'totalLocation'     => $totalLocation,
			'totalRelationship' => $totalRelationship,
			'totalDob'          => $totalDob,
			'charts'            => [
				'gender'        => [
					'series'     => [$totalGenderMale, $totalGenderFemale, $totalGenderOther],
					'labels'     => ['Male', 'Female', 'Other'],
					'colors'     => ['#0BB783', '#3699FF', '#F64E60'],
					'itemLabels' => [
						['name' => 'Male', 'value' => $totalGenderMale, 'color' => '#0BB783'],
						['name' => 'Female', 'value' => $totalGenderFemale, 'color' => '#3699FF'],
						['name' => 'Other', 'value' => $totalGenderOther, 'color' => '#F64E60'],
					],
					'title'      => 'Gender'
				],
				'ages'          => [
					'series'     => [$ageRange0_18, $ageRange18_30, $ageRange30_60, $ageRange60_80],
					'labels'     => ['0 - 18', '18 - 30', '30 - 60', '60 - 80'],
					'colors'     => ['#0BB783', '#3699FF', '#F64E60', '#8950FC'],
					'itemLabels' => [
						['name' => '0 - 18', 'value' => $ageRange0_18, 'color' => '#0BB783'],
						['name' => '18 - 30', 'value' => $ageRange18_30, 'color' => '#3699FF'],
						['name' => '30 - 60', 'value' => $ageRange30_60, 'color' => '#F64E60'],
						['name' => '60 - 80', 'value' => $ageRange60_80, 'color' => '#8950FC'],
					],
					'title'      => 'Age'
				],
				'relationships' => [
					'series'     => [
						$totalRelationshipSingle,
						$totalRelationshipDating,
						$totalRelationshipMarried,
						$totalRelationshipDivorce
					],
					'labels'     => ['Single', 'Dating', 'Married', 'Divorce'],
					'colors'     => ['#0BB783', '#3699FF', '#F64E60', '#8950FC'],
					'itemLabels' => [
						['name' => 'Single', 'value' => $totalRelationshipSingle, 'color' => '#0BB783'],
						['name' => 'Dating', 'value' => $totalRelationshipDating, 'color' => '#3699FF'],
						['name' => 'Married', 'value' => $totalRelationshipMarried, 'color' => '#F64E60'],
						['name' => 'Divorce', 'value' => $totalRelationshipDivorce, 'color' => '#8950FC'],
					],
					'title'      => 'Relationship'
				],
				'friends'       => [
					'series'     => [$friendRange0_200, $friendRange200_1000, $friendRange1000_3000, $friendRange3000],
					'labels'     => ['0 - 200', '200 - 1000', '1000 - 3000', '3000+'],
					'colors'     => ['#0BB783', '#3699FF', '#F64E60', '#8950FC'],
					'itemLabels' => [
						['name' => '0 - 200', 'value' => $friendRange0_200, 'color' => '#0BB783'],
						['name' => '200 - 1000', 'value' => $friendRange200_1000, 'color' => '#3699FF'],
						['name' => '1000 - 3000', 'value' => $friendRange1000_3000, 'color' => '#F64E60'],
						['name' => '3000+', 'value' => $friendRange3000, 'color' => '#8950FC'],
					],
					'title'      => 'Friends'
				],
				'follows'       => [
					'series'     => [$followRange0_200, $followRange200_1000, $followRange1000_3000, $followRange3000],
					'labels'     => ['0 - 200', '200 - 1000', '1000 - 3000', '3000+'],
					'colors'     => ['#0BB783', '#3699FF', '#F64E60', '#8950FC'],
					'itemLabels' => [
						['name' => '0 - 200', 'value' => $followRange0_200, 'color' => '#0BB783'],
						['name' => '200 - 1000', 'value' => $followRange200_1000, 'color' => '#3699FF'],
						['name' => '1000 - 3000', 'value' => $followRange1000_3000, 'color' => '#F64E60'],
						['name' => '3000+', 'value' => $followRange3000, 'color' => '#8950FC'],
					],
					'title'      => 'Follows'
				],
				'cities'        => [
					'series' => array_values($numberCities),
					'labels' => array_keys($numberCities),
					'title'  => 'City'
				],
				'locations'     => [
					'series' => array_values($numberLocations),
					'labels' => array_keys($numberLocations),
					'title'  => 'Country'
				]
			]
		];
	}

	public static function countGender(&$totalMale, &$totalFemale, &$totalGenderOther, $user)
	{
		if ($user['sex'] === 'male') {
			++$totalMale;
		} elseif ($user['sex'] === 'female') {
			++$totalFemale;
		} else {
			++$totalGenderOther;
		}
	}

	public static function countMail(&$totalMail, $user)
	{
		if ($user['email'] != null) {
			++$totalMail;
		}
	}

	public static function countDob(&$totalDob, $user)
	{
		if ($user['birthday']) {
			++$totalDob;
		}
	}

	public static function countRelationship(&$totalRelationship, $user)
	{
		if ($user['relationship'] != null) {
			++$totalRelationship;
		}
	}

	public static function countLocation(&$totalLocation, $user)
	{
		if ($user['city'] != null) {
			++$totalLocation;
		}
	}

	public static function rangeAge(&$ageRange0_18, &$ageRange18_30, &$ageRange30_60, &$ageRange60_80, $user)
	{
		if ($user['birthday']) {
			$from = new DateTime($user['birthday']);
			$to = new DateTime('today');
			$age = $from->diff($to)->y;
			if ($age <= 18) {
				++$ageRange0_18;
			} elseif ($age > 18 && $age <= 30) {
				++$ageRange18_30;
			} elseif ($age > 30 && $age <= 60) {
				++$ageRange30_60;
			} else {
				++$ageRange60_80;
			}
		}
	}

	public static function checkRelationship(&$totalSingle, &$totalDating, &$totalMarried, &$totalDivorce, $user)

	{
		if ($user['relationship']) {
			$relationship = strtolower($user['relationship']);
			if ($relationship === 'single') {
				++$totalSingle;
			}
			if ($relationship === 'dating') {
				++$totalDating;
			}
			if ($relationship === 'married') {
				++$totalMarried;
			}
			if ($relationship === 'divorced') {
				++$totalDivorce;
			}
		}
	}

	public static function rangeFriends(
		&$friendRange0_200,
		&$friendRange200_1000,
		&$friendRange1000_3000,
		&$friendRange3000,
		$user
	) {
		$numberFriends = (int)$user['friends'];
		if ($numberFriends <= 200) {
			++$friendRange0_200;
		} elseif ($numberFriends > 200 && $numberFriends <= 1000) {
			++$friendRange200_1000;
		} elseif ($numberFriends > 1000 && $numberFriends <= 3000) {
			++$friendRange1000_3000;
		} else {
			++$friendRange3000;
		}
	}

	public static function rangeFollows(
		&$followRange0_200,
		&$followRange200_1000,
		&$followRange1000_3000,
		&$followRange3000,
		$user
	) {
		$numberFollows = (int)$user['follow'];
		if ($numberFollows <= 200) {
			++$followRange0_200;
		} elseif ($numberFollows > 200 && $numberFollows <= 1000) {
			++$followRange200_1000;
		} elseif ($numberFollows > 1000 && $numberFollows <= 3000) {
			++$followRange1000_3000;
		} else {
			++$followRange3000;
		}
	}

	public static function getNumberCities(&$numberCities, $user)
	{
		$city = mb_strtolower($user['city'] ?: '');
		if ($city) {
			if (isset($numberCities[$city])) {
				++$numberCities[$city];
			} else {
				$numberCities[$city] = 0;
			}
		}
	}

	public static function getNumberLocations(&$numberLocations, $user)
	{
		$phone = $user['phone'];
		if ($phone) {
			if (substr($phone, 0, 2) === '84') {
				++$numberLocations['Vietnam'];
			} elseif (substr($phone, 0, 1) === '1') {
				++$numberLocations['United States & Canada'];
			} elseif (substr($phone, 0, 2) === '33') {
				++$numberLocations['France'];
			} elseif (substr($phone, 0, 2) === '39') {
				++$numberLocations['Italy'];
			} elseif (substr($phone, 0, 2) === '81') {
				++$numberLocations['Japan'];
			} elseif (substr($phone, 0, 2) === '65') {
				++$numberLocations['Singapore'];
			} elseif (substr($phone, 0, 2) === '44') {
				++$numberLocations['United Kingdom'];
			} elseif (substr($phone, 0, 2) === '61') {
				++$numberLocations['Australia'];
			} else {
				++$numberLocations['Other'];
			}
		}
	}
	public function getTopKeywords($limit)
	{
		$name = 'getTopKeywords_' . $limit;
		$model  = self::getModel();
		$dbObj = $model::find();
		$dbObj->select(' keywords , count(keywords) as number_keyword,sum(count_d) as total_data,
			sum(total_share + total_like + total_comment) as total_engage
		')
			->where('keywords <>', '')
			->group_by('keywords')
			->order_by('number_keyword', 'DESC')
			->limit($limit);
		$res = $model::queryBuilder($name, $dbObj, FALSE, 24 * 60 * 60 * 7);
		return $res;
	}

	public function getTotalInteractionByType()
	{
		$name = 'getTotalInteractionByType';
		$model  = self::getModel();
		$dbObj = $model::find();
		$dbObj->select('sum(count_d) as total_data, type')
			->where('channel_type ', CHANNEL_TYPE_FACEBOOK)
			->group_by('type');
		$res = $model::queryBuilder($name, $dbObj, FALSE, 24 * 60 * 60 * 7);
		return $res;
	}


	public function getPostByRangeDate()
	{
		$name = 'getPostByRangeDate';
		$model  = self::getModel();
		$dbObj = $model::find();
		$dbObj->select('count(id) as total_item, sum(count_d) as total_data, craw_date, DATE(craw_date) as date_format')
			->where('channel_type ', CHANNEL_TYPE_FACEBOOK)
			->where('craw_date >', date('Y-m-d 00:00:00', strtotime('- 7day')))
			->where('craw_date <', date('Y-m-d 23:59:59'))
			->group_by('date_format');
		$res = $model::queryBuilder($name, $dbObj, FALSE, 24 * 60 * 60 * 7);
		return $res;
	}
	public function getTotalCountD()
	{
		$name = 'getTotalData';
		$model = self::getModel();
		$dbObj = $model::find();
		$dbObj->select('sum(count_d) as total_data');
		$res = $model::queryBuilder($name, $dbObj, FALSE, 24 * 60 * 60 * 7);
		return $res[0]->total_data;
	}
}
