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

// Check if the 'id' parameter is set in the POST request
if (isset($_POST['id'])) {
    $itemId = $_POST['id'];

    // Use prepared statement to prevent SQL injection
    $deleteQuery = "DELETE FROM bookings WHERE id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($deleteQuery);

    // Bind the parameter
    $stmt->bind_param("i", $itemId);

    // Execute the statement
    $result = $stmt->execute();
    if ($result) {
        echo "success";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request. No 'id' parameter provided.";
}

// Close the connection
mysqli_close($conn);
?>
