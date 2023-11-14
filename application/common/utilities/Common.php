<?php
namespace app\common\utilities;
use  app\common\components\Upload;

class Common{



    public static function keyValue($rows, $fields)
    {
        $data = array();
        foreach ($rows as $row) {
            $data[$row[$fields[0]]] = $row[$fields[1]];
        }
        return $data;
    }
    public static function formatArrayFromKey($inputArray = array(), $key = ''){
        $ret = array();
        if($inputArray){
            foreach($inputArray as $element){
                if(isset($element[$key])){
                    $ret[] = $element[$key];
                }
            }
        }
        return $ret;
    }
    public static function reformatDate($time, $format = 'Y/m/d'){
        $date = '';
        if($time){
            $timestamp = strtotime($time);
            $date = date($format, $timestamp);
        }
        return $date;
    }


    public static function numberFormat($number, $decimal = 0,$decPoint = ',', $thousandsSep = '.'){
        $int = floor($number);
        $numberDecimal = $number - $int;
        if($numberDecimal > 0){
            $decimal = 2;
        }
        return number_format($number, $decimal, $decPoint, $thousandsSep);

    }

    public static function number_replace($number)
    {
        $number =  preg_replace("/[^0-9.]/", '', $number);
        return $number;
    }

    public static function stripViet($strInput, $replaceSpace = '', $code = "utf-8", $stripSpace = false) {
        $stripped_str = $strInput;
        $vietU = array();
        $vietL = array();

        if (strtolower($code) == "utf-8") {
            $i = 0;
            $vietU[$i++] = array('A', array("/À/", "/Á/", "/Â/", "/Ã/", "/Ä/", "/Å/", "/Ǻ/", "/Ā/", "/Ă/", "/Ą/", "/Ǎ/", "/Α/", "/Ά/", "/Ả/", "/Ạ/", "/Ầ/", "/Ẫ/", "/Ẩ/", "/Ậ/", "/Ằ/", "/Ắ/", "/Ẵ/", "/Ẳ/", "/Ặ/", "/А/", "/Ấ/"));
            $vietU[$i++] = array('O', array("/Ò/", "/Ó/", "/Ô/", "/Õ/", "/Ō/", "/Ŏ/", "/Ǒ/", "/Ő/", "/Ơ/", "/Ø/", "/Ǿ/", "/Ο/", "/Ό/", "/Ω/", "/Ώ/", "/Ỏ/", "/Ọ/", "/Ồ/", "/Ố/", "/Ỗ/", "/Ổ/", "/Ộ/", "/Ờ/", "/Ớ/", "/Ỡ/", "/Ở/", "/Ợ/", "/О/"));
            $vietU[$i++] = array('E', array("/È/", "/É/", "/Ê/", "/Ë/", "/Ē/", "/Ĕ/", "/Ė/", "/Ę/", "/Ě/", "/Ε/", "/Έ/", "/Ẽ/", "/Ẻ/", "/Ẹ/", "/Ề/", "/Ế/", "/Ễ/", "/Ể/", "/Ệ/","/Е/", "/Э/"));
            $vietU[$i++] = array('U', array("/Ù/", "/Ú/", "/Û/", "/Ũ/", "/Ū/", "/Ŭ/", "/Ů/", "/Ű/", "/Ų/", "/Ư/", "/Ǔ/", "/Ǖ/", "/Ǘ/", "/Ǚ/", "/Ǜ/", "/Ũ/", "/Ủ/", "/Ụ/", "/Ừ/", "/Ứ/", "/Ữ/", "/Ử/", "/Ự/"));
            $vietU[$i++] = array('I', array("/Ì/", "/Í/", "/Î/", "/Ï/", "/Ĩ/", "/Ī/", "/Ĭ/", "/Ǐ/", "/Į/", "/İ/", "/Η/", "/Ή/", "/Ί/", "/Ι/", "/Ϊ/", "/Ỉ/", "/Ị/", "/И/", "/Ы/"));
            $vietU[$i++] = array('Y', array("/Ý/", "/Ÿ/", "/Ŷ/", "/Υ/", "/Ύ/", "/Ϋ/", "/Ỳ/", "/Ỹ/", "/Ỷ/", "/Ỵ/", "/Й/"));
            $vietU[$i++] = array('D', array("/Ð/", "/Ď/", "/Đ/", "/Δ/", "/Д/"));
            unset($i);
            $i = 0;
            $vietL[$i++] = array('a', array("/à/", "/á/", "/â/", "/ã/", "/å/", "/ǻ/", "/ā/", "/ă/", "/ą/", "/ǎ/", "/ª/", "/α/","/ά/", "/ả/","/ạ/", "/ầ/", "/ấ/", "/ẫ/", "/ẩ/", "/ậ/", "/ằ/", "/ắ/", "/ẵ/", "/ẳ/", "/ặ/", "/а/"));
            $vietL[$i++] = array('o', array("/ò/", "/ó/", "/ô/", "/õ/", "/ō/", "/ŏ/", "/ǒ/", "/ő/", "/ơ/", "/ø/", "/ǿ/", "/º/","/ο/", "/ό/", "/ω/", "/ώ/", "/ỏ/", "/ọ/", "/ồ/", "/ố/","/ỗ/", "/ổ/", "/ộ/", "/ờ/", "/ớ/", "/ỡ/", "/ở/", "/ợ/", "/о/"));
            $vietL[$i++] = array('e', array("/è/", "/é/", "/ê/", "/ë/", "/ē/", "/ĕ/", "/ė/", "/ę/", "/ě/", "/έ/", "/ε/", "/ẽ/", "/ẻ/", "/ẹ/", "/ề/", "/ế/", "/ễ/", "/ể/", "/ệ/", "/е/", "/э/"));
            $vietL[$i++] = array('u', array("/ù/", "/ú/", "/û/", "/ũ/", "/ū/", "/ŭ/", "/ů/", "/ű/", "/ų/", "/ư/", "/ǔ/", "/ǖ/", "/ǘ/", "/ǚ/", "/ǜ/", "/υ/", "/ύ/", "/ϋ/", "/ủ/", "/ụ/", "/ừ/", "/ứ/", "/ữ/", "/ử/", "/ự/"));
            $vietL[$i++] = array('i', array("/ì/", "/í/", "/î/", "/ï/", "/ĩ/", "/ī/", "/ĭ/", "/ǐ/", "/į/", "/ı/", "/η/", "/ή/", "/ί/", "/ι/", "/ϊ/", "/ỉ/", "/ị/", "/и/", "/ы/", "/ї/"));
            $vietL[$i++] = array('y', array("/ý/", "/ÿ/", "/ŷ/", "/ỳ/", "/ỹ/", "/ỷ/", "/ỵ/", "/й/"));
            $vietL[$i++] = array('d', array("/ð/", "/ď/", "/đ/", "/δ/", "/д/"));
            unset($i);
        }
        for ($i = 0; $i < count($vietL); $i++) {
            $stripped_str = preg_replace($vietL[$i][1], $vietL[$i][0], $stripped_str);
            $stripped_str = preg_replace($vietU[$i][1], $vietU[$i][0], $stripped_str);
        }
        if ($stripSpace) {
            $stripped_str = str_replace(' ', '', $stripped_str);
        }
        if ($replaceSpace) {
            $stripped_str = preg_replace(array('[^[^a-zA-Z0-9]+/[^a-zA-Z0-9]+$]', '[[^a-zA-Z0-9\-]+]'), array('', $replaceSpace), $stripped_str);
        }
        $ret = strtolower($stripped_str);
        if(strpos($ret, '---') !== false){
            return  str_replace('---', '-', $ret);
        }else{
            return  str_replace('--', '-', $ret);
        }

    }

