<?php
include 'includes/db.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to retrieve user data from the database
    $stmt = $conn->prepare("SELECT id, username, password, role FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    // Check if the user exists
    if ($stmt->num_rows == 1) {
        // Bind the retrieved data
        $stmt->bind_result($id, $username, $hashed_password, $role);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start the session and store user data
            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role; // Store user role in the session

            // Redirect users based on their role
            if ($role == 1) {
                // Admin dashboard
                header('Location:admindashboard.php');
            } else {
                // User dashboard
                header('Location: dashboard.php');
            }
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .registration-container {
            display: flex;
            width: 80%;
            max-width: 800px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .left-side {
            flex: 1;
            padding: 20px;
            height: auto; /* Set height to auto */
        }
        .left-side img {
            max-width: 100%;
            height: 100%; /* Set height to 100% */
        }
        .right-side {
            flex: 1;
            padding: 20px;
        }
        .right-side h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #1e90ff; /* Dark blue color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0066cc; /* Darker shade of blue on hover */
        }
        .btn-link {
            /* Your styles for btn-link class */
        }
        .alert {
            /* Your styles for alert class */
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="registration-container">
            <div class="left-side">
                <img src="./image/login1.png" alt="Left Side Image">
            </div>
            <div class="right-side">
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>

            <button type="submit" class="btn btn-primary">Login</button>
            
        </form>
    </div>
</body>
</html>
