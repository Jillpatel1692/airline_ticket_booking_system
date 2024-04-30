<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in and has admin privileges, if not, redirect to the login page
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id']) || $_SESSION['role'] !== 1) {
    header("Location: login.php");
    exit;
}

// Retrieve and display the username from the session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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

        /* Page content */
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="admindashboard.php">Dashboard</a>
        <a href="book_flight.php">Create Flight </a>
        <a href="display_flight.php">Flight Schedule</a>
        <a href="adminbookflight.php">Flight history</a>
        <a href="#">Settings</a>
        <a class="nav-link" href="adminlogout.php">Logout</a>
    </div>

    <!-- Page content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Welcome to Indigo Airline </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
        </nav>

        <h2>Welcome, <?php echo $username; ?>!</h2>
        <div class="text-center mt-4">
        <img src="./image/img.jpg" alt="Indigo Airline Logo" style="width: 900px;">
    </div>
</body>
</html>
