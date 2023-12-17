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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $sessionId = $_GET["id"];

    // Fetch the details of the specific equipment item
    $selectQuery = "SELECT * FROM studiosession WHERE id = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("i", $sessionId); // Fix the typo here
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $sessionDescription = $row['description'];
        $sessionPrice = $row['price'];
        
        // Display the edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Session</title>
        </head>

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
        <body>
            <h2>Edit Equipment</h2>
            <form action="update2.php" method="post">
                <input type="hidden" name="id" value="<?php echo $sessionId; ?>">
                
                <label for="equipmentDescription">Session Description:</label>
                <input type="text" name="sessionDescription" value="<?php echo $sessionDescription; ?>" required><br><br>

                <label for="sessionPrice">Session Price:</label>
                <input type="currency" name="sessionPrice" value="<?php echo $sessionPrice; ?>" required><br><br>

                <input type="submit" id="button" value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Session not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
