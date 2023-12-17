<style>
    .add_equipment{
        background: linear-gradient(to bottom, #fcb045, #fd1d1d, #833ab4);
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
    h1{
        text-align: center;
    }

</style>
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
    </style>
</head>
<body>
<div class="top-bar">
        <h1>Isaac Studio Admin</h1>
    </div>
    <div class="container">
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

    



    <div class="add_equipment">
        <form action="addequipments.php" method="post">
            <h1>ADD SOUND EQUIPMENT</h1><br>
            <label for="name"><b>Equipment Name:</b></label><br>
            <input type="text" name="name" id="name"><br><br>
            <label for="description"><b>Equipment Description:</b></label><br>
            <textarea type="text" name="description" id="description"placeholder="List & Describe your sound equipment(s) ,state available time,duration and their characteristics in general"></textarea><br><br>
            <label for="price"><b>Equipment Price:</b></label><br>
            <input type="currency" name="price" id="price"><br><br>
            <input type="submit" value="ADD" id="button">

        </form>
    </div>
</body>
</html>


<?php 
     $host = "localhost";
     $username = "root";
     $password = "";
     $database = "sound_booking";
     
     $conn = new mysqli($host, $username, $password, $database);
     
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
     $name = isset($_POST['name']) ? $_POST['name'] : '';
     $description=isset($_POST["description"]) ? $_POST['description']:'';
     $price=isset($_POST["price"]) ? $_POST['price']:'';

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "INSERT INTO equipments ( name, description, price) VALUES ('$name','$description', '$price')";
        if ($conn->query($sql) === TRUE) {
            $successful_insert= "Data inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
     }




?>