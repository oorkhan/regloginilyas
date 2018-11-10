<?php
    /* Database credentials. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'new_db');

    /* Attempt to connect to MySQL database */
    try{
        $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        die("ERROR: Could not connect. " . $e->getMessage());
    }




    function user_liked_post($pdo,$user_id,$post_id){
      require_once("config.php");
      $sql = "SELECT * FROM likes WHERE user_id=:uid AND post_id=:pid";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(["uid"=>$user_id,"pid"=>$post_id]);
      if($stmt){
        if($stmt->rowCount() > 0){
          return true;
        }
      }

      return false;
    }
?>
