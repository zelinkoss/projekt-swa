<?php
session_start();
require_once '../includes/db.php';

// Zpracování mazání uživatele (soft delete)
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $stmt = $pdo->prepare("UPDATE users SET deleted_at = NOW() WHERE id = ?");
    $stmt->execute([$user_id]);
    $_SESSION['message'] = "Uživatel byl označen jako smazaný.";
    header("Location: admin_dashboard.php");
    exit();
}

// Zpracování obnovení uživatele
if (isset($_GET['restore'])) {
    $user_id = $_GET['restore'];
    $stmt = $pdo->prepare("UPDATE users SET deleted_at = NULL WHERE id = ?");
    $stmt->execute([$user_id]);
    $_SESSION['message'] = "Uživatel byl obnoven.";
    header("Location: admin_dashboard.php");
    exit();
}

// Zpracování hard delete (trvalé odstranění uživatele)
if (isset($_GET['hard_delete'])) {
    $user_id = $_GET['hard_delete'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $_SESSION['message'] = "Uživatel byl trvale odstraněn.";
    header("Location: admin_dashboard.php");
    exit();
}

$stmt_active = $pdo->prepare("SELECT * FROM users WHERE deleted_at IS NULL");
$stmt_active->execute();
$active_users = $stmt_active->fetchAll();

// Načtení smazaných uživatelů
$stmt_deleted = $pdo->prepare("SELECT * FROM users WHERE deleted_at IS NOT NULL");
$stmt_deleted->execute();
$deleted_users = $stmt_deleted->fetchAll();

?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include '../includes/navbaradmin.php'; ?>

    <div class="container">
        <h1>Admin Dashboard</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-info"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <h3>Aktivní uživatelé</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($active_users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="admin_dashboard.php?delete=<?= $user['id'] ?>" class="btn btn-warning btn-sm">Smazat (soft)</a>
                        <a href="admin_dashboard.php?hard_delete=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Smazat (hard)</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Smazaní uživatelé</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deleted_users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <a href="admin_dashboard.php?restore=<?= $user['id'] ?>" class="btn btn-success btn-sm">Obnovit</a>
                        <a href="admin_dashboard.php?hard_delete=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Smazat (hard)</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
