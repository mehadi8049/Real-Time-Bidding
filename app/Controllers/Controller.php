<?php 

namespace App\Controllers;

class Controller{
    function __construct() {}

	public function view($file_name, $data=false){
		if($data==true){
			if(is_array($data))
			extract($data);
		}
       return 'resources/views/'.$file_name.'.php';
	}

	public function load($file_name){
       return 'resources/views/'.$file_name.'.php';
	}
}