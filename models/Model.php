<?php
  require("Database.php");
  class Model{
    public static $table = "posts";


    public static function getById($id){
      $db  = new Database("localhost","root","","new_db");
      $con = $db->connect();
      $sql = "SELECT * FROM ".self::$table." WHERE id = :id";
      //var_dump($sql);
      $stmt = $con->prepare($sql);
      //var_dump($stmt);
      $stmt->execute(["id"=>$id]);
      $data = $stmt->fetch();
      $class= __CLASS__;
      $obj = new $class();
      foreach($data as $key=>$value){
        $obj->{$key} = $value; // $post->id = 1;
      }

      return $obj;
    }


    public static function all(){
      $db  = new Database("localhost","root","","new_db");
      $con = $db->connect();
      $sql = "SELECT * FROM ".self::$table;
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $data = $stmt->fetchAll();
      $objects = [];
      foreach($data as $key=>$value){
        $class= __CLASS__;
        $obj = new $class();
        $obj->{$key} = $value;
        $objects[] = $obj;
      }

      return $objects;
    }
  }


 ?>
