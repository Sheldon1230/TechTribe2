<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "DanishLam";
$password = "Dsl140904";
$database = "webtribe_db";

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    if (isset($_SESSION['user_id'])) {
        // Get the latest score
        $stmt = $pdo->prepare("SELECT score, quiz_date FROM quiz_results WHERE user_id = :user_id ORDER BY quiz_date DESC LIMIT 1");
        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $latest_score = $stmt->fetch();

        // Get previous scores
        $stmt = $pdo->prepare("SELECT score, quiz_date FROM quiz_results WHERE user_id = :user_id ORDER BY quiz_date DESC LIMIT 5 OFFSET 1");
        $stmt->execute(['user_id' => $_SESSION['user_id']]);
        $previous_scores = $stmt->fetchAll();

        if ($latest_score) {
            // Return the latest score and previous scores
            echo json_encode([
                'latest_score' => [
                    'score' => $latest_score['score'],
                    'quiz_date' => $latest_score['quiz_date']
                ],
                'previous_scores' => $previous_scores
            ]);
        } else {
            echo json_encode(['error' => 'No quiz results found for this user.']);
        }
    } else {
        echo json_encode(['error' => 'User not logged in']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Failed to fetch results: ' . $e->getMessage()]);
}
?>
