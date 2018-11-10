<?php  include 'includes/header.php'; ?>
<?php

require "vendor/autoload.php";
use Intervention\Image\ImageManagerStatic as Image;
use Ramsey\Uuid\Uuid;

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 // Define variables and initialize with empty values
$title = $body = $user_id = "";
$title_err = $body_err = $user_id_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //VALIDATE FIRST NAME
    if ((empty(trim($_POST["title"])))) {
        $title_err = "Please enter a title.";
    } else {
        $title = trim($_POST["title"]);
    }
    if ((empty(trim($_POST["body"])))) {
        $body_err = "Please enter a body.";
    } else {
        $body = trim($_POST["body"]);
    }
    $user_id = $_SESSION['id'];



    // Check input errors before inserting in database
    if(empty($title_err) && empty($body_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO posts (title, body, user_id) VALUES (:title, :body, :user_id)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":title", $param_title, PDO::PARAM_STR);
            $stmt->bindParam(":body", $param_body, PDO::PARAM_STR);
            $stmt->bindParam(":user_id", $param_user_id, PDO::PARAM_STR);


            // Set parameters
            $param_title = $title;
            $param_body = $body;
            $param_user_id = $user_id;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $post_id = $pdo->lastInsertId();

                if(isset($_FILES["images"])){
                  $tmp_names = $_FILES["images"]["tmp_name"];
                  $names = $_FILES["images"]["name"];
                  for($i=0;$i<count($names);$i++){
                    $img = Image::make($tmp_names[$i]);
                    $ext = pathinfo($names[$i], PATHINFO_EXTENSION);
                    $img->fit(300, 300);
                    //$filename = Uuid::uuid1()->toString().".".$ext;
                    $img->save('uploads/' . $names[$i]);
                    $url = "uploads/" . $names[$i];

                    $sqlImages = 'INSERT INTO images(url, post_id) VALUES (:url, :post_id)';
                    $stmtImages = $pdo->prepare($sqlImages);
                    $stmtImages->execute(['url'=>$url, 'post_id' => $post_id]);
                  }
                  //var_dump($tmp_names);exit;
                  //var_dump($_FILES["images"]);exit;
                }


                // Redirect to login page
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>
 <div class="container">
     <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
         <div>Title: <input type="text" name="title"></div>
         <div>Images: <input multiple type="file" name="images[]"></div>
         <div>Text: <textarea name="body" id="body" cols="30" rows="100"></textarea></div>
         <button class="btn waves-effect waves-light" type="submit" name="action">Add Post</button>
    </form>


 </div>

 <?php  include 'includes/footer.php'; ?>
