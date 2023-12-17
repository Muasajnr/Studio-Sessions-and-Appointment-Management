<style>
    body{
        background-color: rgb(213, 249, 247);
        width: 50%;
        margin-inline:auto ;
        margin-top: 10px;
        padding: 2% 0% 2%;

    }
    form{
        width: 80%;
        margin-inline:auto ;
        font-family: arial; 

    }
    
    input{
        width: 100%;
        height: 40px;
    }
    textarea{
        width: 100%;
        height: 80px;
    }
    #button{
        width: 30%;
        margin-left:40%;
        background-color: #fd1d1d;
        border:none;
        color:#fff;
    }
    h2{
        text-align: center;
    }

</style>

<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "sound_booking";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $bookingId = $_GET['id'];

    // Fetch the record based on the provided ID
    $selectQuery = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Display the form for editing
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Booking</title>
        </head>

        <body>
            <h2>Edit Booking</h2>
            <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="bookingType"><b>Booking Type:</b></label>
                <input type="text" name="bookingType" value="<?php echo $row['booking_type']; ?>" required><br><br>

                <label for="withEngineer"><b>With Engineer:</b></label>
                <input type="text" name="withEngineer" value="<?php echo $row['with_engineer']; ?>" required><br><br>

                <label for="userName"><b>Username:</b></label>
                <input type="text" name="userName" value="<?php echo $row['user_name']; ?>" required><br><br>

                <label for="email"><b>Email:</b></label>
                <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br><br>

                <label for="phone"><b>Phone No.:</b></label>
                <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required><br><br>

                <label for="message"><b>Message:</b></label>
                <textarea name="message"><?php echo $row['message']; ?></textarea><br><br>

                <label for="approvalStatus"><b>Booking Status:</b></label>
                <input type="text" name="approvalStatus" value="<?php echo $row['approval_status']; ?>" required><br><br>

                <input type="submit" id="button"value="Update">
            </form>
        </body>

        </html>
<?php
    } else {
        echo "Record not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request. No 'id' parameter provided.";
}

$conn->close();
?>
