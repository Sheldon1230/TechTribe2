<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "DanishLam";
    $password = "Dsl140904";
    $database = "webtribe_db";

    try {
        // Establish PDO connection
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        // Get form data
        $full_name = trim($_POST['full_name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        // Insert into the Feedback table
        $stmt = $pdo->prepare("INSERT INTO Feedback (full_name, email, message) VALUES (:full_name, :email, :message)");
        $stmt->execute([
            ':full_name' => $full_name,
            ':email' => $email,
            ':message' => $message,
        ]);

        header("Location: thank_you.html");
        exit();        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
