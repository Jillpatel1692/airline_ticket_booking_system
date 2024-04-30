<?php
// reset_password.php
include 'includes/db.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];

    // Retrieve the old password from the database
    $stmt = $conn->prepare("SELECT password FROM login WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($old_password);
    $stmt->fetch();
    $stmt->close();

    // Verify if the new password is different from the old password
    if (password_verify($new_password, $old_password)) {
        // If the new password matches the old password, redirect back to the password reset page with an error message
        header('Location: forgot_password.php?error=same_password');
        exit;
    }

    // Check if the new password is the same as the old password (plaintext comparison)
    if ($new_password === $old_password) {
        // If the new password matches the old password, redirect back to the password reset page with an error message
        header('Location: forgot_password.php?error=same_password');
        exit;
    }

    // Hash the new password before storing it
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password in the database
    $stmt = $conn->prepare("UPDATE login SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $hashed_password, $username);
    $stmt->execute();
    $stmt->close();

    // Redirect user to a confirmation page
    header('Location: reset_password_confirmation.php');
    exit;
}
?>
