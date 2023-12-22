<?php

namespace app\common\business;

use app\models\Brand;

class BusinessBrand implements BusinessInterface
{
    static protected $_instance = NULL;

    static public function getInstance()
    {
        if (self::$_instance === NULL) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @param array $data
     * @return Brand|null
     */
    public static function getModel($data = array())
    {
        return Brand::getInstance();
    }

    public function findOne($id)
    {
        $model = Brand::getInstance()->findOne(array('id' => $id));
        return $model;
    }

    public function findByMultipleId($ids = array())
    {
        // TODO: Implement findByMultipleId() method.
    }

    public function getByIdAsArray($id)
    {
        // TODO: Implement getByIdAsArray() method.
    }

    public function save($data = array(), $runValidation = TRUE)
    {

        // TODO: Implement save() method.
    }

    public function update($id, $data = array(), $runValidation = TRUE)
    {
        // TODO: Implement update() method.
    }

    public function delete($id, $data)
    {
        // TODO: Implement delete() method.
    }

    public function getRange($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
    {

        $modelInstance = self::getModel();
        /**
         * @var $dbObj \CI_DB_query_builder
         */
        $dbObj = $modelInstance::find(FALSE)->order_by($orderBy);
        if ($itemPerPage) {
            $dbObj->limit($itemPerPage);
        }
        $dbObj = $modelInstance->getConditions($conditions, $dbObj);
        $dbObj->offset($offset);
        return $dbObj;
    }

    public function getRangeCache($conditions = array(), $offset = 0, $itemPerPage = 0, $orderBy = '')
    {
        $name = 'getRangeCache' . http_build_query($conditions) . $offset . $itemPerPage . $orderBy;
        $dbObj = $this->getRange($conditions, $offset, $itemPerPage, $orderBy);
        return Brand::queryBuilder($name, $dbObj, FALSE);
    }

    public function getCount($conditions = array(), $alias = '')
    {
        $modelInstance = self::getModel();
        $nameCache = 'getCount' . http_build_query($conditions);
        $res = $modelInstance::getCache($nameCache);
        if ($res) {
            return $res;
        }
        /**
         * @var $dbObj \CI_DB_query_builder
         */
        if ($alias) {
            $dbObj = $modelInstance::find(FALSE, $alias);
        } else {
            $dbObj = $modelInstance::find(FALSE);
        }

        $dbObj = $modelInstance->getConditions($conditions, $dbObj);
        $number =   $dbObj->count_all_results();
        $modelInstance::setCache($nameCache, $number, 60 * 60 * 24 * 30);
        return  $number;
    }
    public function findByConditions($conditions = array())
    {
        $dbObj = Brand::getInstance()->find(false);
        $dbObj = Brand::getInstance()->getConditions($conditions, $dbObj);
        return $dbObj;
    }
    public function findRateByKeywordItemId($keyword, $item_id)
    {
        $dbObj = Brand::getInstance()->find(false)->where('keywords', $keyword)->where('item_id', $item_id);
        $name = 'findRateBrandWithKeyWordItemId' . $keyword . $item_id;
        $res = Brand::queryBuilder($name, $dbObj, FALSE);
        if ($res) {
            return $res['0']->rate;
        }
        $item = BusinessItem::getInstance()->findOne($item_id);
        if ($item) {
            $content = $item->content;
            $response = BusinessBrand::getInstance()->sendApiChatGPT($content, $keyword);
            $result = json_decode($response, true);
            if (isset($result['error'])) {
                $res = [];
                $res = array(
                    'error' => TRUE,
                    'message' => $result['error']['message'],
                );
                return $res;
            }
            $dataBrand = [];
            if ($response) {
                $result = json_decode($response, true);
                $assistantReply = $result['choices'][0]['message']['content'];
                $dataBrand['item_id'] = $item_id;
                $dataBrand['keywords'] = $keyword;
                $dataBrand['created_date'] = date('Y-m-d H:i:s');
                if (strpos(strtoupper($assistantReply), 'POSITIVE') !== FALSE)
                    $dataBrand['rate'] = POSITIVE;
                if (strpos(strtoupper($assistantReply), 'NEGATIVE') !== FALSE)
                    $dataBrand['rate'] = NEGATIVE;
                if (strpos(strtoupper($assistantReply), 'NEUTRAL') !== FALSE)
                    $dataBrand['rate'] = NEUTRAL;
                Brand::getInstance()->save($dataBrand);
                return $dataBrand['rate'];
            };
        }
    }
    public function findBrandByMultipleItemId($items_id)
    {
        if (!$items_id) {
            return  [];
        }
        $name = 'findBrandByMultipleItemId' . http_build_query($items_id);
        $dbObj = Brand::getInstance()->find(FALSE)->where_in('item_id', $items_id);
        $listBrand = Brand::queryBuilder($name, $dbObj, FALSE);
        $res = [];
        if ($listBrand) {
            foreach ($listBrand as $brand) {
                $res[] = $brand;
            }
        }
        return $res;
    }
    public function sendApiChatGPT($content, $keyword)
    {
        $ch = curl_init(API_URL_CHATGPT);
        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'You are a helpful assistant.',
                ],
                [
                    'role' => 'user',
                    'content' => 'Với 3 trạng thái: POSITIVE, NEGATIVE, NEUTRAL với từ khóa [' . $keyword . '] thì đoạn nội dung trên thuộc dạng gì: [' . $content . ']. Chỉ trả lời duy nhất 2 từ',
                ],
            ],
        ];
        $postData = json_encode($data);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . OPENAI_API_KEY,
        ));
        //gửi yêu cầu
        $response = curl_exec($ch);
        // Kiểm tra lỗi cURL
        if (curl_errno($ch)) {
            echo 'CURL Error: ' . curl_error($ch);
        }

        // Đóng kết nối cURL
        curl_close($ch);

        // Trả về kết quả
        return $response;
    }
    public function getRateByRangeDate()
    {
        $name = 'getRateByRangeDate';
        $model  = self::getModel();
        $dbObj = $model::find(FALSE);
        $dbObj->select('count(CASE WHEN rate = 1 THEN 1 END) as count_positive, count(CASE WHEN rate = 2 THEN 1 END) as count_negative, count(CASE WHEN rate = 3 THEN 1 END) as count_neutral,DATE(created_date) as date_format')
            ->group_by('DATE(date_format)')
            ->order_by('DATE(created_date)', 'desc')
            ->limit(7);
        $res = $model::queryBuilder($name, $dbObj, FALSE, 24 * 60 * 60 * 7);
        return $res;
    }
    public function getTotalSentimentByRate()
    {
        $name = 'getTotalSentimentByRate';
        $model  = self::getModel();
        $dbObj = $model::find(FALSE);
        $dbObj->select('count(CASE WHEN rate = 1 THEN 1 END) as total_posivite,count(CASE WHEN rate = 2 THEN 1 END) as total_negative,count(CASE WHEN rate = 3 THEN 1 END) as total_neutral');
        $res = $model::queryBuilder($name, $dbObj, FALSE, 24 * 60 * 60 * 7);
        return $res;
    }
}
