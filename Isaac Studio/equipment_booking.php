<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipment Booking </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="Index.php">Isaac Studio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="Index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-5">Booking Details</h1>
        
        <?php if (!empty($successMessage)): ?>
    <div class="success-message">
        <?php echo $successMessage; ?>
    </div>
<?php endif; ?>

<style>
    .success-message {
        color: green;
        margin-top: 10px;
    }
</style>
        
        <form action="equipment_booking.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Booking Type</label>
                <select class="form-control" id="exampleFormControlSelect1" name="booking_type">
                    <option value="Music Equipment Booking">Music Equipment Booking</option>
                    
                </select> 
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect2">With Sound Engineer</label>
                <select class="form-control" id="exampleFormControlSelect2" name="with_engineer">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Email</label>
                <input type="email" class="form-control" id="exampleFormControlInput2" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput3">Phone</label>
                <input type="text" class="form-control" id="exampleFormControlInput3" name="phone" placeholder="Phone">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Message</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
    include 'db_connection.php';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $bookingType = $_POST['booking_type'];
        $withEngineer = $_POST['with_engineer'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
    
        // Insert data into 'bookings' table
        $sql = "INSERT INTO bookings (booking_type, with_engineer, user_name, email, phone, message)
        VALUES ('$bookingType', '$withEngineer', '$name', '$email', '$phone', '$message')";

    
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Booking submitted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>