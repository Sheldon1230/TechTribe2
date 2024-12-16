<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name = strtoupper(trim($_POST['course_name']));

    // Check for duplicates
    $check = $conn->prepare("SELECT * FROM course_tbl WHERE cou_name = ?");
    $check->execute([$course_name]);

    if ($check->rowCount() > 0) {
        echo "Course already exists!";
    } else {
        $insert = $conn->prepare("INSERT INTO course_tbl (cou_name) VALUES (?)");
        $insert->execute([$course_name]);
        echo "Course added successfully!";
    }
}
?>
