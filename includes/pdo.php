<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'login';

    //set dsn

    $dsn = 'mysql:host='.$host. ';dbname='. $dbname;

    //create pdo instance

    $pdo = new PDO($dsn, $user, $password);

    // pdo query 
   /*  $stmt = $pdo->query('SELECT * FROM users'); */
    /* while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo $row['name'];
    } */
    // query with named param
   // $name = 'Orkhan';

// $sql = 'SELECT * FROM posts WHERE author = :author && is_published = :is_published';    $sql = 'SELECT * FROM users WHERE name = :name';
 /*    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name]);
    $users = $stmt->fetchAll();
    foreach ($users as $user) {
        echo $user['name'] . '<br>';
    } */

    //INSERT DATA
/*  $name = 'Farid';
    $surname = 'Agabalayev';
    $username = 'afarid';
    $sql = 'INSERT INTO users(name, surname, username) VALUES(:name, :surname, :username)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'surname' => $surname, 'username' => $username]);
    echo 'user added'; */

// UPDATE DATA
/* $id = 2;
$username = 'farid_a';

$sql = 'UPDATE users SET username = :username WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['username'=>$username, 'id' => $id]);
echo 'username updated'; */


// DELETE
/* $id = 2;
$sql = 'DELETE FROM users WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
echo 'user deleted';*/

  // SEARCH DATA
  // $search = "%or%";
  // $sql = 'SELECT * FROM users WHERE name LIKE ?';
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute([$search]);
  // $posts = $stmt->fetchAll();
?> 