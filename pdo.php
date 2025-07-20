<?php
$host = '127.0.0.1';
$dbname = 'tasklist';
$user = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>

