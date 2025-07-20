<?php
session_start();
require 'pdo.php';

if (!isset($_SESSION['users_id'])) {
    header('Location: connection.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE users_id = ?");
$stmt->execute([$_SESSION['users_id']]);
$tasks = $stmt->fetchAll();

if (count($tasks) === 0) {
    $stmt = $pdo->prepare("INSERT INTO tasks (users_id, task_name, task_details, is_done) VALUES (?, ?, ?, false)");
    $stmt->execute([$_SESSION['users_id'], "Welcome Queen !", "Ajoute ta première tâche ma belle !"]);
    
    header("Location: tasklist.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task_name']) && !empty($_POST['task_details'])) {
    $stmt = $pdo->prepare("INSERT INTO tasks (users_id, task_name, task_details, is_done) VALUES (?, ?, ?, false)");
    $stmt->execute([$_SESSION['users_id'], $_POST['task_name'], $_POST['task_details']]);

    $stmt = $pdo->prepare("DELETE FROM tasks WHERE users_id = ? AND task_name = 'Welcome Queen !'");
    $stmt->execute([$_SESSION['users_id']]);

    header("Location: tasklist.php");
    exit;
}

if (isset($_GET['done'])) {
    $stmt = $pdo->prepare("UPDATE tasks SET is_done = true WHERE id = ? AND users_id = ?");
    $stmt->execute([$_GET['done'], $_SESSION['users_id']]);
    header("Location: tasklist.php");
    exit;
}

if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND users_id = ?");
    $stmt->execute([$_GET['delete'], $_SESSION['users_id']]);
    header("Location: tasklist.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE users_id = ?");
$stmt->execute([$_SESSION['users_id']]);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma TaskList</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page">
    <header>
        <h1>Ma TaskList de Queen</h1>
        <a href="deco.php" class="deco-btn">Se déconnecter</a>
    </header>

    <section class="tasks">
        <?php foreach ($tasks as $task): ?>
            <div class="task-card <?= $task['is_done'] ? 'done' : '' ?>">
                <h2><?= htmlspecialchars($task['task_name']) ?></h2>
                <p><?= htmlspecialchars($task['task_details']) ?></p>
                <div class="task-actions">
                    <?php if (!$task['is_done']): ?>
                        <a href="?done=<?= $task['id'] ?>" class="btn-done">Fait</a>
                    <?php endif; ?>
                    <a href="?delete=<?= $task['id'] ?>" class="btn-delete">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <section class="add-task">
        <h3>Ajoute une nouvelle tâche</h3>
        <form method="POST">
            <input type="text" name="task_name" placeholder="Nom de la tâche" required>
            <textarea name="task_details" placeholder="Détails..." required></textarea>
            <button type="submit">Ajouter</button>
        </form>
    </section>
</div>
</body>
</html>


