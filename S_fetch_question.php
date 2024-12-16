<?php
session_start();

$servername = "localhost";
$username = "DanishLam";
$password = "Dsl140904";
$database = "webtribe_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Fetch tutorial questions
    $stmt = $pdo->query("SELECT id, question, option_a, option_b, option_c, option_d FROM quiz_questions WHERE question = 1");
    $questions = $stmt->fetchAll();

    if ($questions) {
        echo json_encode($questions);
    } else {
        echo json_encode(['error' => 'No tutorial questions available.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>

