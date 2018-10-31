<?php
    $name = $_;
    $surname = 'Agabalayev';
    $username = 'afarid';
    $sql = 'INSERT INTO users(name, surname, username) VALUES(:name, :surname, :username)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'surname' => $surname, 'username' => $username]);
    echo 'user added';


?>