<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $examTitle = trim($_POST['examTitle']);
    $timeLimit = $_POST['timeLimit'];

    $insert = $conn->prepare("INSERT INTO exam_tbl (ex_title, ex_time_limit) VALUES (?, ?)");
    $insert->execute([$examTitle, $timeLimit]);
    echo "Exam added successfully!";
}
?>
