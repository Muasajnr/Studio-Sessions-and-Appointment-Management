<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle booking form submission here
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Isaac Studio</title>
</head>
<body>

    <header style="background: linear-gradient(to right, #fcb045, #fd1d1d, #833ab4);">
        <h1>Isaac Studio</h1>
        <nav>
        <ul style="background-color:#833ab4;width:30%;margin-inline:auto;padding:20px; display:flex;">
                <li><a href="Index.php"  style="text-decoration: none; color: #fff;border-right:solid #fd1d1d;padding-right:20px;">Book Sound Equipments</a></li>
                <li><a href="book_session.php"  style="text-decoration: none; color: #000;">Book Studio Sessions</a></li>
            </ul>
        </nav>
    </header>
<section id="sessions" style="background-color: rgb(213, 249, 247);height:100vh;">
        <h2>Studio Sessions</h2>
        <?php include 'show_studiosession.php'; ?>
    </section>
