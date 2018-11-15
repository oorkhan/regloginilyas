<?php
  class Database{
    public static $dbhost,$dbuser,$dbpass,$dbname;

    public function __construct($h,$u,$p,$d){
      self::$dbhost = $h;
      self::$dbuser = $u;
      self::$dbpass = $p;
      self::$dbname = $d;
    }

    public static $con = null;
    public static function connect(){
      self::$con = new PDO("mysql:host=" . self::$dbhost . ";dbname=" . self::$dbname, self::$dbuser, self::$dbpass);
      self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return self::$con;
    }

  }


 ?>
