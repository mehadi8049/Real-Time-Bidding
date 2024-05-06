<?php
/**
 * 
 */
class Config
{
	public $db_host;
	public $db_user;
	public $db_password;
	public $db_name;

	function __construct()
	{
		$this->db_host=env('DB_HOST');
		$this->db_user=env('DB_USER_NAME');
		$this->db_password=env('DB_PASSWORD');
		$this->db_name=env('DB_NAME');
	}
}