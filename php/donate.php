<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imani_ministries";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $donation = $_POST["amount"];


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO donations (full_name, email,donation ) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $donation);

    if ($stmt->execute()) {
        header("Location:../index.html"); // Redirect after success
        exit();
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
