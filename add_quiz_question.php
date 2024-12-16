<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $question = trim($_POST['question']);
    $option_a = trim($_POST['option_a']);
    $option_b = trim($_POST['option_b']);
    $option_c = trim($_POST['option_c']);
    $option_d = trim($_POST['option_d']);
    $correct_answer = strtoupper(trim($_POST['correct_answer']));

    $stmt = $conn->prepare("INSERT INTO quiz_question (exam_id, question, option_a, option_b, option_c, option_d, correct_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $exam_id, $question, $option_a, $option_b, $option_c, $option_d, $correct_answer);

    if ($stmt->execute()) {
        echo "Question added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

?>
