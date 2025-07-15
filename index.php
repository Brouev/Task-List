<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
    
</head>
<body>
    <div class="task-container">
        <h1>Sup Shawty !</h1>
        <p style="text-align: center;">Organise tes journées comme une queen<Br>(T'en as vraiment besoin mv)</p>
        <div style="text-align: center; margin-top: 20px;">
            <?php if (isset($_SESSION['users_id'])): ?>
                <a href="tasklist.php">Voir mes tâches</a> |
                <a href="addtask.php">Add</a> |
                <a href="deco.php">Déconnexion</a>
            <?php else: ?>
                <a href="connection.php">Connexion</a> |
                <a href="inscription.php">Inscription</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
