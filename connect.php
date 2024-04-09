<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        die('Passwords do not match');
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'test1');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    } else {
        // Prepare and execute SQL statement
        $stmt = $conn->prepare("INSERT INTO test1 (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            echo "Registration Successful";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>