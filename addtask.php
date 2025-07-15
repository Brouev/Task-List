<?php
require 'pdo.php';
session_start();

if (!isset($_SESSION['users_id'])) {
    header('Location: connection.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['task_name'])) {
        $stmt = $pdo->prepare("INSERT INTO tasks (users, task_name, task_details) VALUES (?, ?, ?)");
        $stmt->execute([
            $_SESSION['users_id'],
            $_POST['task_name'],
            $_POST['task_details'] ?? ''
        ]);
        header('Location: tasklist.php');
        exit;
    }
}
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>
<h2>Ajouter une tâche</h2>
<form method="POST">
    <input type="text" name="task_name" required placeholder="Nom de la tâche">
    <textarea name="task_details" placeholder="Détails (optionnel)"></textarea>
    <button type="submit">Ajouter</button>
</form>
