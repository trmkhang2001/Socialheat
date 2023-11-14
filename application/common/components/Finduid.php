<?php

namespace app\common\components;

use app\common\utilities\Common;
use app\common\components\exception\ConnectionException;
use app\common\components\exception\InvalidParamException;

require_once(APPPATH . 'common/third_party/simple_html_dom.php');

class Finduid {

	private ?string $link;
	private  $cookie = NULL;
	protected $response = [];
	const TRAO_DOI_SUB_URL_GET_ID_FB = 'https://id.traodoisub.com/api.php';
	const APT_SOFT_WARE_URL_GET_ID_FB = 'https://atpsoftware.vn/finduid/finduidfromlink.php?link=';

	const STATUS_CODE_SUCCESS = 200;


	public function __construct($config)
	{
		$this->link = $config->link;
	}

	public function setCooike(?string $cookie)
	{
		$this->cookie = $cookie;
		return $this;
	}

	public function getIdPostByAPT()
	{
		$endPoint = self::APT_SOFT_WARE_URL_GET_ID_FB . $this->link;
		$headers = self::getHeaderAtpsoftware();
		$headers[] = "path: /finduid/finduidfromlink.php?link=" . $this->link;
		$response = Common::getRequest(
			$endPoint,
			[],
			$headers);
		if ($response['statusCode'] !== self::STATUS_CODE_SUCCESS)
		{
			throw new ConnectionException($response['errors'], $response['statusCode']);
		}
		$response = json_decode($response['response'], TRUE);
		return $this->setResponse(['type' => isset($response['type']) ? $response['type'] : NULL,'id' => isset($response['id']) ? $response['id'] : NULL]);
	}

	public function getIdPostByTraoDoiSub()
	{
		$url = $this->link;
		$params = http_build_query(['link' => $url]);
		$headers = self::getHeaderTraoDoiSub();
		$response = Common::getRequest(
			self::TRAO_DOI_SUB_URL_GET_ID_FB,
			$params,
			$headers,
			'POST'
		);
		if ($response['statusCode'] !== self::STATUS_CODE_SUCCESS)
		{
			throw new ConnectionException($response['errors'], $response['statusCode']);
		}
		$response = json_decode($response['response'], TRUE);
		return $this->setResponse(['id' => !empty($response['id']) ? $response['id'] : '','type' => '']);
	}

	private function setResponse(array $response)
	{
		$arrId = explode(',',$response['id']);
		if(count($arrId) > 1){
			$response['id'] = NULL;
		}
		$this->response = $response;
		return $this;
	}

	public function getResponse()
	{
		return $this->response;
	}


	static private function getHeaderTraoDoiSub()
	{
		$headers = [];
		$headers[] = 'authority: id.traodoisub.com';
		$headers[] = 'accept: application/json, text/javascript, */*; q=0.01';
		$headers[] = 'accept-language: en-US,en;q=0.9';
		$headers[] = 'cache-control: no-cache';
		$headers[] = 'pragma: no-cache';
		$headers[] = 'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"';
		$headers[] = 'sec-ch-ua-mobile: ?0';
		$headers[] = 'sec-ch-ua-platform: "macOS"';
		$headers[] = 'sec-fetch-dest: empty';
		$headers[] = 'sec-fetch-mode: cors';
		$headers[] = 'sec-fetch-site: same-origin';
		$headers[] = 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36';
		return $headers;
	}

	static private function getHeaderAtpsoftware()
	{
		$headers = [];
		$headers[] = 'authority: atpsoftware.vn';
		$headers[] = 'method: GET';
		$headers[] = 'scheme: https';
		$headers[] = 'accept: */*';
		$headers[] = 'accept-encoding: gzip, deflate, br';
		$headers[] = 'accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5';
		$headers[] = 'cookie: cf_clearance=yCuw8ODaoWYcw1lftSGDofjDwLVF211qz4OF7SWIdTk-1666065044-0-150; __gads=ID=6473c99e3b486520-22d0911015d700fc:T=1666065270:RT=1666065270:S=ALNI_MYDlNC2e0-i2ZwaOQO3cVUM2zBjGA; twk_uuid_560fb9c63e33bee649f598d6=%7B%22uuid%22%3A%221.4glIeWcGdwpFixNtSATfhfspQ3NluzISRo7mXYRhawUflah2L8EaXUJtQOUfhEWnJs4ow7eyfMn3y5f5CEdfXzRgi4IF3EvBbvKKTco6QLj4mxAOiKzlIWVRJbH6W1nMSbXasLYnsFoCp1x4Axq%22%2C%22version%22%3A3%2C%22domain%22%3A%22atpsoftware.vn%22%2C%22ts%22%3A1666065922581%7D; _gid=GA1.2.1151451306.1666585075; __gpi=UID=0000088860e9a1cd:T=1666065270:RT=1666585075:S=ALNI_Mb6Yz0qE0B4FrGk2Xjg2zX_W8ML2Q; _gat_gtag_UA_89205409_2=1; _ga_V59TKHQF7W=GS1.1.1666595029.2.1.1666595029.0.0.0; _ga=GA1.1.335156913.1666065271';
		$headers[] = 'referer: https://atpsoftware.vn/finduid/';
		$headers[] = 'sec-ch-ua: "Chromium";v="106", "Google Chrome";v="106", "Not;A=Brand";v="99"';
		$headers[] = 'sec-ch-ua-mobile: ?0';
		$headers[] = 'sec-ch-ua-platform: "macOS"';
		$headers[] = 'sec-fetch-dest: empty';
		$headers[] = 'sec-fetch-site: same-origin';
		$headers[] = 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36';
		return $headers;
	}


