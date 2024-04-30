<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Retrieve and display the username from the session if it's set
if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
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
            font-family: "Times New Roman", Times, serif;
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
    .news-section .card-img-top {
        width: 100%; /* Set the width to 100% of the parent container */
        height: 200px; /* Set a fixed height for the image */
        object-fit: cover; /* Ensure the image covers the entire area */
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                <li class="nav-item">
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
    </nav>

    <!-- Page content -->
<div class="content">
    <h2>Welcome, <?php echo $username; ?>!</h2>
    
    

    <!-- Image Slider -->
    <div id="imageSlider" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./image/indigo1.png" class="d-block w-100" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="./image/indigo2.png" class="d-block w-100" alt="Image 2">
            </div>
            </div>
            <div class="carousel-item">
                <img src="./image/indigo3.png" class="d-block w-100" alt="Image 2">
            </div>
          
        </div>
        <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Beverage Section -->
    <div class="beverage-section" style="margin-left: 1%;">
        <h3>Beverages</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="./image/food2.png" class="card-img-top" alt="Beverage 1">
                    <div class="card-body">
                        <h5 class="card-title">6E Eats</h5>
                    
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="./image/food3.png" class="card-img-top" alt="Beverage 2">
                    <div class="card-body">
                        <h5 class="card-title">One for skies</h5>
                    
                    </div>
                </div>
            </div>
            
        </div>
    </div>


    <div class="news-section" style="margin-left: 1%;">
    <h3>News</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="./image/news1.png" class="card-img-top" alt="News 1">
                <div class="card-body">
                    <h5 class="card-title">News 1 Title</h5>
                    <p class="card-text">IndiGo partners with Altered to achieve 98% water conservation on its flights</p>
                    <a href="https://www.goindigo.in/press-releases/indigo-partners-with-altered-to-achieve-98-percent-water-conservation-on-its-flights.html?linkNav=%7C2%7CIndiGo%20News" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <img src="./image/news2.png" class="card-img-top" alt="News 2">
                <div class="card-body">
                    <h5 class="card-title">News 2 Title</h5>
                    <p class="card-text">Picture perfect bonds: IndiGo's #nofilter crafts a close-knit photography community with National Geographic</p>
                    <a href="https://www.goindigo.in/press-releases/picture-perfect-bonds.html?linkNav=%7C1%7CIndiGo%20News" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

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
