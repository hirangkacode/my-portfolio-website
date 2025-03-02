<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


error_reporting(E_ALL);
ini_set('display_errors', 1);


$servername = "localhost";
$username = "root"; // Change this if using a different MySQL username
$password = ""; // Add password if set
$dbname = "contact_db";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "Success";
        } else {
            echo "Database Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error: All fields are required.";
    }
}

$conn->close();
?>
