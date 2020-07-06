<?php

namespace App\Classes;

class Response
{

	/**
	  * Defines sort of responses
	  *
	  * @param int $http_status
	  * @param array $data
	  * @return json
	  */
	public function __construct($data, $http_status = 200)
	{
		$this->set_headers();
		switch ($http_status) {
			case 200:
				header('HTTP/1.0 200 OK');
				echo json_encode($data);
				break;
			case 201:
				header('HTTP/1.0 201 Created');
				echo json_encode($data);
				break;
			case 403:
				header('HTTP/1.0 405 Method Not Allowed');
				echo json_encode($data);
				break;
			default:
				header('HTTP/1.0 405 BadMethod');
				echo json_encode($data);
				break;
		}
		die();
	}

	/**
	  * headers for CORs and Json Response
	  */
	private function set_headers()
	{
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
		header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('content-type: application/json; charset=utf-8');
	}
}