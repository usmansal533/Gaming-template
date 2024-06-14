<?php
// Database credentials
$servername = "localhost"; // Assuming the database is hosted on the same server
$username = "root";
$password = ""; // Empty password
$dbname = "lugx"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstName = $_POST['name'];
    $lastName = $_POST['surname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO user_data (firstName, lastName, email, subject, message) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssss", $firstName, $lastName, $email, $subject, $message);

    // Execute statement
    if ($stmt->execute()) {
        echo "Message saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    // If it's not a POST request, redirect to the form page or display an error
    echo "Error: Invalid request method!";
}

// Close connection
$conn->close();
?>
