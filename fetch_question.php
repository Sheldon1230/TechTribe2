<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "DanishLam";
$password = "Dsl140904";
$database = "quiz_db";

try {
    // Connect to the database
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Fetch questions from the database
    $stmt = $pdo->query("SELECT id, question, option_a, option_b, option_c, option_d FROM quiz_questions");
    $questions = $stmt->fetchAll();

    echo json_encode($questions);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch questions: ' . $e->getMessage()]);
}
