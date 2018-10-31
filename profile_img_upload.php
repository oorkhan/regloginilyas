<?php
  session_start();
  require "vendor/autoload.php";
  require("includes/config.php");
  use Intervention\Image\ImageManagerStatic as Image;

  //Image::configure(array('driver' => 'imagick'));

  if(isset($_FILES["shekil"])){
    $s = 'SELECT profile_img FROM users WHERE id=:id';
    $stmt = $pdo->prepare($s);
    $stmt->execute(['id' => $_SESSION["id"]]);
    $old_img = $stmt->fetch()["profile_img"];
    $img = Image::make($_FILES['shekil']['tmp_name']);
    $ext = pathinfo($_FILES['shekil']['name'], PATHINFO_EXTENSION);
    $img->fit(300, 300);// resize image
    $filename = time().".".$ext;
    if($img->save('images/' . $filename)){// save image
      $sql = 'UPDATE users SET profile_img = :img WHERE id = :id';
      $stmt = $pdo->prepare($sql);
      if($stmt->execute(['img'=>$filename, 'id' => $_SESSION["id"]])){
        unlink('images/'.$old_img); //  kohne shekli siler.
        header("Location:profile.php");
      }
    }
  }

 ?>