    public static function unit($n){
        if($n < 1000){
            return $n . ' đồng';
        }
        if($n>1000 && $n < 1000000 ){
            $roundNumber = round(($n/1000),0);
            $unit  =  self::numberFormat($roundNumber, 0). ' ngàn đồng ';
            return $unit;
        }
        if($n>1000000 && $n<1000000000){
            $roundNumber = round(($n/1000000),0);
            $unit  =  self::numberFormat($roundNumber, 0). ' triệu';
            return $unit;
        }

        if($n>1000000000){
            $calculateNumber = round(($n/1000000000),3);
            $numberB = floor($calculateNumber);
            $numberM = ($calculateNumber - $numberB)*1000;// triệu
            $unit  =  sprintf('%s tỷ %s triệu', $numberB,round($numberM,0));
            return $unit;
        }
    }

    public static function numberEncode($number){
        $number = $number + gmmktime(0, 0, 0, 10, 04, 1979);
        $number = strtoupper(dechex($number));
        $string = str_replace(array('1', '2', '3','4','5'), array('I', 'W', 'O', 'U', 'Z'), $number);
        return $string;
    }

    public static function numberDecode($string) {
        $string = preg_replace('/[1-5]/', '%', $string);
        if (preg_match('/%/', $string)) {
            return false;
        }
        $number = str_ireplace(array('I', 'W', 'O', 'U', 'Z'), array('1', '2', '3','4','5'), $string);
        $number = hexdec($number);
        return $number = $number - gmmktime(0, 0, 0, 10, 04, 1979);
    }


