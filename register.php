<?php  include 'includes/header.php'; ?>

<?php
    // Define variables and initialize with empty values
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}     
$name = $surname= $username = $password = $confirm_password = "";
$name_err = $surname_err = $username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //VALIDATE FIRST NAME
    if ((empty(trim($_POST["first_name"])))) {
        $name_err = "Please enter a first name.";
    } else {
        $name = trim($_POST["first_name"]);
    }
    if ((empty(trim($_POST["surname"])))) {
        $surname_err = "Please enter a surname.";
    } else {
        $surname = trim($_POST["surname"]);
    }
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($name_err) && empty($surname_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (name, surname, username, password) VALUES (:name, :surname, :username, :password)";
         
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name, PDO::PARAM_STR);
            $stmt->bindParam(":surname", $param_surname, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
            
            // Set parameters
            $param_name = $name;
            $param_surname = $surname;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Redirect to login page
                header("location: login.php");
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

<div class="row center-align">
    <form method="POST" class="col s4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="row">
       <div class="input-field col s12">
          <input name="first_name" id="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
          <span><?php echo $name_err; ?></span>
        </div>
       </div>
       <div class="row">
            <div class="input-field col s12">
            <input id="last_name" type="text" class="validate" name="surname">
            <label for="last_name">Last Name</label>
            </div>
            <span><?php echo $surname_err; ?></span>
       </div>

      <div class="row">
        <div class="input-field col s12">
          <input id="username" type="text" class="validate" name="username">
          <label for="username">Username</label>          
        </div>
        <span><?php echo $username_err; ?></span>
      </div>
      <div class="row">
        <div class="input-field col s12">
        <input id="password" type="password" class="validate" name="password">
          <label for="password">Password</label>
        </div>
        <span><?php echo $password_err; ?></span>
      </div>
      <div class="row">
        <div class="input-field col s12">
        <input id="confirm_password" type="password" class="validate" name="confirm_password">
          <label for="password">Password</label>
        </div>
        <span><?php echo $confirm_password_err; ?></span>
      </div>
      <div class="row">
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light" type="submit" name="action">Register<i class="material-icons right">send</i></button>
        </div>
        <span></span>
      </div>
      <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
  </div>
</div>

<?php  include 'includes/footer.php'; ?>