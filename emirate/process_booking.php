<?php
// process_booking.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "emirate";

// Start the session
session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$flight_id = $_POST['flight_id'];
$passenger_name = $_POST['passenger_name'];
$passenger_email = $_POST['passenger_email'];
$seat_quantity = $_POST['seat_quantity'];
$price_per_seat = $_POST['price_per_seat'];
$total_price = $seat_quantity * $price_per_seat; // Calculate total price

// Retrieve user ID from session
$user_id = $_SESSION['user_id'];

// Prepare and execute SQL statement to insert into booked_tickets table
$sql = "INSERT INTO booked_tickets (user_id, flight_id, passenger_name, passenger_email, seat_quantity, price_per_seat, total_price) 
        VALUES ('$user_id', '$flight_id', '$passenger_name', '$passenger_email', '$seat_quantity', '$price_per_seat', '$total_price')";

if ($conn->query($sql) === TRUE) {
    echo "Booking successful!";
    header('location: booked_flight.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
