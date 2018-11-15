<?php

//require("Database.php");
require("Model.php");

  class Post extends Model{
    public static $table = "posts";

  }

  var_dump(Post::all());


 ?>
