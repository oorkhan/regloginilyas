<?php
  include 'includes/header.php';
  if(isset($_GET["q"])){
    $q = $_GET["q"];
    $sql = "SELECT * FROM posts WHERE title LIKE :q OR body LIKE :q AND deleted=0 ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['q'=>'%'.$q.'%']);
    $results = $stmt->fetchAll();
    //var_dump($results);exit;
  }
?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <h1>Search</h1>
      <form class="" action="" method="GET">
        <div class="row">
          <div class="input-field col s6">
            <input name="q" value="<?= $_GET["q"] ?? "" ?>" placeholder="Search..." id="q" type="text" class="validate">
          </div>
        </div>
      </form>

      <?php if(isset($results)){ ?>
      <div class="row">
        <?php foreach($results as $result): ?>
          <div class="col s12 card-panel">
            <h6><?= $result["title"] ?></h2>
            <p><?= $result["body"] ?></p>
            <a href="post.php?id=<?= $result["id"] ?>" class="btn green">Read more</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php } ?>
    </div>
    <div class="preloader-wrapper small active" id="loading" style="display:none">
      <div class="spinner-layer spinner-green-only">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
  </div>


  <?php  include 'includes/footer.php'; ?>
