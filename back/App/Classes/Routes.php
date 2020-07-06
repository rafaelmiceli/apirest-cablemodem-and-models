<?php

namespace App\Classes;

use App\Classes\Response;

class Routes
{
	/**
	 * uri from url
	 */
	private $uri;

	/**
	  * stores relationships beetween
	  */
	private $uris = [];

	public function __construct() {
		
		$this->uri = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1);
	}

	/**
	  * registers new uri
	  *
	  * @param string $uri
	  * @param string $httpVerb
	  * @param string ControllerName
	  * @param string $method 
	  */
	public function add_route($uri, $httpVerb, $controller, $method)
	{
		$this->uris[$uri][$httpVerb] = [
				'controller' => $controller,
				'method' => $method
		];
	}

	/**
	  * checks if incomming requests are allowed 
	  * and call Controller Method to process request
	  *
	  * @return boolean
	  */
	public function check_request()
	{
		$server_method = $_SERVER['REQUEST_METHOD'];
		$vars = $this->get_vars_from_url();

		#validates url
		if(empty($this->uris[$this->uri])) {

			$response = new Response(['msg'=> 'URI Not Definded'], 403);

		} elseif(empty($this->uris[$this->uri][$server_method])) {
			
			$response = new Response(null, 403);
		}
		
		#call controller and its method
		$class = sprintf('App\Controllers\%s', $this->uris[$this->uri][$server_method]['controller']); 
		$instance = new $class();
		$instance->params = $vars;
		$instance->{$this->uris[$this->uri][$server_method]['method']}();
	}

	/**
	  * returns entry point from query string
	  *
	  * @return string
	  */
	private function get_vars_from_url()
	{
		$vars = [];
		if($_SERVER['REQUEST_METHOD']=='GET') {

			if(!empty($_SERVER['QUERY_STRING'])) {
				parse_str($_SERVER['QUERY_STRING'], $vars);
			}	
		} else {
			
			$entityBody = file_get_contents('php://input');
			$vars = json_decode($entityBody, true);
		}		
		return $vars;
	}
}