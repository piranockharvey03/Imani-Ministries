<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imani_ministries";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $location = $_POST["location"];
    $message = $_POST["message"];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO messages (full_name, number, email, location, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $number, $email, $location, $message);

    if ($stmt->execute()) {
        header("Location:../index.html"); // Redirect after success
        exit();
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
