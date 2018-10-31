<?php
 require_once 'includes/config.php';

 $id = $_POST['id'];
 $title = $_POST['title'];
 $body = $_POST['body'];


    $sql = 'UPDATE posts SET title = :title, body = :body WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title'=>$title, 'body' => $body, 'id' => $id]);

/*  $query = "  
           UPDATE tbl_employee   
           SET name='$name',   
           address='$address',   
           gender='$gender',   
           designation = '$designation',   
           age = '$age'   
           WHERE id='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';   */

?>