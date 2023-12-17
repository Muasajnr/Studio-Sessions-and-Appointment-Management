<style>
    .equipment-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        grid-gap: 20px;
        position: relative;
        padding:10px;
        box-shadow: 0 4px 8px rgba(4, 4, 4, 0.4); 
    }

    .equipment {
        text-align: center;
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        word-wrap: break-word;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(4, 4, 4, 0.4); 
        background-color: #fff; 
        align-items:center;
    }

    .equipment:hover {
        box-shadow: 0 4px 8px rgba(4, 4, 4, 0.4); 
        background-color: #fff; 
        border-radius:20px;
        border: 1px solid #fd1d1d;
        transform: scale(1.1);
    }

    h3,p{
        line-height: 20px;
        text-align: center;
    }
    
    button {
        margin-inline: auto;
        bottom: 4px;
        cursor: pointer;
    }
    button:hover{
        background-color: #fd1d1d;
        color: #fff;
        border-color: #fd1d1d;
    }
</style>



<?php
include 'db_connection.php';

$sql = "SELECT * FROM equipments";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='equipment-container'>";
    while ($row = $result->fetch_assoc()) {
        echo "<div class='equipment'>
                <h3>{$row['name']}</h3>
                <p1>{$row['description']}</p1>
                <p>Price: $ {$row['price']}</p>
                <button onclick='redirectToBooking({$row['id']})'>Book Now</button>
              </div>";
    }
    echo "</div>";
} else {
    echo "No equipments available.";
}

$conn->close();
?>
<script>
    function redirectToBooking(equipmentId) {
        // Assuming equipment_booking.php is in the same directory
        window.location.href = 'equipment_booking.php?equipment_id=' + equipmentId;
    }
</script>
