<?php
session_start();
if (!isset ($ession['user_id'])){
    header('Location: login.php');
    exit;
}
require 'pdo.php';
$stmt=$pdo->prepare ("SELECT*FROM task WHERE user_id=?");
$stmt->execute ([$_SESSION['user_id']]);
$tasks=$stmt->fetchAll();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Tasks</h2>
    <ul>
    <?php foreach($tasks as $task);?>
    <li>
        <a href="get-task.php?id=<?=$task['id']?>">
            <?=htmlspecialchars($task['title'])?>
        </a>
        <?=$task['is_done']?>
    </li>
    <?php endforeach;?>
    </ul>
    <form action="add-task.php" method="POST">
    <input type="text" name="nom_task" required placeholder="Titre">
    <textarea name="details" placeholder="details (optionnel)"></textarea>
    <button type="submit">Add</button>
    </form>
    <a href="logout.php">Déconnexion</a>
</body>
</html>

