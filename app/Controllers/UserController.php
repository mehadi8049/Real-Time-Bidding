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
			return [
				'status' => false,
				'errors' => $e->getMessage(),
				'data' => [],
			];
		}
	}


	public function store(){
		try {
			$query="INSERT INTO ".User::$table." (name, email,address,url) VALUES (:name, :email, :address, :url)";
			User::create($query,[
				"name"=> $_POST["name"],
				"email"=> $_POST["email"],
				"address"=> $_POST["address"],
				"url"=> $_POST["url"]
			]);
			session_start();
			$_SESSION['message']='User has been created successfully.';
			return back();
		}catch(Exception $e) {
			return [
				'status' => false,
				'errors' => $e->getMessage(),
				'data' => [],
			];
		}
	}

	

	public function edit($user_id){
		try {
			$user = User::find($user_id);
			$page = $this->view('frontend/pages/edit',['user'=>$user]);
            include $this->main_page('frontend/layout');
		}catch(Exception $e) {
			return [
				'status' => false,
				'errors' => $e->getMessage(),
				'data' => [],
			];
		}
	}

	public function update($user_id){
		try {
			$query="UPDATE ".User::$table." SET name = :name, email = :email, address= :address, url= :url WHERE id = :id";
			User::update($query,[
				"name"=> $_POST["name"],
				"email"=> $_POST["email"],
				"address"=> $_POST["address"],
				"url"=> $_POST["url"],
				"id"=> $user_id
			]);
			session_start();
			$_SESSION['message']='User has been updated successfully.';
			return redirect('/users');
		}catch(Exception $e) {
			return [
				'status' => false,
				'errors' => $e->getMessage(),
				'data' => [],
			];
		}
	}

	public function delete($user_id){
		
		try {
			User::deleteById($user_id);
			session_start();
			$_SESSION['message']='User has been deleted successfully.';
			return back();
		}catch(Exception $e) {
			return [
				'status' => false,
				'errors' => $e->getMessage(),
				'data' => [],
			];
		}
	}

}