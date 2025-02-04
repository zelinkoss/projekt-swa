<?php
session_start();
require '../includes/db.php';

// Zkontrolovat přihlášení uživatele
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Získání ID hry z URL
if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$game_id = $_GET['id'];

// Smazání hry
$stmt = $pdo->prepare("DELETE FROM games WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $game_id, 'user_id' => $_SESSION['user_id']]);

header('Location: dashboard.php?success=game_deleted');
exit;
