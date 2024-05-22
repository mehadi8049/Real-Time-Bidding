<?php
namespace Config;

use PDO;
use PDOException;

/**
 * database connection
 */
class DB
{
	protected $link;
	protected $db_host;
	protected $db_name;
	protected $db_user;
	protected $db_password;

	function __construct()
	{
		$this->db_host =env('DB_HOST');
    	$this->db_name = env('DB_NAME');
    	$this->db_user = env('DB_USER_NAME');
    	$this->db_password = env('DB_PASSWORD');
	}
    public function connect(){
    	try {
			$this->link = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_password);
			// Set the PDO error mode to exception
			$this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			return "Connection failed: " . $e->getMessage();
		}
		return $this->link;
    }
}