	public function getByLinkFB()
	{
		$response =  $this->getDomFromUrl($this->link);
		$this->setResponse($response);
		return $this;
	}

	public function setCookie(string $cookie)
	{
		$this->cookie = $cookie;
		return $this;
	}

	private function getDomFromUrl($link)
	{
		$headers[] = 'sec-ch-ua: "Chromium";v="106", "Google Chrome";v="106", "Not;A=Brand";v="99"';
		$headers[] = 'sec-ch-ua-mobile: ?0';
		$headers[] = 'sec-ch-ua-platform: "macOS"';
		$headers[] = 'sec-fetch-dest: document';
		$headers[] = 'sec-fetch-mode: navigate';
		$headers[] = 'sec-fetch-site: none';
		$headers[] = 'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36';
//		$headers[] = 'cookie: sb=uP4aYzQUZCRVJVTRXNeRwuwe; datr=uP4aYwG9cP2lRRWXPeqX_ros; c_user=100053586552553; wd=1920x969; xs=22%3AjAFY0fJY5MPK5Q%3A2%3A1663296927%3A-1%3A6170%3A%3AAcVvwPYWrPElEx0t6kXcBYi3nWBVQQqaP1wYbO5Mug; fr=0o3KTXf8Cu8wuBwrt.AWUuuD9tgyupmlKIN_dfNv8UiHY.BjWKTg.oi.AAA.0.0.BjWKTg.AWUShF4xZWs; presence=C%7B%22t3%22%3A%5B%5D%2C%22utc3%22%3A1666753968683%2C%22v%22%3A1%7D; useragent=TW96aWxsYS81LjAgKFdpbmRvd3MgTlQgMTAuMDsgV2luNjQ7IHg2NCkgQXBwbGVXZWJLaXQvNTM3LjM2IChLSFRNTCwgbGlrZSBHZWNrbykgQ2hyb21lLzEwNi4wLjAuMCBTYWZhcmkvNTM3LjM2; _uafec=Mozilla%2F5.0%20(Windows%20NT%2010.0%3B%20Win64%3B%20x64)%20AppleWebKit%2F537.36%20(KHTML%2C%20like%20Gecko)%20Chrome%2F106.0.0.0%20Safari%2F537.36;';
		if ($this->cookie)
		{
			$headers[] = "cookie: $this->cookie";

		}
		$response = Common::getRequest($link, [], $headers);
		if ($response['statusCode'] !== self::STATUS_CODE_SUCCESS)
		{
			throw new ConnectionException($response['errors'], $response['statusCode']);
		}
		$response = $response['response'];
		$response = str_replace(array('<!--', '-->'), "", ($response));
		$domHtml = self::getDomHtml($response);
		$dataElement = self::getListElement($domHtml, 'div.hidden_elem code div div', 'data-store');
		$data =  $this->_handleDataFormat($dataElement);
		if(empty($data['id'])){
			$dataElement = self::getListElement($domHtml, 'meta[property="al:ios:url"]','content');
			if(!empty($dataElement[0])){
				$info = explode('id=',$dataElement[0]);
				return ['id' => end($info),'type' => ''];
			}
		}
	}


	private function _handleDataFormat($data)
	{
		if ($data)
		{
			foreach ($data as $value)
			{
				if ($value)
				{
					$itemHtmlDecode = html_entity_decode($value);
					$itemDecode = json_decode($itemHtmlDecode, TRUE);
					if ( ! empty($itemDecode['hq-profile-logging']))
					{
						return ['id' => $itemDecode['hq-profile-logging']['profile_id'], 'type' => 'profile'];
					}
					if ($itemDecode === NULL)
					{
						$itemHtmlDecode = str_replace(['\\', '"{', '"}'], ["", "{", "}"], $itemHtmlDecode);
						$itemDecode = json_decode($itemHtmlDecode, TRUE);
						if (is_array($itemDecode) && ! empty($itemDecode['feedobjectsIdentifiers']))
						{
							$objectArr = explode(':', $itemDecode['feedobjectsIdentifiers']);
							$id = end($objectArr);
							return ['id' => $id, 'type' => 'post'];
						}
					}

				}
			}
			return ['id' => '', 'type' => ''];
		}
	}

	private static function getDomHtml($content)
	{
		ini_set('memory_limit', '-1');
		$domObj = NULL;
		if ($content)
		{
//			$domObj = str_get_html($content);
			$html = new \simple_html_dom();
			$html->load($content);
			$domObj = $html;

		}
		return $domObj;
	}

	public static function getListElement($htmlObj, $struct, $attribute = 'plaintext', $position = 0)
	{
		$ret = array();

		if ($htmlObj)
		{
			if ($position)
			{
				$listDataObj = $htmlObj->find($struct, $position);
			} else
			{
				$listDataObj = $htmlObj->find($struct);
			}

			if ($listDataObj)
			{
				foreach ($listDataObj as $dataObj)
				{
					if ($dataObj)
					{
						$ret[] = $attribute !== NULL ? $dataObj->$attribute : $dataObj;
					}
				}
			}

		}
		return $ret;
	}
}

