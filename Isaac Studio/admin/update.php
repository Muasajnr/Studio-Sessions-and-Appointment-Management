<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "sound_booking";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $bookingId = $_POST['id'];
    $bookingType = $_POST['bookingType'];
    $withEngineer = $_POST['withEngineer'];
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $approvalStatus = $_POST['approvalStatus'];

    // Update the record in the database
    $updateQuery = "UPDATE bookings SET 
                    booking_type = ?, 
                    with_engineer = ?, 
                    user_name = ?, 
                    email = ?, 
                    phone = ?, 
                    message = ?, 
                    approval_status = ? 
                    WHERE id = ?";

    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssssssi", $bookingType, $withEngineer, $userName, $email, $phone, $message, $approvalStatus, $bookingId);
    
    if ($stmt->execute()) {
        header("Location: bookings.php");
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request. Please submit the form.";
}

$conn->close();
?>
