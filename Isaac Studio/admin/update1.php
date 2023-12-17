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
    $equipmentId = $_POST["id"];
    $equipmentName = $_POST["equipmentName"];
    $equipmentDescription = $_POST["equipmentDescription"];
    $equipmentPrice = $_POST["equipmentPrice"];

    // Update the equipment details
    $updateQuery = "UPDATE equipments SET 
                    name = ?, 
                    description = ? ,
                    price = ?
                    WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssdi", $equipmentName, $equipmentDescription, $equipmentPrice, $equipmentId);
    
    if ($stmt->execute()) {
        header("Location: viewequipments.php");
        exit;
    } else {
        echo "Error updating equipment: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
