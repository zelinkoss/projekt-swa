<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_name = $_POST['game_name'];
    $completion_date = $_POST['completion_date'];
    $rating = $_POST['rating'];
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("INSERT INTO games (user_id, game_name, completion_date, rating) VALUES (:user_id, :game_name, :completion_date, :rating)");
        $stmt->execute([
            'user_id' => $user_id,
            'game_name' => $game_name,
            'completion_date' => $completion_date,
            'rating' => $rating
        ]);
        header('Location: dashboard.php?success=game_added');
        exit;
    } catch (PDOException $e) {
        $error = "Chyba při přidávání hry: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přidat hru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-5">
        <h2>Přidat novou hru</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="game_name" class="form-label">Název hry</label>
                <input type="text" name="game_name" id="game_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="completion_date" class="form-label">Datum dokončení</label>
                <input type="date" name="completion_date" id="completion_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Hodnocení (1-5)</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" required>
            </div>
            <button type="submit" class="btn btn-success">Přid
