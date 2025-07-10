<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=tasklist;charsert=utf8");
  $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username NOT NULL UNIQUE,
            mdp NOT NULL
        )
    ");

  $pdo->exec("
        CREATE TABLE IF NOT EXISTS tasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            task_name NOT NULL,
            task_details TEXT,
            is_done BOOLEAN DEFAULT FALSE,
        )
    ");

  echo "Les tables ont bien été créées ma belle !";
} catch (PDOException $e)
?>
