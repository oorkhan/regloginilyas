<?php  include 'includes/header.php'; ?>
<?php
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
    $id = $_SESSION['id'];
    $sql = 'SELECT * FROM users WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch();
    //var_dump($user);
    if(!$user){
      echo "<h1>404</h1>";exit;
    }

?>

    <div class="container">
      <img style="display:block;margin:auto;" src="images/<?= $user["profile_img"] ?>" alt="">
      <form class="" action="profile_img_upload.php" method="POST" enctype="multipart/form-data">
        <label>
          Shekli deyish
          <input type="file" name="shekil" value="" style="display:none">
        </label>

        <input type="submit" class="btn blue" value="Yukle">
      </form>
      <h1 style="text-align:center;margin:0;"><?= $user["name"] . " ".$user["surname"] ?></h1>
    </div>


<?php  include 'includes/footer.php'; ?>
