<?php
require 'pdo.php';
session_start();

if (!isset($_SESSION['users_id']) || !isset($_GET['id'])) {
    header('Location: connection.php');
    exit;
}

$stmt = $pdo->prepare("UPDATE tasks SET is_done = 1 WHERE id = ? AND users = ?");
$stmt->execute([$_GET['id'], $_SESSION['users_id']]);

header('Location: tasklist.php');
exit;
