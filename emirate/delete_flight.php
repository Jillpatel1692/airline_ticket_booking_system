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

// Check if flight ID is provided
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $flight_id = $_GET['id'];

    // Prepare and bind delete statement
    $stmt = $conn->prepare("DELETE FROM flights WHERE id=?");
    $stmt->bind_param("i", $flight_id);

    // Execute the delete statement
    if ($stmt->execute() === TRUE) {
        echo "Flight record deleted successfully";
        header("Location: display_flight.php");
    } else {
        echo "Error deleting flight record: " . $conn->error;
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
    <title>Delete Flight</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: indigo;
            color: white;
            text-align: center;
            padding-top: 100px;
        }

        h2 {
            margin-bottom: 30px;
        }

        .btn {
            margin: 10px;
        }
    </style>
</head>
<body>
    <h2>Delete Flight</h2>
    <?php if(isset($_GET['id'])) : ?>
        <p>Are you sure you want to delete this flight record?</p>
        <a href="#" class="btn btn-danger" onclick="deleteFlight(<?php echo $_GET['id']; ?>)">Delete</a>
        <a href="index.php" class="btn btn-primary">Cancel</a>
    <?php else : ?>
        <p>No flight ID provided.</p>
    <?php endif; ?>

    <script>
        function deleteFlight(id) {
            if(confirm("Are you sure you want to delete this flight record?")) {
                window.location.href = "delete_flight.php?id=" + id;
            }
        }
    </script>
</body>
</html>
