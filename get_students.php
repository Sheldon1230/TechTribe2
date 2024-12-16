<?php
// Include database connection
include("classroom_db.php");

header("Content-Type: application/json");

$sql = "SELECT id, name FROM students";
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

echo json_encode($students);

$conn->close();
?>
