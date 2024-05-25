<?php
/**
 * controller class
 */
namespace App\Controllers;

class Controller
{
	
	function __construct() {}

	public function view($file_name, $data=null){
		if($data){
			if(is_array($data))
			extract($data);
		}
       return 'resources/views/'.$file_name.'.php';
	}

	public function main_page($file_name){
       return 'resources/views/'.$file_name.'.php';
	}
}