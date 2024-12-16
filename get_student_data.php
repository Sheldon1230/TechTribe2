<?php
include("classroom_db.php");

header("Content-Type: application/json");

if (isset($_GET['student_id']) && is_numeric($_GET['student_id'])) {
    $student_id = intval($_GET['student_id']);

    // Query updated to fetch all necessary data
    $stmt = $conn->prepare("
        SELECT 
            time_spent, 
            questions_answered, 
            lessons_completed, 
            challenges_solved 
        FROM students 
        WHERE id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode($result->fetch_assoc());
    } else {
        echo json_encode(["error" => "No data found for the selected student"]);
    }
    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid student ID"]);
}

$conn->close();
?>