    public static function emptyFolder($target,$isRemoveByDate = FALSE)
    {
        if (is_dir($target))
        {
            $files = glob( $target . '/*');
            foreach( $files as $file )
            {
                self::emptyFolder($file,$isRemoveByDate);
            }
        }else if (is_file($target)){
            if($isRemoveByDate == TRUE){
                $beforeWeek = strtotime("-1 week");
                $dateCreateFile    = filemtime($target);
                if($dateCreateFile <= $beforeWeek){
                    unlink($target);
                }
            }
            else{
                unlink($target);
            }
        }
    }

    /**
     * @param string $condition
     * @param string $target
     * @param bool  $isImage
     * @return bool
     */
    public static function removeFileByDate($condition ,$target ,$isImage = FALSE){
    	if(!$condition){
    		$condition = '-1 week';
		}
        if (is_dir($target)) {
            $files = glob($target . '/*');
            foreach ($files as $file) {
                self::removeFileByDate($condition, $file);
            }
        } else if (is_file($target)|| $isImage === TRUE ) {
            $beforeWeek = strtotime($condition);
            $dateCreateFile = filemtime($target);
            if ($dateCreateFile <= $beforeWeek) {
                unlink($target);
            } else {
                unlink($target);
            }
        }
        return TRUE;
    }


    public static function calculateTotalPage($total,$limit = EXPORT_LIMIT){
        $totalPages = 1;
        if($total > $limit){
            $totalPages  = (int) ceil($total/$limit);
        }
        return $totalPages;

    }


    public static function uploadOptions($name,$dirUpload = UPLOAD_BASE_DIR)
    {
        $config = array();
        $config['upload_path'] = '.'.$dirUpload;
        $config['allowed_types'] = '*';
        $config['file_name']     = $name;
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;
        $config['encrypt_name'] = TRUE;
        return $config;
    }

    public static function generateLinkDownLoad($total){
        $totalPages = Common::calculateTotalPage($total);
        $res = array();
        if ($totalPages >= 1) {
            for ($i = 1; $i <= $totalPages; $i++) {
                $res[] = $i;
            }
        }else{
            $res = '';
        }
        return $res;
    }


    public static function getFieldObj($field = array()){
        $CI =& get_instance();
        $res = (object) $CI->input->get($field, TRUE);
        return $res;
    }


    public static  function vndText($amount)
    {
        if($amount <=0)
        {
//            return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
            return $textnumber="";
        }
        $Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);

        for ($i = 0; $i < $length; $i++)
            $unread[$i] = 0;

