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
	protected $db_charset;

	function __construct()
	{
		$this->db_host =env('DB_HOST');
    	$this->db_name = env('DB_NAME');
    	$this->db_user = env('DB_USER_NAME');
    	$this->db_password = env('DB_PASSWORD');
		$this->db_charset = 'utf8mb4';
	}
    public function connect(){
    	try {
			$dsn = "mysql:host=$this->db_host;dbname=$this->db_name;charset=$this->db_charset";
			$options = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // Set default fetch mode to FETCH_OBJ
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			$this->link = new PDO($dsn, $this->db_user, $this->db_password,$options);
		} catch(PDOException $e) {
			return "Connection failed: " . $e->getMessage();
		}
		return $this->link;
    }
}