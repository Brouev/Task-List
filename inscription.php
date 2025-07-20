<?php
require 'pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['mdp'])) {
        $username = $_POST['username'];
        $hash = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT IGNORE INTO users (username, mdp) VALUES (?, ?)");
        $stmt->execute([$username, $hash]);
        header('Location: connection.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="page">
    <h1>Inscription</h1>
    <form method="POST">
        <input type="text" name="username" required placeholder="Nom d'utilisateur">
        <input type="password" name="mdp" required placeholder="Mot de passe">
        <button type="submit">S'inscrire</button>
    </form>
    <p><a href="connection.php">Déjà inscrite ? Connecte-toi !</a></p>
</div>
</body>
</html>


