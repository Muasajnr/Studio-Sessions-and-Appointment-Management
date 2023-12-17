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

// Fetch all items from the "equipments" table
$selectQuery = "SELECT * FROM equipments";
$result = $conn->query($selectQuery);

if ($result->num_rows > 0) {
    // Display the table header
    echo "<h1>All Equipments</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Equipment ID</th><th>Equipment Name</th><th>Equipment Description</th><th>Price</th></tr>";

    // Display each item in a row
    while ($row = $result->fetch_assoc()) {
        
        echo "<tr>";
        
        // Check if the key "equipment_id" exists in the $row array
        $equipmentId = isset($row['id']) ? $row['id'] : '';
        
        echo "<td>" . $equipmentId . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td><a href='edit1.php?id=" . $equipmentId . "'>Edit</a> | ";
        echo "<button class='deleteBtn' data-id='" . $equipmentId . "'>Delete Record</button></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No items found in the equipments table.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Confirmation</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<script>
    $(document).ready(function () {
        $(".deleteBtn").on("click", function () {
            var equipmentId = $(this).data("id");
            var btn = $(this); // Store a reference to 'this'

            // Display confirmation dialog
            var confirmDelete = confirm("Are you sure you want to delete this record?");

            if (confirmDelete) {
                // AJAX request to delete1.php
                $.ajax({
                    type: "POST",
                    url: "delete1.php",
                    data: { id: equipmentId },
                    success: function (response) {
                        // Remove the row from the table on success
                        if (response === "success") {
                            alert("Record deleted successfully.");
                            // Use the reference to 'this' stored earlier
                            btn.closest("tr").remove();
                        } else {
                            alert("Error deleting record: " + response);
                        }
                    }
                });
            }
        });
    });
</script>


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
            width: 90%;
        }
        th,td{
            padding: 10px;
            
        }
        h1{
            margin-inline: auto;
            text-align: center;
        }
        .deleteBtn{
            background-color: red;
            border: none;
            color: #fff;
        }

</style>        
</body>
</html>
