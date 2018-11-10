<?php

  require("includes/config.php");
session_start();
  if(isset($_POST["text"])){
    //echo "hello";exit;
    $text = htmlspecialchars($_POST["text"]);
    $post_id = htmlspecialchars($_POST["pid"]);
    $user_id = $_SESSION["id"];
    //echo $text . " " . $post_id . " " . $user_id;exit;
    if(empty(trim($text))){
      echo "empty";exit;
    }

    $sql = "INSERT INTO comments(post_id,user_id,text) VALUES(:pid,:uid,:text)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["pid"=>$post_id, "uid"=>$user_id, "text"=>$text]);
    if($stmt){
      echo json_encode(["username"=>$_SESSION["username"] , "text"=>$text]);
    }else{
      echo "...";
    }


  }



 ?>
