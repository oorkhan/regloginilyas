<?php
    session_start();
    require_once("includes/config.php");

    if(isset($_GET["id"])){
        $id = $_GET["id"];
        //$sql = 'DELETE FROM posts WHERE id = :id && user_id = :user_id';
        $sql = 'UPDATE posts SET is_deleted=1 WHERE id=:id && user_id=:user_id';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id , 'user_id' => $_SESSION["id"]]);
        if($stmt){
            header("Location:welcome.php");
        }else{
            echo "Problem occured.";
        }
    }

?>