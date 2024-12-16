<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username = "DanishLam";
$password = "Dsl140904";
$database = "quiz_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("SELECT score, quiz_date FROM quiz_results WHERE user_id = :user_id ORDER BY quiz_date DESC");
        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $results = $stmt->fetchAll();

        echo json_encode($results);
    } else {
        echo json_encode(['error' => 'User not logged in']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch results: ' . $e->getMessage()]);
}
?>
