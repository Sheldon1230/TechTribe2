<?php
session_start();
include('user_db.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: loginform.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$bio = $_POST['bio'];

$sql = "UPDATE users SET bio = '$bio' WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    header("Location: teacher.php");
} else {
    echo "Error updating record: " . $conn->error;
}
?>
