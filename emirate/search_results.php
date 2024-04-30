<!-- search_results.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
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
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <br><br><br>

        <?php
// search_results.php
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

// Retrieve search parameters
$from_city = $_GET['from_city'];
$to_city = $_GET['to_city'];
$seat_type = $_GET['seat_type'];

// Perform query to fetch flights based on search criteria
$sql = "SELECT * FROM flights WHERE from_city='$from_city' OR to_city='$to_city' OR seat_type='$seat_type'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display search results
    echo "<div class='container'>";
    echo "<h2 class='text-center'>Search Results</h2>";
    echo "<table class='table table-striped text-center'>";
    echo "<thead><tr><th>Flight No</th><th>From City</th><th>To City</th><th>Departure Date</th><th>Arrival Date</th><th>Seat Type</th><th>Seats Quantity</th><th>Price</th><th>Book Ticket</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['flight_no'] . "</td>";
        echo "<td>" . $row['from_city'] . "</td>";
        echo "<td>" . $row['to_city'] . "</td>";
        echo "<td>" . $row['departure_date'] . "</td>";
        echo "<td>" . $row['arrival_date'] . "</td>";
        echo "<td>" . $row['seat_type'] . "</td>";
        echo "<td>" . $row['seats_quantity'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td><a href='book_ticket.php?flight_id=" . $row['id'] . "' class='btn btn-success'>Book Ticket</a></td>";
        echo "</tr>";
    }
    
    echo "</tbody></table>";
        echo "</div>";
    } else {
        echo "<div class='container text-center'>";
        echo "No flights found matching the search criteria.";
        echo "</div>";
    }

$conn->close();
?>
<br><br>
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
            <a href="#"><img src="google-play-badge.png" alt="Google Play"></a>
            <a href="#"><img src="app-store-badge.png" alt="App Store"></a>
            <h5>Our Awards</h5>
            <p>Best Airline - Cost Effectiveness - <em>Global</em></p>
          </div>
          <div class="footer-section">
            <h5>Social</h5>
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
            <a href="#"><img src="linkedin-icon.png" alt="LinkedIn"></a>
          </div>
        </div>
      </footer>
      
</body>
</html>
