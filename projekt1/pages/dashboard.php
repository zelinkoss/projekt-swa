<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Získání seznamu her
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM games WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-4">
        <h2>Seznam dohraných her</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Název hry</th>
                    <th>Datum dokončení</th>
                    <th>Hodnocení</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $game): ?>
                    <tr>
                        <td><?= htmlspecialchars($game['game_name']) ?></td>
                        <td><?= htmlspecialchars($game['completion_date']) ?></td>
                        <td><?= htmlspecialchars($game['rating']) ?></td>
                        <td>
                            <a href="edit_game.php?id=<?= $game['id'] ?>" class="btn btn-warning btn-sm">Upravit</a>
                            <a href="delete_game.php?id=<?= $game['id'] ?>" class="btn btn-danger btn-sm">Smazat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="add_game.php" class="btn btn-success">Přidat novou hru</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
