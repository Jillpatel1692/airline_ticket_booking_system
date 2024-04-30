<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emirate";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM flights";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Flights</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: white; 
        color: black; 
    }
    h2 {
        text-align: center; 
    }
      /* Sidebar */
      .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 50px;
        }

        .sidebar a {
            padding: 10px;
            text-decoration: none;
            font-size: 20px;
            color: #ffffff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

    table {
        border-collapse: collapse;
       
        color: white; 
         
    }
    th, td {
        border: 1px solid white; 
        padding: 8px;
        text-align: left;
        color: black;   
    }
   
    
</style>


</head>
<body>
    <h2>Flights Table</h2><br>
<!-- Sidebar -->
<div class="sidebar">
        <a href="admindashboard.php">Dashboard</a>
        <a href="book_flight.php">Create Flight </a>
        <a href="display_flight.php">Flight Schedule</a>
        <a href="adminbookflight.php">Flight history</a>
        <a href="#">Settings</a>
        <a class="nav-link" href="adminlogout.php">Logout</a>
    </div>
    <table class="table table-striped" style="margin-left: 17%;width:80%;">
        <thead>
            <tr>
                <th>Flight No</th>
                <th>From City</th>
                <th>To City</th>
                <th>Departure Date</th>
                <th>Arrival Date</th>
                <th>Seat Type</th>
                <th>Seats Quantity</th>
                <th>Price </th>
                <th>edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["flight_no"] . "</td>";
                    echo "<td>" . $row["from_city"] . "</td>";
                    echo "<td>" . $row["to_city"] . "</td>";
                    echo "<td>" . $row["departure_date"] . "</td>";
                    echo "<td>" . $row["arrival_date"] . "</td>";
                    echo "<td>" . $row["seat_type"] . "</td>";
                    echo "<td>" . $row["seats_quantity"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "<td><a href='edit_flight.php?id=" . $row["id"] . "' class='btn btn-primary'>Edit</a></td>";
                    echo "<td><a href='delete_flight.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>0 results</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
 
    $conn->close();
    ?>
</body>
</html>
