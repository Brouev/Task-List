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
    $defaultName = "Welcome Queen !";
    $defaultDetails = "Ajoute ta première tâche ma belle !";
    $stmt = $pdo->prepare("INSERT INTO tasks (users_id, task_name, task_details, is_done) VALUES (?, ?, ?, false)");
    $stmt->execute([$_SESSION['users_id'], $defaultName, $defaultDetails]);

    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE users_id = ?");
    $stmt->execute([$_SESSION['users_id']]);
    $tasks = $stmt->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task_name']) && !empty($_POST['task_details'])) {
    $stmt = $pdo->prepare("INSERT INTO tasks (users_id, task_name, task_details, is_done) VALUES (?, ?, ?, false)");
    $stmt->execute([$_SESSION['users_id'], $_POST['task_name'], $_POST['task_details']]);

    header("Location: tasklist.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ma TaskList</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Ma TaskList</h1>
            <a href="deco.php"><button type="deco.php">Se déconnecter</button></a>
        </header>

        <section class="tasks">
            <?php foreach ($tasks as $task): ?>
                <div class="task-card <?= $task['is_done'] ? 'done' : '' ?>">
                    <h2><?= htmlspecialchars($task['task_name']) ?></h2>
                    <p><?= htmlspecialchars($task['task_details']) ?></p>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="add-task">
            <h3>Add une nouvelle tâche</h3>
            <form method="POST">
                <input type="text" name="task_name" placeholder="Nom de la tâche" required>
                <textarea name="task_details" placeholder="Détails..." required></textarea>
                <button type="submit">Ajouter</button>
            </form>
        </section>
    </div>
</body>
</html>

