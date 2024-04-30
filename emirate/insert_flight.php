<?php
// insert_flight.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $flight_no = $_POST['flight_no'];
    $from_city = $_POST['from_city'];
    $to_city = $_POST['to_city'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $seat_type = $_POST['seat_type'];
    $seats_quantity = $_POST['seats_quantity'];
    $price = $_POST['price'];

    // Connect to your database (you need to fill in your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emirate";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO flights (flight_no, from_city, to_city, departure_date, arrival_date, seat_type, seats_quantity, price)
    VALUES ('$flight_no', '$from_city', '$to_city', '$departure_date', '$arrival_date',  '$seat_type', '$seats_quantity', '$price')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: admindashboard.php");
    exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
