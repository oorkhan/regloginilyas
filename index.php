<?php  include 'includes/header.php';
 ?>

  <?php

    $sql = "SELECT p.pid,p.title,l.like_count,p.body,p.name,p.surname,p.date,p.profile_img FROM (SELECT u.name,u.surname,u.profile_img,p.id as pid,p.title,p.date,p.body FROM users u INNER JOIN posts p ON p.user_id = u.id WHERE p.deleted=0 ORDER BY p.id DESC) p LEFT JOIN (SELECT count(id) as like_count,post_id FROM likes GROUP BY post_id) l ON l.post_id = p.pid ORDER BY pid DESC LIMIT 2";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll();
   ?>

  <div class="section no-pad-bot" id="index-banner">
    <div class="container container-of-posts">
      <?php foreach($posts as $post): ?>
        <div class="card-panel" data-id="<?= $post["pid"] ?>">
            <img height="50" style="border-radius:50%;border:2px solid grey;" src="images/<?= $post["profile_img"] ?>" alt="">
            <span class="black-text"><?= $post["name"] . " ".$post["surname"] ?></span>
            <h5 class=""><?= $post["title"] ?></h5>
            <p><?= strlen($post["body"]) > 200 ? substr($post["body"],0,200) . "..." : $post["body"] ?></p>
            <a href="post.php?id=<?= $post["pid"] ?>" class="btn green">Read more..</a>
            <p style="float:right;color:grey"><?= date("d-m-Y H:i" , strtotime($post["date"])) ?></p>
            <?php if(!user_liked_post($pdo,$_SESSION["id"] , $post["pid"])){  ?>
              <button data-id="<?= $post["pid"] ?>" onclick="like(<?= $post["pid"] ?>)" class="btn orange"><i class="material-icons">thumb_up</i></button>
            <?php }else{ ?>
              <button data-id="<?= $post["pid"] ?>" onclick="unlike(<?= $post["pid"] ?>)" class="btn red"><i class="material-icons">thumb_down</i></button>
            <?php } ?>
            <p>Likes : <span id="likes_of_<?= $post["pid"] ?>"><?= $post["like_count"] ? $post["like_count"] : 0 ?></span></p>
            <div>
              <ul class="comments" id="comments_of_<?= $post["pid"] ?>">

              </ul>
              <p><?= $_SESSION["username"].": " ?></p>
              <textarea id="comment_to_<?= $post["pid"]  ?>"></textarea>
              <button onclick="add_comment(<?= $post["pid"]  ?>)" class="btn blue">Add comment</button>
            </div>
        </div>
      <?php endforeach; ?>


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
