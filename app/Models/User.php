<?php 
namespace App\Models;

include_once ( __DIR__ ."/../Config/DB.php");
use Config\DB;

class User{
    public static $table='users';
    
    public static function create($query,$params){
        $db=new DB();
        $db_conn=$db->connect();
        $stmt = $db_conn->prepare($query);
        return $stmt->execute($params);
    }

    public static function find($id){
        $db=new DB();
        $db_conn=$db->connect();
        $stmt = $db_conn->prepare("select * FROM ".self::$table." WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public static function selectAll(){
        $db=new DB();
        $db_conn=$db->connect();
        $sql = "SELECT * FROM ".self::$table;
        $stmt = $db_conn->query($sql);
        $users = $stmt->fetchAll();
        return $users;
    }

    public static function update($query,$params){
        $db=new DB();
        $db_conn=$db->connect();
        $stmt = $db_conn->prepare($query);
        return $stmt->execute($params);
    }

    public static function deleteById($id){
        $db=new DB();
        $db_conn=$db->connect();
        $stmt = $db_conn->prepare("DELETE FROM ".static::$table." WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

}