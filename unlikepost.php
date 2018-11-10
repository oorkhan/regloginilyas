<?php

  require("includes/config.php");
  session_start();

  if(isset($_POST["pid"])){
    //echo "hello";exit;
    $post_id = htmlspecialchars($_POST["pid"]);
    $user_id = $_SESSION["id"];

    $sql = "DELETE FROM likes WHERE post_id=:pid AND user_id=:uid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["pid"=>$post_id, "uid"=>$user_id]);
    if($stmt){
      $sql2 = "SELECT COUNT(*) as n FROM likes WHERE post_id = :pid";
      $stmt2 = $pdo->prepare($sql2);
      $stmt2->execute(["pid"=>$post_id]);
      $count  = $stmt2->fetchAll();
      echo $count[0]["n"];exit;
    }
  }



 ?>
