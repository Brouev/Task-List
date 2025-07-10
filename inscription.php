<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<form method="POST">
  <input type="text" name="username" required placeholder="Nom d'utilisateur">
  <input type="password" name="mdp" required placeholder="Mot de passe">
  <button type="submit">S'inscrire</button>
</form>
<?php
require 'pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['mdp'])) {
        $username = $_POST['username'];
        $hash = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

        $stmt=$pdo->prepare("INSERT INTO users (username, mdp) VALUES (?, ?)");
        $stmt->execute([$username, $hash]);

        header('Location: connection.php');
        exit;
    }
}
?>
</body>
</html>