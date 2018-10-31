<?php  include 'includes/header.php'; ?>
<?php

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
    $user_id = $_SESSION['id'];
    //SELECT * FROM posts LEFT JOIN post_images ON posts.id = post_images.post_id
    $sql = 'SELECT * FROM posts LEFT JOIN post_images ON (post_images.post_image_id = posts.id) WHERE user_id = :user_id ';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $user_id]);
    $posts = $stmt->fetchAll();
/*     echo "<pre>";
    var_dump($posts);
    echo "</pre>"; */

?>




    <div class="container">
        <h3>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. This is your posts</h3>
        <table id="post_table">
            <th>Title</th><th>Text</th><th>Buttons</th>
    <?php
       foreach($posts as $post){
           if($post['deleted'] == 0){
                echo '
                <tr><td>'.$post['title'].'</td><td>'.$post['body'].'</td><td>
                <a id="'.$post['id'].'" class="waves-effect waves-light btn modal-trigger blue edit_data" href="#modal1">Edit</a> 
                <a onclick="return confirm(\'Are you sure?\')" class="waves-effect waves-light btn red delete_btn" href="postDelete.php?id='.$post['id'].'">Delete</a></td></tr>
                <tr><td colspan="3"><h5 style="text-align:center">'.$post['title'].' Images</h5><img style="width:100px" src="'.$post['url'].'" alt=""></td></tr>
                ';
           }
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
    </div>
     <?php  include 'includes/footer.php'; ?>
