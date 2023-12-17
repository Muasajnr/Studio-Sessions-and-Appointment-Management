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
    $equipmentId = $_GET["id"];

    // Fetch the details of the specific equipment item
    $selectQuery = "SELECT * FROM equipments WHERE id = ?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("i", $equipmentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $equipmentName = $row['name'];
        $equipmentDescription = $row['description'];
        $equipmentPrice = $row['price'];
        
        // Display the edit form
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Equipment</title>
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
            <form action="update1.php" method="post">
                <input type="hidden" name="id" value="<?php echo $equipmentId; ?>">
                <label for="equipmentName">Equipment Name:</label>
                <input type="text" name="equipmentName" value="<?php echo $equipmentName; ?>" required><br><br>

                <label for="equipmentDescription">Equipment Description:</label>
                <input type="text" name="equipmentDescription" value="<?php echo $equipmentDescription; ?>" required><br><br>

                <label for="equipmentType">Equipment Price:</label>
                <input type="currency" name="equipmentPrice" value="<?php echo $equipmentPrice; ?>" required><br><br>

                <input type="submit" id="button"value="Update">
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "Equipment not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
