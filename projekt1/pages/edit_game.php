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

// Získání údajů o hře z databáze
$stmt = $pdo->prepare("SELECT * FROM games WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $game_id, 'user_id' => $_SESSION['user_id']]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    header('Location: dashboard.php');
    exit;
}

// Uložení upravených dat do databáze
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_name = $_POST['game_name'];
    $completion_date = $_POST['completion_date'];
    $rating = $_POST['rating'];

    $stmt = $pdo->prepare("UPDATE games SET game_name = :game_name, completion_date = :completion_date, rating = :rating WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        'game_name' => $game_name,
        'completion_date' => $completion_date,
        'rating' => $rating,
        'id' => $game_id,
        'user_id' => $_SESSION['user_id']
    ]);

    header('Location: dashboard.php?success=game_updated');
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upravit hru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <div class="container mt-5">
        <h2>Upravit hru</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="game_name" class="form-label">Název hry</label>
                <input type="text" name="game_name" id="game_name" class="form-control" value="<?= htmlspecialchars($game['game_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="completion_date" class="form-label">Datum dokončení</label>
                <input type="date" name="completion_date" id="completion_date" class="form-control" value="<?= htmlspecialchars($game['completion_date']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="rating" class="form-label">Hodnocení (1-5)</label>
                <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" value="<?= htmlspecialchars($game['rating']) ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Uložit změny</button>
            <a href="dashboard.php" class="btn btn-secondary">Zpět</a>
        </form>
    </div>
</body>
</html>
