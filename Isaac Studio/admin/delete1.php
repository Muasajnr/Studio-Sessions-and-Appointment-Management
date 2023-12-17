<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "sound_booking";

// Create a MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the 'id' parameter is set in the URL
if (isset($_POST['id'])) {
    $equipmentId = $_POST['id'];

    // Use prepared statement to prevent SQL injection
    $deleteQuery = "DELETE FROM equipments WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($deleteQuery);

    if (!$stmt) {
        echo "Error preparing delete statement: " . $conn->error;
        exit;
    }

    // Bind the parameter
    $stmt->bind_param("i", $equipmentId);

    // Execute the statement
    $result = $stmt->execute();

    if ($result) {
        echo "success";
    } else {
        echo "Error executing delete statement: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request. No 'id' parameter provided.";
}

// Close the connection
$conn->close();
?>
