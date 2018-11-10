<?php  include 'includes/header.php'; ?>
<?php

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $num_per_page = 1;
    $offset = ($page-1) * $num_per_page;
    $user_id = $_SESSION['id'];
    //SELECT * FROM posts LEFT JOIN post_images ON posts.id = post_images.post_id
    $sql = "SELECT posts.id,posts.deleted,posts.title,posts.body, GROUP_CONCAT(images.url SEPARATOR ', ')  AS 'images'  from posts left JOIN images on posts.id=images.post_id WHERE user_id = :id AND deleted = 0 GROUP BY posts.id ASC LIMIT :offsett ,:per_page";
    $sql_for_count = "SELECT count(*) as post_count FROM posts WHERE user_id=:id AND deleted=0";
    $stmt_for_count = $pdo->prepare($sql_for_count);
    $stmt_for_count->execute(['id' => $user_id]);
    $say = $stmt_for_count->fetch()["post_count"];

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', (int) $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':offsett', (int) $offset, PDO::PARAM_INT);
    $stmt->bindValue(':per_page', (int) $num_per_page, PDO::PARAM_INT);
    $stmt->execute();
    $posts = $stmt->fetchAll();
    //var_dump($posts);exit;
/*     echo "<pre>";
    var_dump($posts);
    echo "</pre>"; */

?>




    <div class="container">
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. This is your posts</h3>
        <table id="post_table">
            <th>Title</th><th>Text</th><th>Images</th><th>Buttons</th>
    <?php
    foreach($posts as $post){ ?>
                  <tr>
                    <td><?= $post['title'] ?></td>
                    <td><?= $post['body'] ?></td>

                    <td style="width:200px;overflow:auto;">

                      <?php foreach(explode(', ',$post['images']) as $image): ?>
                      <img style="width:100px" src="<?=$image?>" alt="">
                      <?php endforeach; ?>
                    </td>

                    <td>
                      <a  id="<?= $post['id'] ?>" class="waves-effect waves-light btn modal-trigger blue edit_data" href="#modal1">Edit</a>
                      <a onclick="return confirm('Are you sure?')" class="waves-effect waves-light btn red delete_btn" href="postDelete.php?id=<?= $post['id'] ?>">Delete</a>
                    </td>
                  </tr>
           <?php
            }
          ?>
    </table>
    <!-- Modal edit Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
        <form method="post" id="update_form">
            <input type="hidden" name="id" id="id" />
            <div>Title: <input type="text" name="title" id="title"></div>
            <div>Text: <textarea name="body" id="body" cols="30" rows="100"></textarea></div>

            <button class="btn waves-effect waves-light" id="insert" type="submit" name="action">Update</button>
        </form>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
    </div>
  </div>
<!--modal delete-->
  <div id="modalDelete" class="modal">
    <div class="modal-content">
      <h4>Warning!</h4>
      <p>Are you sure?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" id="deleteYes" class="red modal-close waves-effect waves-yellow btn">Yes</a>
      <a href="#!" class="modal-close waves-effect waves-green btn">No</a>
    </div>
  </div>
    <p>
        <a href="reset-password.php" class="btn disabled">Reset Your Password</a>
        <a href="logout.php" class="btn">Sign Out of Your Account</a>
        <a href="add_post.php" class="btn">Add Post</a>
    </p>

    <div style="text-align:center;margin-top:40px;margin-bottom:40px;">
      <a  href="?page=1" class="btn <?= 1==$page ? 'disabled' : 'blue' ?>">First</a>
      <?php for($i=1;$i<=ceil($say/$num_per_page);$i++){ ?>
        <a  href="?page=<?= $i ?>" class="btn <?= $i==$page ? 'disabled' : 'blue' ?>"><?= $i ?></a>
      <?php } ?>
      <a  href="?page=<?= ceil($say/$num_per_page) ?>" class="btn <?= ceil($say/$num_per_page)==$page ? 'disabled' : 'blue' ?>">Last</a>
    </div>

</div>
     <?php  include 'includes/footer.php'; ?>
