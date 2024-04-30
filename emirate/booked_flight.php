<?php
// Start the session
session_start();

// Check if the user is already logged in, redirect to login page if not
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// PayPal Sandbox credentials for buyer and seller
$paypal_sandbox_buyer_email = "sb-cvurr29772165@personal.example.com"; // Replace with your buyer sandbox email
$paypal_sandbox_seller_email = "sb-jp6th29126277@business.example.com";
// Replace with your seller sandbox email

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booked Flights</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
       
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
            color: black;
            height: 50%;
        }
        th {
            background-color: white;
        }
        tbody tr:nth-child(even) {
            background-color: white;
        }
        
        
        /* Page content */
        body {
            background-color: white; /* Set background color to white */
        }

        .navbar {
            background-color: black !important; /* Set navbar background color to indigo */
        }

        .content {
            padding: 20px;
            background-color: white; /* Set content background color to white */
            margin-top: 20px; /* Add some space from the navbar */
        }

        h2 {
            color: black;
        }
        footer {
        background-color: rgb(32, 78, 178);
        color: white;
        padding: 20px 0;
    }

    .container {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .footer-section {
        flex: 1;
        margin: 0 20px;
    }

    .footer-section h5 {
        margin-bottom: 10px;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
    }

    .footer-section ul li {
        margin-bottom: 5px;
    }

    .footer-section a {
        color: white;
        text-decoration: none;
    }

    .footer-section a:hover {
        text-decoration: underline;
    }

    .footer-section p {
        margin: 5px 0;
    }

    .footer-section img {
        margin-right: 5px;
        width: 30px; /* Adjust as needed */
    }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Welcome to Indigo Airline</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="nav-link" href="adminlogout.php" style="color: white;">Logout</a>

       
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                    <a class="nav-link" href="dashboard.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="search_results.html">Search Flight</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="booked_flight.php">Booked Ticket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
                <!-- <a href="adminlogout.php" class="btn btn-danger">Logout</a> -->
               
            </ul>
        </div>
               <!-- </li> -->
    </nav><br>
    <br>
    <h2 style="text-align: center;">Booked Flight</h2>
    <br>
    <div class="container">
        <?php
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

        // Retrieve user_id from session
        $user_id = $_SESSION['user_id'];

        echo "<p>User ID from session: $user_id</p>"; // Debug information

        // SQL query with JOIN operation to retrieve flight information
        $sql = "SELECT bt.*, f.flight_no, f.from_city, f.to_city, f.departure_date, f.arrival_date 
                FROM booked_tickets bt
                INNER JOIN flights f ON bt.flight_id = f.id
                WHERE bt.user_id='$user_id'";
        $result = $conn->query($sql);

        if ($result === false) {
            // Handle the SQL error
            echo "Error: " . $conn->error;
        } else {
            if ($result->num_rows > 0) {
                // Display booked flights
               
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Flight No</th><th>From City</th><th>To City</th><th>Departure Date</th><th>Arrival Date</th><th>Passenger Name</th><th>Passenger Email</th><th>Seats Quantity</th><th>Price Per Seat</th><th>Total Price</th><th>Booking Date</th></tr></thead>";
                echo "<tbody>";
                $totalPrice = 0;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
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
                    // Accumulate total price
                    $totalPrice += $row['total_price'];
                }
                echo "</tbody></table>";

                // Create PayPal payment button
                echo "<form action='https://www.sandbox.paypal.com/cgi-bin/webscr' method='post' target='_top'>"; // Note the sandbox URL
                echo "<input type='hidden' name='cmd' value='_xclick'>";
                echo "<input type='hidden' name='business' value='$paypal_sandbox_seller_email'>";
                echo "<input type='hidden' name='currency_code' value='USD'>";
                echo "<input type='hidden' name='item_name' value='Flight Booking'>";
                echo "<input type='hidden' name='amount' value='$totalPrice'>";
                echo "<input type='image' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' border='0' name='submit' alt='PayPal - The safer, easier way to pay online'>";
                echo "</form>";
            } else {
                echo "<p>No booked flights found for user ID: $user_id</p>"; // Debug information
            }
        }

        $conn->close();
        ?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br>
    <footer>
  <div class="container">
    <div class="footer-section">
      <h5>About Us</h5>
      <ul>
        <li><a href="#">Get to Know Us</a></li>
        <li><a href="#">InfoGrafiken – CSR Initiatives</a></li>
        <li><a href="#">Board of Directors</a></li>
        <li><a href="#">Leadership Team</a></li>
        <li><a href="#">Investor Relations</a></li>
        <li><a href="#">Press Releases</a></li>
        <li><a href="#">RWJPD – Equal Opportunity Employer</a></li>
        <li><a href="#">GVM Awards</a></li>
        <li><a href="#">HAWTs workplace policy</a></li>
        <li><a href="#">Get Nutri-Fit Information</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h5>Services</h5>
      <ul>
        <li><a href="#">Plan B</a></li>
        <li><a href="#">Medical Assistance</a></li>
        <li><a href="#">Special Mobility Assistance</a></li>
        <li><a href="#">Seat Selec</a></li>
        <li><a href="#">Baggage</a></li>
        <li><a href="#">Add-ons & Services</a></li>
        <li><a href="#">Group Bookings</a></li>
        <li><a href="#">Refund Claim</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h5>Quick Links</h5>
      <ul>
        <li><a href="#">Offer Center</a></li>
        <li><a href="#">Advertisement with us</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Sitemap</a></li>
        <li><a href="#">Developers</a></li>
        <li><a href="#">Blogs and Blogs</a></li>
        <li><a href="#">Terms and Conditions</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Cancellations / Change</a></li>
        <li><a href="#">Internacional Dialer Tips</a></li>
        <li><a href="#">Tele-check-in</a></li>
        <li><a href="#">Purchase Requirements</a></li>
      </ul>
    </div>
    <div class="footer-section">
      <h5>Connect</h5>
      <p>24/7 Customer Support</p>
      <a href="tel:+71234567819">+71 234567819</a>
      <h5>Download</h5>
      <a href="#"><i class="fab fa-google-play"></i></a>
    <a href="#"><i class="fab fa-app-store-ios"></i></a>
      <h5>Our Awards</h5>
      <p>Best Airline - Cost Effectiveness - <em>Global</em></p>
    </div>
    <div class="footer-section">
    <h5>Social</h5>
    <a href="#"><i class="fab fa-facebook-f"></i></a>
    <a href="#"><i class="fab fa-twitter"></i></a>
    <a href="#"><i class="fab fa-instagram"></i></a>
    <a href="#"><i class="fab fa-linkedin-in"></i></a>
</div>

  </div>
</footer>
</body>
</html>
