<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<?php
if (isset($_SESSION['user_id'])){
    echo '<a href="tasklist.php">Voir mes Tâches</a>';
    echo '<a href="logout.php"Se déconnecter></a>';
}else{ 
    echo '<a href="connection.php">Se connecter</a>';
    echo '<a href="inscription.php">S\'inscrire</a>';

}
?>
</body>
