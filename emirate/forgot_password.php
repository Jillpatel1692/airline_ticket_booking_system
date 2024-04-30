<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <?php
        // Display error message if it exists
        if (isset($_GET['error']) && $_GET['error'] === 'same_password') {
            echo '<div class="alert alert-danger" role="alert">Error: New password cannot be the same as the old password. Please choose a different password.</div>';
        }
        ?>
        <form method="post" action="reset_password.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</body>
</html>
