<?php
session_start();

// Kontrola, zda je uživatel přihlášen jako admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

require '../includes/db.php';

// Získání ID uživatele z URL
if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']); // Zajistíme, že je to číslo
    
    // Zabránění smazání vlastního účtu
    if ($user_id == $_SESSION['user_id']) {
        header('Location: manage_users.php?error=nelf'); // Není možné smazat vlastní účet
        exit;
    }
    
    // Smazání uživatele z databáze
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header('Location: manage_users.php?success=deleted');
    } else {
        header('Location: manage_users.php?error=failed');
    }

    $stmt->close();
} else {
    header('Location: manage_users.php?error=invalid');
}

$conn->close();
?>
