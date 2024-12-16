<?php
include("conn.php");

// Enable error reporting (only in development)
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $question = htmlspecialchars(trim($_POST['question']));
    $option_a = htmlspecialchars(trim($_POST['option_a']));
    $option_b = htmlspecialchars(trim($_POST['option_b']));
    $option_c = htmlspecialchars(trim($_POST['option_c']));
    $option_d = htmlspecialchars(trim($_POST['option_d']));
    $correct_answer = strtoupper(trim($_POST['correct_answer']));

    // Validate required fields
    if (empty($exam_id) || empty($question) || empty($correct_answer)) {
        die("Please fill in all required fields.");
    }

    // Insert into database
    $stmt = $conn->prepare("INSERT INTO quiz_questions (exam_id, question, option_a, option_b, option_c, option_d, correct_answer) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("issssss", $exam_id, $question, $option_a, $option_b, $option_c, $option_d, $correct_answer);

    if ($stmt->execute()) {
        echo "Question added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
