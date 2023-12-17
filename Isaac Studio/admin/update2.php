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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $sessionId = $_POST["id"];
    $sessionDescription = $_POST["sessionDescription"];
    $sessionPrice = $_POST["sessionPrice"];

    // Update the equipment details
    $updateQuery = "UPDATE studiosession SET 
                    description = ? ,
                    price = ?
                    WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sdi", $sessionDescription, $sessionPrice, $sessionId);
    
    if ($stmt->execute()) {
        header("Location: viewsession.php");
        exit;
    } else {
        echo "Error updating session: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
