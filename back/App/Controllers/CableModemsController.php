<?php

namespace App\Controllers;

use App\Classes\Response;
use App\Models\JsonModel;
use App\Models\DocsisUpdateModel;

class CableModemsController
{
	/**
	  * return cablemodems records from DB
	  * @return json
	  */
	public function get() {

		$response = [];
		$docsisUpdate = $this->get_docsisUpdate();
		$json = $this->read_models();
		
		foreach($docsisUpdate as $dsu) {
			
			$return_dsu = true;
			
			foreach($json['models'] as $js) {
				if($this->match($dsu, $js)) {
					$return_dsu = false;
					break;
				}
			}

			if ($return_dsu) {

				$response[] = [
					'modem_macaddr' => $dsu['modem_macaddr'],
					'ipaddr' => $dsu['ipaddr'],
					'vsi_model' => $dsu['vsi_model'],
					'vsi_swver' => $dsu['vsi_swver'],
					'vsi_vendor' => $dsu['vsi_vendor'],
				];
			}
		}
		$res = new Response($response);
	}

	/**
	 * checks if records match:
	 * 1 - vsi_vendor must be equal to vendor
	 * 2 - vsi_swver must be equal to soft
	 * 3 - vsi_model must be equal to name
	 * 
	 * @param array $dsu 
	 * @param array $js 
	 * @return bool
	 */
	public function match($dsu, $js) {

		if( strncmp($dsu['vsi_vendor'], $js['vendor'], strlen($js['vendor'])) === 0 &&
			strcmp($dsu['vsi_swver'], $js['soft']) === 0 &&
			strcmp($dsu['vsi_model'], $js['name']) === 0) {
			return true;
		}
		return false;
	}

	/**
	 * retrieves docsisUpdate records
	 * @return array
	 */
	private function get_docsisUpdate() {

		$docsisUpdate = new DocsisUpdateModel();
		return $docsisUpdate->get_by_vendor($this->params['vendor']);
	}

	/**
	 * retrieves docsisUpdate records
	 * @return array
	 */
	private function read_models() {
		
		$jsonModel = new JsonModel();
		return $jsonModel->read();
	}
}