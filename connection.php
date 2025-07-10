<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<form method="POST">
  <input type="text" name="username" required placeholder="Nom d'utilisateur">
  <input type="paasword" name="mdp" required placeholder="Mot de passe">
  <button type="submit">Connexion</button>
</form><?php
require 'pdo.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt=$pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['mdp'], $user['mdp'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: task-list.php');
        exit;
    } else {
        echo "Erreur identifiants ma belle!";
    }
}
?>
</body>
</html>