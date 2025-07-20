<?php
require 'pdo.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['mdp'], $user['mdp'])) {
        $_SESSION['users_id'] = $user['id'];
        header('Location: tasklist.php');
        exit;
    } else {
        $error = "Identifiants incorrects ma belle !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page">
    <h1>Connexion</h1>
    <form method="POST">
        <input type="text" name="username" required placeholder="Nom d'utilisateur">
        <input type="password" name="mdp" required placeholder="Mot de passe">
        <button type="submit">Connexion</button>
    </form>
    <p><a href="inscription.php">Pas encore inscrite ?</a></p>
</div>
</body>
</html>
