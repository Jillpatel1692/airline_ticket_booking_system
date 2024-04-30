<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: black;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>
<h2>Flights Table</h2>
    <!-- Flight form -->
<!-- Sidebar -->
<div class="sidebar">
        <a href="admindashboard.php">Dashboard</a>
        <a href="book_flight.php">Create Flight </a>
        <a href="display_flight.php">Flight Schedule</a>
        <a href="adminbookflight.php">Flight history</a>
        <a href="#">Settings</a>
        <a class="nav-link" href="adminlogout.php">Logout</a>
    </div>
   <form class="container" action="insert_flight.php" method="post" style="margin-left: 18%;">
   <div class="form-group">
        <label for="flight_no">Flight No:</label>
        <input type="text" id="flight_no" name="flight_no" class="form-control">
        </div>
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
        </select>
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
        <label for="departure_date">Departure Date:</label>
        <input type="date" id="departure_date" name="departure_date" class="form-control">
        </div>
        <div class="form-group">
        <label for="arrival_date">Arrival Date:</label>
        <input type="date" id="arrival_date" name="arrival_date" class="form-control">
        </div>
        
        <div class="form-group">
    <label for="seat_type">Seat Type:</label>
    <select id="seat_type" name="seat_type" class="form-control">
        <option value="Economic">Economic</option>
        <option value="Business">Business</option>
        <option value="First Class">First Class</option>
    </select>
</div>

        <div class="form-group">
        <label for="seats_quantity">Seats Quantity:</label>
        <input type="number" id="seats_quantity" name="seats_quantity" class="form-control">
        </div>
        <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" class="form-control">
        </div>
        
        <input type="submit" class="btn btn-primary" value="Submit">
    </form>

    <br><br>


    </table>
</body>
</html>
