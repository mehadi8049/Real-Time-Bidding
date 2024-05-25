<?php 

namespace App\Controllers;

use App\Models\User;
use Exception;

class UserController extends Controller{
	
	public function index(){
		$users=User::selectAll();
		$page = $this->view('frontend/pages/index',['users'=>$users]);
		
        include $this->main_page('frontend/layout');
	}

	public function create(){
		try {
			$page = $this->view('frontend/pages/create');
            include $this->main_page('frontend/layout');
		}catch(Exception $e) {
			session_start();
			$errors['exception'] = $e->getMessage();
			$_SESSION['errors']=$errors;
			return back();
		}
	}


	public function store(){
		$name = input($_POST["name"]);
		$email = input($_POST["email"]);
		$url = input($_POST["url"]);
		$address = input($_POST["address"]);
        $errors=$this->validation($name,$email,$url,$address);
		if(!empty($errors)){
			session_start();
			$_SESSION['errors']=$errors;
			$_SESSION['old']=$_POST;
			return back();
		};
		try {
			$query="INSERT INTO ".User::$table." (name, email,address,url) VALUES (:name, :email, :address, :url)";
			User::create($query,[
				"name"=> $name,
				"email"=> $email,
				"address"=> $address,
				"url"=> $url
			]);
			session_start();
			$_SESSION['message']='User has been created successfully.';
			return back();
		}catch(Exception $e) {
			session_start();
			$errors['exception'] = $e->getMessage();
			$_SESSION['errors']=$errors;
			return back();
		}
	}

	

	public function edit($user_id){
		try {
			$user = User::find($user_id);
			$page = $this->view('frontend/pages/edit',['user'=>$user]);
            include $this->main_page('frontend/layout');
		}catch(Exception $e) {
			session_start();
			$errors['exception'] = $e->getMessage();
			$_SESSION['errors']=$errors;
			return back();
		}
	}

	public function update($user_id){
		$name = input($_POST["name"]);
		$email = input($_POST["email"]);
		$url = input($_POST["url"]);
		$address = input($_POST["address"]);
		$errors=$this->validation($name,$email,$url,$address);
		if(!empty($errors)){
			session_start();
			$_SESSION['errors']=$errors;
			$_SESSION['old']=$_POST;
			return back();
		};
		try {
			$query="UPDATE ".User::$table." SET name = :name, email = :email, address= :address, url= :url WHERE id = :id";
			User::update($query,[
				"name"=> $name,
				"email"=> $email,
				"address"=> $address,
				"url"=> $url,
				"id"=> $user_id
			]);
			session_start();
			$_SESSION['message']='User has been updated successfully.';
			return redirect('/users');
		}catch(Exception $e) {
			session_start();
			$errors['exception'] = $e->getMessage();
			$_SESSION['errors']=$errors;
			return back();
		}
	}

	public function delete($user_id){
		
		try {
			User::deleteById($user_id);
			session_start();
			$_SESSION['message']='User has been deleted successfully.';
			return back();
		}catch(Exception $e) {
			session_start();
			$errors['exception'] = $e->getMessage();
			$_SESSION['errors']=$errors;
			return back();
		}
	}

	protected function validation($name,$email,$url,$address):array
	{
		$errors = [];
		if(empty($name)){
			$errors['name']="The name field is required.";
		}
		if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
			$errors['name'] = "Only letters and white space allowed";
		}
		if(empty($email)){
			$errors['email']="The name field is required.";
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = "Invalid email format";
		}
		if (!empty($url) && !preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
			$errors['url'] = "Invalid URL";
		}
		if (!empty($address) && !is_string($address)) {
			$errors['address'] = "Invalid Address";
		}
		return $errors;
	}

}