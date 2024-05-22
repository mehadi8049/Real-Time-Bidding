<?php 

namespace App\Controllers;

use App\Controllers\Controller;
use Exception;

class HomeController{
	
	public function index($_get){
		try {
			return json_response([
				'status' => false,
				'message' => null,
				'data' => []
			],200);
		}catch(Exception $e) {
			return json_response([
				'status' => false,
				'errors' => $e->getMessage(),
				'data' => [],
			],$e->getCode());
		}
	}

}