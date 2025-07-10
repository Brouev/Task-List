<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=$tasklist");
} catch(PDOException $e)
$sql="CREATE TABLE IF NOT EXIST";
 $stmt = $conn->prepare("INSERT INTO user_id(username, mdp)
  VALUES (:username, :mdp)");
  $stmt->bindParam(':username', $username);
  $stmt->bindParam(':mdp', $mdp);
 $stmt = $conn->prepare("INSERT INTO tasklist(user_id, task_name, task_details, is_done)
  VALUES (:user_id, :task_name, :task_details, :is_done)");
  $stmt->bindParam(':user_id', $ser_id);
  $stmt->bindParam(':task_name', $task_name);
  $stmt->bindParam('task_details', $task_details);
  $stmt->bindParam(':is_done', $is_done);