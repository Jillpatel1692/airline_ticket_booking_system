<?php
include 'includes/db.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $role = 0; // Default role for new users

    // Check if there are no users in the login table
    $sql_check_users = "SELECT COUNT(*) as count FROM login";
    $result = $conn->query($sql_check_users);
    $row = $result->fetch_assoc();
    if ($row['count'] === '0') {
        $role = 1; // First user becomes admin
    }

    // Validate password on the server side
    if (!is_valid_password($password)) {
        // Redirect back to registration page with an error message
        header('Location: register.php?error=invalid_password');
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to insert data into the database
    $sql = "INSERT INTO login (username, password, email, phone_number, address, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $hashed_password, $email, $phone_number, $address, $role);
    $stmt->execute();

    // Redirect to login page after successful registration
    header('Location: login.php');
    exit;
}

// Function to validate the password
function is_valid_password($password) {
    // Password must contain at least one uppercase letter, one number, one special character, and be at least 8 characters long
    return preg_match('/^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/', $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
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
        button[type="submit"],
.btn-success {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button[type="submit"] {
    background-color: #1e90ff; /* Dark blue color */
    color: white;
}

button[type="submit"]:hover,
.btn-success:hover {
    background-color: #0066cc; /* Darker shade of blue on hover */
}
        .form-text {
            font-size: 14px;
            font-weight: bold;
            background-color: red;
            color: white;
            padding: 5px;
            border-radius: 5px;
            display: none; /* Initially hide */
            margin-top: 5px;
        }
        .form-group.password:hover .form-text {
            display: block; /* Display on hover */
        }
        .divider {
  display: flex;
  align-items: center;
  text-align: center;
}

.divider hr {
  flex-grow: 1;
  border: none;
  border-top: 1px solid #ccc;
}

.divider span {
  padding: 0 10px;
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
                <h2>User Registration</h2>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number:</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number">
                    </div>
                    <div class="form-group password">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="form-text">Password must contain at least one uppercase letter, one number, one special character, and be at least 8 characters long.</small>
                    </div>
                  
           

                    <div class="form-group">
    <label for="address">Address:</label>
    <input type="text" class="form-control" id="address" name="address" required>
</div>

                    <button type="submit">Register</button>
                    <div class="divider">
                    <hr>
                    <span>OR Login </span>
                    <hr>
                    </div>

                    <a href="login.php" class="btn btn-success">Login</a>

                </form>
            </div>
        </div>
    </div>
    <script>
        // Add event listener to the password input
        document.getElementById('password').addEventListener('input', function() {
            var password = this.value;
            var passwordRequirements = document.querySelector('.form-group.password .form-text');
            if (!is_valid_password(password)) {
                passwordRequirements.style.display = 'block';
            } else {
                passwordRequirements.style.display = 'none';
            }
        });

        // Function to validate the password
        function is_valid_password(password) {
            // Password must contain at least one uppercase letter, one number, one special character, and be at least 8 characters long
            return /^(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9]).{8,}$/.test(password);
        }
    </script>
</body>
</html>
