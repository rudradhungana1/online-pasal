<?php
session_start();
include 'db_config.php'; 

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_id = $_SESSION['user_id']; 
    // Validate new password and confirmation
    if ($new_password !== $confirm_password) {
        die("New passwords do not match!");
    }

    // Fetch the current hashed password from the database
    $query = "SELECT password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];

        // Verify the current password
        if (password_verify($current_password, $hashed_password)) {
            // Hash the new password and update it
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            $update_query = "UPDATE users SET password = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param('si', $new_hashed_password, $user_id);

            if ($update_stmt->execute()) {
                echo "Password updated successfully!";
            } else {
                echo "Error updating password!";
            }
        } else {
            echo "Current password is incorrect!";
        }
    } else {
        echo "User not found!";
    }
}
?>
