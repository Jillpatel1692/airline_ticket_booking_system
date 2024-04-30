<?php
// Start the session
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
// Check the user's role
if ($_SESSION['role'] == 0) {
    // If the user's role is 0 (assuming 0 represents a certain role, like admin),
    // then redirect to login page
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booked Flights</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Add your custom CSS styles here */
        /* ... */
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
    </style>
</head>
<body>
<!-- Navbar -->
<!-- Include your admin navigation bar here -->
 <!-- Sidebar -->
 <div class="sidebar">
        <a href="admindashboard.php">Dashboard</a>
        <a href="book_flight.php">Create Flight </a>
        <a href="display_flight.php">Flight Schedule</a>
        <a href="adminbookflight.php">Flight history</a>
        <a href="#">Settings</a>
        <a class="nav-link" href="adminlogout.php">Logout</a>
    </div>

<div class="container" style="margin-left:17%;">
<div>
        <h1 style="text-align: center;">Bar graph</h1>
        <canvas id="bookingChart"></canvas>
    </div>
    <h2 class="my-4" style="text-align: center;">Booked Flights</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>User ID</th>
                <th>Flight No</th>
                <th>From City</th>
                <th>To City</th>
                <th>Departure Date</th>
                <th>Arrival Date</th>
                <th>Passenger Name</th>
                <th>Passenger Email</th>
                <th>Seats Quantity</th>
                <th>Price Per Seat</th>
                <th>Total Price</th>
                <th>Booking Date</th>
            </tr>
            </thead>
            <tbody>
            <?php
            // Connect to the database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "emirate";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch booked flights from the database
            $sql = "SELECT bt.*, f.flight_no, f.from_city, f.to_city, f.departure_date, f.arrival_date 
                    FROM booked_tickets bt
                    INNER JOIN flights f ON bt.flight_id = f.id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['flight_no'] . "</td>";
                    echo "<td>" . $row['from_city'] . "</td>";
                    echo "<td>" . $row['to_city'] . "</td>";
                    echo "<td>" . $row['departure_date'] . "</td>";
                    echo "<td>" . $row['arrival_date'] . "</td>";
                    echo "<td>" . $row['passenger_name'] . "</td>";
                    echo "<td>" . $row['passenger_email'] . "</td>";
                    echo "<td>" . $row['seat_quantity'] . "</td>";
                    echo "<td>" . $row['price_per_seat'] . "</td>";
                    echo "<td>" . $row['total_price'] . "</td>";
                    echo "<td>" . $row['booking_date'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='12'>No booked flights found</td></tr>";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
    
</div>

<!-- Include your footer here -->

<script>
    // Fetch data from PHP and process it to count the number of booked flights for each date
    <?php
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch booked flights count for each booking date
    $sql = "SELECT booking_date, SUM(seat_quantity) AS total_seats FROM booked_tickets GROUP BY booking_date";
    $result = $conn->query($sql);

    $dates = [];
    $counts = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dates[] = $row['booking_date'];
            $counts[] = $row['total_seats'];
        }
    }

    $conn->close();
    ?>

    // Render bar graph using Chart.js
    const ctx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Number of Booked Seats',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Seats'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Booking Date'
                    }
                }
            }
        }
    });
</script>

</body>
</html>
