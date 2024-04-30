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

$row = []; // Define $row as an empty array to avoid undefined variable warnings

// Fetch flight details based on ID
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $flight_id = $_GET['id'];
    $sql = "SELECT * FROM flights WHERE id=$flight_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Flight not found.";
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $flight_id = $_POST['id'];
    $from_city = $_POST['from_city'];
    $to_city = $_POST['to_city'];
    $departure_date = $_POST['departure_date'];
    $arrival_date = $_POST['arrival_date'];
    $seat_type = $_POST['seat_type'];
    $seats_quantity = $_POST['seats_quantity'];
    $price = $_POST['price'];

    // Prepare and bind update statement
    $stmt = $conn->prepare("UPDATE flights SET from_city=?, to_city=?, departure_date=?, arrival_date=?, seat_type=?, seats_quantity=?, price=? WHERE id=?");
    $stmt->bind_param("ssssssdi", $from_city, $to_city, $departure_date, $arrival_date, $seat_type, $seats_quantity, $price, $flight_id);

    // Execute the update statement
    if ($stmt->execute() === TRUE) {
        echo "Flight details updated successfully";
        header("Location: display_flight.php");
    } else {
        echo "Error updating flight details: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
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

    form {
        width: 50%;
        margin: auto;
    }

    label {
        margin-top: 10px;
        color: black;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 15px;
        border: 1px solid white;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: black;
        padding: 10px 20px;
        border: 1px solid white;
        border-radius: 4px;
    }

    /* Remove hover effect */
    /* input[type="submit"]:hover {
        background-color: #45a049;
    } */

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
    <h2>Edit Flight</h2><br>
     <!-- Sidebar -->
     <div class="sidebar">
        <a href="admindashboard.php">Dashboard</a>
        <a href="book_flight.php">Create Flight </a>
        <a href="display_flight.php">Flight Schedule</a>
        <a href="adminbookflight.php">Flight history</a>
        <a href="#">Settings</a>
        <a class="nav-link" href="adminlogout.php">Logout</a>
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id" value="<?php echo isset($row['id']) ? $row['id'] : ''; ?>">
        <div class="form-group">
        <label for="from_city">From City:</label>
        <select id="from_city" name="from_city" class="form-control">
            <option value="IN-AN">Andaman and Nicobar Islands</option>
            <option value="IN-AP">Andhra Pradesh</option>
            <option value="IN-AR">Arunachal Pradesh</option>
            <option value="IN-AS">Assam</option>
            <option value="IN-BR">Bihar</option>
            <option value="IN-CH">Chandigarh</option>
            <option value="IN-CT">Chhattisgarh</option>
            <option value="IN-DN">Dadra and Nagar Haveli and Daman and Diu</option>
            <option value="IN-DL">Delhi</option>
            <option value="IN-GA">Goa</option>
            <option value="IN-GJ">Gujarat</option>
            <option value="IN-HR">Haryana</option>
            <option value="IN-HP">Himachal Pradesh</option>
            <option value="IN-JH">Jharkhand</option>
            <option value="IN-KA">Karnataka</option>
            <option value="IN-KL">Kerala</option>
            <option value="IN-LA">Ladakh</option>
            <option value="IN-LD">Lakshadweep</option>
            <option value="IN-MH">Maharashtra</option>
            <option value="IN-MN">Manipur</option>
            <option value="IN-ML">Meghalaya</option>
            <option value="IN-MZ">Mizoram</option>
            <option value="IN-NL">Nagaland</option>
            <option value="IN-OR">Odisha</option>
            <option value="IN-PB">Punjab</option>
            <option value="IN-PY">Puducherry</option>
            <option value="IN-RJ">Rajasthan</option>
            <option value="IN-SK">Sikkim</option>
            <option value="IN-TN">Tamil Nadu</option>
            <option value="IN-TR">Tripura</option>
            <option value="IN-UP">Uttar Pradesh</option>
            <option value="IN-UT">Uttarakhand</option>
            <option value="IN-WB">West Bengal</option>
        </select><br>
        </div>
        <div class="form-group">
        <label for="to_city">To City:</label>
        <select id="to_city" name="to_city" class="form-control">
            <option value="IN-AN">Andaman and Nicobar Islands</option>
            <option value="IN-AP">Andhra Pradesh</option>
            <option value="IN-AR">Arunachal Pradesh</option>
            <option value="IN-AS">Assam</option>
            <option value="IN-BR">Bihar</option>
            <option value="IN-CH">Chandigarh</option>
            <option value="IN-CT">Chhattisgarh</option>
            <option value="IN-DN">Dadra and Nagar Haveli and Daman and Diu</option>
            <option value="IN-DL">Delhi</option>
            <option value="IN-GA">Goa</option>
            <option value="IN-GJ">Gujarat</option>
            <option value="IN-HR">Haryana</option>
            <option value="IN-HP">Himachal Pradesh</option>
            <option value="IN-JH">Jharkhand</option>
            <option value="IN-KA">Karnataka</option>
            <option value="IN-KL">Kerala</option>
            <option value="IN-LA">Ladakh</option>
            <option value="IN-LD">Lakshadweep</option>
            <option value="IN-MH">Maharashtra</option>
            <option value="IN-MN">Manipur</option>
            <option value="IN-ML">Meghalaya</option>
            <option value="IN-MZ">Mizoram</option>
            <option value="IN-NL">Nagaland</option>
            <option value="IN-OR">Odisha</option>
            <option value="IN-PB">Punjab</option>
            <option value="IN-PY">Puducherry</option>
            <option value="IN-RJ">Rajasthan</option>
            <option value="IN-SK">Sikkim</option>
            <option value="IN-TN">Tamil Nadu</option>
            <option value="IN-TR">Tripura</option>
            <option value="IN-UP">Uttar Pradesh</option>
            <option value="IN-UT">Uttarakhand</option>
            <option value="IN-WB">West Bengal</option>
        </select><br>
        </div>
    
        <div class="form-group">
            <label for="seat_type">Seat Type:</label>
            <select id="seat_type" name="seat_type" class="form-control" value="<?php echo isset($row['seat_type']) ? $row['seat_type'] : ''; ?>">
                <option value="Economic">Economic</option>
                <option value="Business">Business</option>
                <option value="First Class">First Class</option>
            </select>
        </div>
        <div class="form-group">
            <label for="departure_date">Departure Date:</label>
            <input type="date" id="departure_date" name="departure_date" class="form-control" value="<?php echo isset($row['departure_date']) ? $row['departure_date'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="arrival_date">Arrival Date:</label>
            <input type="date" id="arrival_date" name="arrival_date" class="form-control" value="<?php echo isset($row['arrival_date']) ? $row['arrival_date'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="seats_quantity">Seats Quantity:</label>
            <input type="number" id="seats_quantity" name="seats_quantity" class="form-control" value="<?php echo isset($row['seats_quantity']) ? $row['seats_quantity'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" class="form-control" value="<?php echo isset($row['price']) ? $row['price'] : ''; ?>">
        </div>
        <input type="submit" value="Update Flight">
    </form>
</body>
</html>
