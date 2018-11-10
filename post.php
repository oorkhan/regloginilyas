<?php require_once("includes/header.php");?>

<?php

  if(isset($_GET["id"])){
    $post_id = htmlspecialchars($_GET["id"]);
    $sql = "SELECT posts.id,posts.title,posts.body, GROUP_CONCAT(images.url SEPARATOR ', ')  AS 'images'  from posts left JOIN images on posts.id=images.post_id WHERE posts.id = :post_id GROUP BY posts.id ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["post_id"=>$post_id]);
    $post = $stmt->fetch();
    //var_dump($post);
  }
  if(!$post) echo "<h1>Post tapilmadi...</h1>";
  else {
    $images = explode(', ',$post['images']);
  ?>


  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <div class="card-panel">
          <div style="width:500px;" class="carousel carousel-slider center">
            <?php foreach($images as $image): ?>
            <div class="carousel-item" href="#one!">
              <img height="500" src="<?= $image ?>">
            </div>
            <?php endforeach; ?>
          </div>
            <h5 class=""><?= $post["title"] ?></h5>
            <p><?= $post["body"] ?></p>
        </div>
    </div>
  </div>


  <?php } ?>
<?php require_once("includes/footer.php") ?>
