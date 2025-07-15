<?php
require 'pdo.php';
session_start();

if (!isset($_SESSION['users_id']) || !isset($_GET['id'])) { /*c'est les 2 barres*/
    header('Location: connection.php');
    exit;
}

$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND users = ?");
$stmt->execute([$_GET['id'], $_SESSION['users_id']]);

header('Location: tasklist.php');
exit;
