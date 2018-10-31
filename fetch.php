 <?php  
 //fetch.php  
require_once 'includes/config.php';
 if(isset($_POST["id"]))  
 {  

    $sql = 'SELECT * FROM posts WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $_POST["id"]]);
    $post = $stmt->fetch();
    echo json_encode($post);


/*       $query = "SELECT * FROM tbl_employee WHERE id = '".$_POST["employee_id"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);   */
 }  
 ?>