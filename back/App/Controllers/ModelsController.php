<?php

namespace App\Controllers;

use App\Models\JsonModel;
use App\Classes\Response;

class ModelsController
{
	/**
	  * 
	  */
	public function get()
	{
		$jsonModel = new JsonModel();
		$res = new Response($jsonModel->read());
	}

	/**
	  * 
	  */
	public function add()
	{
		$jsonModel = new JsonModel();
		$content = $jsonModel->read();
		array_unshift($content['models'], $this->params);
		$jsonModel->save($content);

		$res = new Response($this->params, 201);
	}
}