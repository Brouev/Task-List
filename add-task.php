<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header ('Location: login.php');
    exit;
}
require 'pdo.php';
if ($_SERVER['REQUEST_METHOD']==='POST'&&!empty($_POST['task_name'])){
    $stmt=$pdo->prepare ("INSERT INTO tasks (user_id, task_name, task_details)VALUES(?,?,?)");
    $stmt->execute([$_SESSION ['user_id'], $_POST ['task_name'], $_POST ['details']?? null]);
}
header('Location: tasklist.php');
exit;
