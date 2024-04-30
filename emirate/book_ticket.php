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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: white;
            color: black;
        }
        th, td {
            border: 1px solid white;
            padding: 8px;
            text-align: left;
            color: black;
            
        }
        tbody tr:nth-child(even) {
            background-color: whitesmoke;
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
    <div class="container">
        <div class="row justify-content-center mt-15">
            <div class="col-md-15">
            <div class="card">
                    <div class="card-body">
        <?php
        if (isset($_GET['flight_id'])) {
            $flight_id = $_GET['flight_id'];

            $sql = "SELECT * FROM flights WHERE id='$flight_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $flight = $result->fetch_assoc();
        ?>
                <h2 style='text-align: center;'>Flight Details</h2>
                    </div>
                <table class='table table-stripped '>
                    <tr>
                        <th>Flight No</th>
                        <th>From City</th>
                        <th>To City</th>
                        <th>Departure Date</th>
                        <th>Arrival Date</th>
                        <th>Seat Type</th>
                        <th>Seats Quantity</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                        <td><?= $flight['flight_no'] ?></td>
                        <td><?= $flight['from_city'] ?></td>
                        <td><?= $flight['to_city'] ?></td>
                        <td><?= $flight['departure_date'] ?></td>
                        <td><?= $flight['arrival_date'] ?></td>
                        <td><?= $flight['seat_type'] ?></td>
                        <td><?= $flight['seats_quantity'] ?></td>
                        <td><?= $flight['price'] ?></td>
                    </tr>
                </table>
                <div class="card-body">
                <h2 style='text-align: center;'>Book Ticket</h2></div><br>
                <form action="process_booking.php" method="post" style="margin-left: 2%;">
                    <input type="hidden" name="flight_id" value="<?= $flight_id ?>">
                    <div class="form-group">
                        <label for="passenger_name">Passenger Name:</label>
                        <input type="text" id="passenger_name" name="passenger_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="passenger_email">Passenger Email:</label>
                        <input type="email" id="passenger_email" name="passenger_email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="seat_quantity">Seats Quantity:</label>
                        <input type="number" id="seat_quantity" name="seat_quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="price_per_seat">Price Per Seat:</label>
                        <input type="number" id="price_per_seat" name="price_per_seat" class="form-control" value="<?= $flight['price'] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="total_price">Total Price:</label>
                        <input type="number" id="total_price" name="total_price" class="form-control" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Book Now</button><br><br>
                </form>
                <script>
                    // Calculate total price based on seat quantity and price per seat
                    document.getElementById('seat_quantity').addEventListener('input', function() {
                        var seatQuantity = parseInt(document.getElementById('seat_quantity').value);
                        var pricePerSeat = parseFloat(document.getElementById('price_per_seat').value);
                        var totalPrice = seatQuantity * pricePerSeat;
                        document.getElementById('total_price').value = totalPrice.toFixed(2);
                    });
                </script>
        <?php
            } else {
                echo "Flight details not found.";
            }
        } else {
            echo "Flight ID not provided.";
        }
        ?>
            </div><br>
        </div>
    </div>
    </div>
    <br>
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
<?php
$conn->close();
?>
