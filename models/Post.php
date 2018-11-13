<?php
  
  class Post{
    public $id,$title,$body,$images,$user_id;

    public function save(){
      $sql = "INSERT INTO posts(title,body,user_id) VALUES(:title,:body,:user_id)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute(["title"=>$this->title,"body"=>$this->body,"user_id"=>$this->user_id]);
      return (bool)$stmt;
    }
  }


 ?>
