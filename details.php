<?php
session_start();
if (!isset($_SESSION['user_id'], $_GET['id'])){
    header('Mocation:login.php');
    exit;
}
require pdo.php;
$stmt=$pdo->prepare ("SELECT*FROM tasks WHERE id=? AND user_id=?");
$stmt->execute([$_GET ['id']], $_SESSION['user_id']);
$task=$stmt->fetch();
if (!$task){
    echo "J'l'ai pas trouvé ma belle!";
    exit;
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<h2><?=htmlspecialchars($task['task_name'])?></h2>
<P><?=nl2br(htmlspecialchars($task['details']))?></p>
<p>status:<?=$task['is_done']?'Terminéé':'En cours'?></p>
<a href="tasklist.php">Retour</a>
