<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username = "DanishLam";
$password = "Dsl140904";
$database = "webtribe_db";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Fetch correct answers
    $stmt = $pdo->query("SELECT id, correct_option FROM quiz_questions");
    $answers = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

    // Calculate score
    $score = 0;
    foreach ($_POST as $questionId => $answer) {
        $id = str_replace('question_', '', $questionId);
        if (isset($answers[$id]) && $answers[$id] === $answer) {
            $score++;
        }
    }

    // Save score to the database
    if (isset($_SESSION['user_id'])) {
        $stmt = $pdo->prepare("INSERT INTO quiz_results (user_id, score) VALUES (:user_id, :score)");
        $stmt->execute(['user_id' => $_SESSION['user_id'], 'score' => $score]);
    }

    echo json_encode([
        'message' => "You scored $score out of " . count($answers)
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to process quiz: ' . $e->getMessage()]);
}
