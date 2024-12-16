<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);

    $check = $conn->prepare("SELECT * FROM examinee_tbl WHERE exmne_email = ?");
    $check->execute([$email]);

    if ($check->rowCount() > 0) {
        echo "Email already exists!";
    } else {
        $insert = $conn->prepare("INSERT INTO examinee_tbl (exmne_fullname, exmne_email) VALUES (?, ?)");
        $insert->execute([$fullname, $email]);
        echo "Examinee added successfully!";
    }
}
?>
