<?php
$host = 'localhost';
$dbname = 'zelinkam_hry';
$username = 'zelinkam'; // Změň podle nastavení
$password = 'marek123';     // Změň podle nastavení

$conn = new mysqli($host, $username, $password, $dbname);

// Kontrola připojení
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Chyba při připojení k databázi: " . $e->getMessage());
}
?>

