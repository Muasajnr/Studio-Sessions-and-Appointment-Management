<?php 
 $hostname = "localhost";
 $username = "root";
 $password = "";
 $database = "sound_booking";



 $conc = new mysqli($hostname, $username, $password, $database);

 if ($conc->connect_error) {
     die('Connection failed: ' . $conc->connect_error);
 }

// Function to count items in a table
function countItems($table, $conc) {
    $query = "SELECT COUNT(*) as count FROM $table";
    $result = $conc->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        return $row['count'];
    } else {
        return 0;
    }
}

// Get counts for each table
$equipmentsCount = countItems('equipments', $conc);
$studiosessionCount = countItems('studiosession', $conc);
$bookingsCount = countItems('bookings', $conc);


$conc->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

        .card-body {
            text-align: center;
        }

        .nav-link {
            font-size: 1.2em;
        }

        .icon {
            font-size: 2em;
            margin-bottom: 10px;
        }
        table{
            margin-inline: auto;
        }
        th,td{
            padding: 15px;
            
        }
        h1{
            margin-inline: auto;
            text-align: center;
        }
        .top-bar {
            background: linear-gradient(to top, #fcb045, #fd1d1d, #833ab4);
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
}

.top-bar h1 {
    color: white;
    margin: 0;
}
.deleteBtn{
            background-color: red;
            border: none;
            color: #fff;
        }
        .editBtn{
            background-color: teal;
            border: none;
            color: #fff;
        }
    </style>
</head>
<body >
<div class="top-bar">
        <h1>Isaac Studio Admin</h1>
    </div>
    <div class="container" >
        <div class="row">
            <div class="col-3">
                <ul class="nav flex-column">
                <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="icon fas fa-home"></i>
                            
                            <span>Home</span>
                        </a>
                    </li>    
                <li class="nav-item">
                        <a class="nav-link" href="addstudiosession.php">
                            <i class="icon fas fa-microphone"></i>
                            
                            <span>Add Studio Sessions</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addequipments.php">
                            <i class="icon fas fa-tools"></i>
                            <span>Add Equipments</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bookings.php">
                            <i class="icon fas fa-bookmark"></i>
                            <span>Bookings</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-9">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon fas fa-microphone"></i>
                                <h2><?php echo $studiosessionCount ?></h2>
                                <a href="viewsession.php">Total Studio Sessions</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon fas fa-tools"></i>
                                <h2><?php echo $equipmentsCount ?></h2>
                                <a href="viewequipments.php">Total Equipments</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="icon fas fa-bookmark"></i>
                                <h2><?php echo $bookingsCount ?></h2>
                                <a href="bookings.php">Total Bookings</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>
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

function displayData($results){
    echo "<h1>All Bookings</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Booking ID</th><th>Booking Type</th><th>With Engineer</th><th>Username</th><th>Email</th><th>Phone No.</th><th>Message</th><th>Booking Status</th></tr>";

    while($row = mysqli_fetch_array($results)){
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['booking_type'] . "</td>";
        echo "<td>" . $row['with_engineer'] . "</td>";
        echo "<td>" . $row['user_name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['message'] . "</td>";
        echo "<td>" . $row['approval_status'] . "</td>";
       // Check if 'booking_id' key exists in the $row array
    $bookingId = isset($row['id']) ? $row['id'] : '';

    echo "<td> <button class='editBtn' data-id='" . $row['id'] . "'>Edit</button> | 
    <button class='deleteBtn' data-id='" . $row['id'] . "'>Delete</button></td>";


        echo "</tr>";
    }
    echo "</table>";
}

$sql = "SELECT * FROM bookings";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    displayData($result);
} else {
    echo "0 results";
}

// Close the connection
mysqli_close($conn);
?>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $(document).on("click", ".deleteBtn", function () {
            // Get the item ID from the data-id attribute
            var itemId = $(this).data("id");

            // Ask for confirmation
            var confirmDelete = confirm("Are you sure you want to delete this item?");

            if (confirmDelete) {
                // User clicked 'OK', proceed with deletion
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: { id: itemId },
                    success: function (response) {
                        // Remove the row from the table on success
                        if (response === "success") {
                            $("tr[data-id='" + itemId + "']").remove();
                            // Reload the page after deletion
                            location.reload();
                        } else {
                            alert("Error deleting record: " + response);
                        }
                    }
                });
            } else {
                // User clicked 'Cancel', do nothing
                console.log("Deletion canceled by user.");
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        // Handle click on Edit button
        $(document).on("click", ".editBtn", function () {
            // Get the item ID from the data-id attribute
            var itemId = $(this).data("id");

            // Redirect to the edit page with the item ID as a parameter
            window.location.href = "edit.php?id=" + itemId;
        });

        // Handle click on Delete button
        $(document).on("click", ".deleteBtn", function () {
            // Get the item ID from the data-id attribute
            var itemId = $(this).data("id");

            // Ask for confirmation
            var confirmDelete = confirm("Are you sure you want to delete this item?");

            if (confirmDelete) {
                // User clicked 'OK', proceed with deletion
                $.ajax({
                    type: "POST",
                    url: "delete.php",
                    data: { id: itemId },
                    success: function (response) {
                        // Remove the row from the table on success
                        if (response === "success") {
                            $("tr[data-id='" + itemId + "']").remove();
                            // Reload the page after deletion
                            location.reload();
                        } else {
                            alert("Error deleting record: " + response);
                        }
                    }
                });
            } else {
                // User clicked 'Cancel', do nothing
                console.log("Deletion canceled by user.");
            }
        });
    });
</script>
