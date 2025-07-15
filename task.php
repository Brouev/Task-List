<?php
require 'pdo.php';
session_start();

if (!isset($_SESSION['users_id']) || !isset($_GET['id'])) {
    header('Location: connection.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ? AND users = ?");
$stmt->execute([$_GET['id'], $_SESSION['users_id']]);
$task = $stmt->fetch();

if (!$task) {
    echo "Tâche non trouvée.";
    exit;
}
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<h2><?= htmlspecialchars($task['task_name']) ?></h2>
<p><?= nl2br(htmlspecialchars($task['task_details'])) ?></p>
<p>Status : <?= $task['is_done'] ? 'Terminée' : 'En cours' ?></p>
<a href="tasklist.php">Retour à la liste</a>

