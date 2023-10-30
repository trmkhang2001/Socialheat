<?php

namespace app\controllers\backend;

use app\common\business\BusinessUser;
use Quick_filter;

class ApiController extends \CI_Controller {

	public $auth;
	protected $data;
	public $input ;

	function __construct()
	{
		parent::__construct();
		$this->input = new \CI_Input();
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->data = array('success' => FALSE, 'data' => NULL,'status_code' => 200);
//		$this->appHeader();
	}

	/**
	 * @throws \JsonException
	 */
	public function inputJson($keys = [], $isArray = TRUE)
	{
		$raw_data = file_get_contents("php://input");
		$data = json_decode($raw_data, $isArray);

		if (is_string($keys))
		{
			return isset($data[$keys]) ? $data[$keys] : NULL;
		}

		if (is_array($keys) && !empty($keys))
		{
			$res = array();
			foreach ($keys as $e)
			{
				if (isset($data[$e]))
				{
					$res[$e] = $data[$e];
				} else
				{
					$res[$e] = NULL;
				}
			}
			return $res;
		}
		return $data;

	}

	public function appHeader()
	{
		if (isset($_SERVER['HTTP_ORIGIN']))
		{
			header("Access-Control-Allow-Origin: *");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day

		}
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
		{
			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
			exit(0);
		}
	}

	public function authRequire()
	{
		$data= $this->input->get(['email','pass','token'],TRUE);
		$filter = Quick_filter::make($data, [
			'email'    => Quick_filter::text(),
			'pass'      => Quick_filter::text(),
			'token'     => Quick_filter::text(),
		]);
		if ($filter === FALSE)
		{
			$this->response_invalid_input();
		}
		if ($filter instanceof \Zend\InputFilter\InputFilter)
		{
			if ( ! $filter->isValid())
			{
				$this->response_invalid_input($filter->getMessages());
			}
			$data = $filter->getValues();
		}
		try{
			$user = BusinessUser::getInstance()->checkAuth($data['email'], $data['password']);
			if ( ! $user)
			{
				$this->response(['message' => 'Email, password  ko đúng'], 401);
			}
			if($data['token'] !== IMPORT_ACCESS_TOKEN){
				$this->response(['token' => 'Token không đúng'], 401);
			}
			if ((int)$user->status !== STATUS_ACTIVE)
			{
				$this->response(['message' => 'Tài khoản này không hoạt động'], 500);
			}
			$this->auth = $user;
		 }catch(\Exception $e){
			$this->response(NULL, 401);

		}
	}


	/**
	 * @throws \JsonException
	 */
	public function response($data = NULL, $http_code= 200)
	{
		if ($data)
		{
			$this->data = $data;
		}
		if ($http_code === 200 || $http_code === 204 || $http_code === 201 || $http_code === 202)
		{
			$data['success'] = TRUE;
		} else
		{
			$data['success'] = FALSE;
		}
		$this->data = $data;
		$this->data['status_code'] = $http_code;
		echo json_encode($this->data,   JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
		exit;
	}

	public function response_success($data)
	{
		$this->response($data, 200);
	}

	public function response_created()
	{
		$this->response(NULL, 201);
	}

	public function response_success_no_content()
	{
		$this->response(NULL, 204);
	}

	public function response_invalid_input($invalid_data = NULL)
	{
		if ($invalid_data !== NULL)
		{
			$this->response(['invalid_data' => $invalid_data], 400);
		}
		$this->response(NULL, 400);
	}

	public function response_access_denied()
	{
		$this->response(NULL, 401);
	}

	public function response_not_found()
	{
		$this->response(NULL, 404);
	}

	public function response_method_not_allowed()
	{
		$this->response(NULL, 405);
	}

	public function response_error($data = NULL)
	{
		$this->response($data, 500);
	}

	/**
	 * @param \Exception $exception
	 */
	public function response_exception($exception)
	{
		$this->response(['message' => $exception->getMessage()], 500);
	}

	public function checkAuth($accessToken = '')
	{
		if (empty($accessToken))
		{
			$accessToken = $this->input->get('AccessToken', TRUE);
			if (empty($accessToken))
			{
				$postData = $this->inputJson();
				if ($postData)
				{
					$accessToken = $postData['AccessToken'];
				}
			}
		}


		//$accessToken = $this->input->post('AccessToken', TRUE);


		if ($accessToken !== ACCESS_TOKEN)
		{
			$this->response(['message' => 'Invalid access token'], 401);
		}
	}
}