        for ($i = 0; $i < $length; $i++)
        {
            $so = substr($amount, $length - $i -1 , 1);

            if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
                for ($j = $i+1 ; $j < $length ; $j ++)
                {
                    $so1 = substr($amount,$length - $j -1, 1);
                    if ($so1 != 0)
                        break;
                }

                if (intval(($j - $i )/3) > 0){
                    for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
                        $unread[$k] =1;
                }
            }
        }

        for ($i = 0; $i < $length; $i++)
        {
            $so = substr($amount,$length - $i -1, 1);
            if ($unread[$i] ==1)
                continue;

            if ( ($i% 3 == 0) && ($i > 0))
                $textnumber = $TextLuythua[$i/3] ." ". $textnumber;

            if ($i % 3 == 2 )
                $textnumber = 'trăm ' . $textnumber;

            if ($i % 3 == 1)
                $textnumber = 'mươi ' . $textnumber;


            $textnumber = $Text[$so] ." ". $textnumber;
        }

        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);

        return ucfirst($textnumber."đồng");
    }

    public static function checkExtension($pathFile){
        $data = @pathinfo($pathFile);
        $extension   = FALSE;
        if (isset($data) && is_array($data)) {
            $extensions = array(
                'xlsx','xls'
            );
            if(in_array($data['extension'],$extensions)){
                $extension = TRUE;
            }
        }
        return $extension;
    }
    public function getDataExcel(){
        $pathFile  = $this->input->post('path',TRUE);
        $isExtension = Common::checkExtension($pathFile);
        $res = array(
            'msg'       => '<h2 class="text-center text-danger">File Upload không hỗ trợ(Chỉ hỗ trợ file có đuôi: xlsx,xls)</h2>',
            'success'   => FALSE
        );
        if($isExtension === TRUE){
            $dataExcel = $this->excel->readOneSheet(FCPATH.$pathFile,TRUE);
            $res['data'] = ($dataExcel);
            $res['success'] = TRUE;
        }
        echo json_encode($res);

    }
    public static function htmlEntities($html){
        return htmlentities($html,ENT_COMPAT, 'UTF-8');
    }
    public  static function removeOldFile($dataOldFiles = array()){
        if(!empty($dataOldFiles)){
            $dataOldFiles = json_decode($dataOldFiles);
            if(is_array($dataOldFiles)){
                foreach ($dataOldFiles as $oldFile){
                    Upload::deletePhysicFile($oldFile);
                }
            }else{
                Upload::deletePhysicFile($dataOldFiles);
            }
        }
    }

    public static function roundNumberAndFormat($number ,$isFormat = FALSE,$precision = -3){
        $number = round($number,$precision);
        if($isFormat === TRUE){
            $number = self::numberFormat($number,0);
        }
        return $number;
    }
    public static function getTimeAgo($currentDay,$condition = "-2 year"){
        $timeAgo = date('Y/m/d',strtotime($condition,strtotime($currentDay)));
        return $timeAgo;
    }
    public static function fileExits($pathFile){
        $fileExits = FALSE;
        if (file_exists($pathFile)) {
            $fileExits = TRUE;
        }
        return $fileExits;
    }
    public static function decodeData($data){
        $res  = new stdClass();
        if(!empty($data)){
            foreach ($data as $k=> $v){
                if($k === 'value'){
                    $res->$k = json_decode($v);
                }else{
                    $res->$k = $v;
                }
            }
        }
        return $res;
    }

    public static function encodeNameFile($ext){
        $filename = sprintf('%s.%s', md5(uniqid(mt_rand())),$ext);
        return $filename;
    }
    public static function trim($string, $isTrimSpace = false){
        $string = trim(strip_tags($string));
        if($isTrimSpace){
            $string = self::trimSpace($string);
        }
        return $string;
    }
    public static function trimSpace($string){
        return trim(preg_replace('/\s+/', ' ',$string));
    }


	public static function getInfoUids($paramQuery,$apiUrl = '',$conditions = [])
	{
		if(!$apiUrl){
			$apiUrl = URL_API_FLASH.'uids?%s';
		}
		$queryParams = [
			'email' => USER_API_FLASH,
			'pass'  => PASSWORD_API_FLASH,
			'token' => USER_TOKEN_API,
		//	'db'	=> DB_NAME_SELECT_API,
		];
		if($conditions){
			$queryParams = array_merge($queryParams,$conditions);
		}
		$apiUrl = sprintf($apiUrl, http_build_query($queryParams));
//		echo "<pre>";print_r($apiUrl);die;
//		$paramQuery = http_build_query(['uids'  => $uids]);
//		echo "<pre>";print_r($paramQuery);die;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $apiUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch,CURLOPT_POST,TRUE);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $paramQuery);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($ch);
		if (curl_errno($ch)) {
			echo "\nURL: " . $apiUrl . " Error is : " . curl_error($ch) . "\n";
		}
		curl_close($ch);
		$content = json_decode($content);
		if (isset($content->data))
		{
			return $content->data;
		}
		echo json_encode($content);die();

	}

	public static function getFileContent($url, $method = 'get', $postField = array(), $withHead = TRUE, $tokenAuthor = '') {
		try {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//			curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36');
			if($withHead){
				$head[] = "Connection: keep-alive";
				$head[] = "Keep-Alive: 300";
				$head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
				$head[] = "Accept-Language: en-us,en;q=0.5";
				if($tokenAuthor){
					$head[] = "Content-Type: application/json";
					$head[] = "Authorization: Bearer ".$tokenAuthor;
				}
				curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
			}
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			if($method === 'post'){
				curl_setopt($ch, CURLOPT_POST, 1); // cai nay phai nam giua khong loi [Request Entity Too Large (E1235)]
				if($postField){
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postField);
				}
			}
			$content = curl_exec($ch);
			if (curl_errno($ch)) {
				echo "\nURL: " . $url . " Error is : " . curl_error($ch) . "\n";
			}
			curl_close($ch);
			return $content;
		} catch (\Exception $e) {
			print_r($e);
			return false;
		}
	}


	public static function getRequest(
		string $endpoint,
		$params = [],
		array $headers = [],
		string $method = 'GET'
	): array {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		if ($method === 'POST') {
			curl_setopt($ch, CURLOPT_POST, true);
			if (is_array($params)) {
				$params = json_encode($params);
			}

			curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		}

		$response = curl_exec($ch);
		$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errors = curl_error($ch);
		curl_close($ch);

		return ['response' => $response, 'statusCode' => $statusCode, 'errors' => $curl_errors];
	}
}