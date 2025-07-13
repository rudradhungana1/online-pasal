<?php
session_start();
include 'db_config.php'; 


if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view this page!");
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT email, username, status, role FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    die("User not found!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: #f5f5f5;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    .profile-section, .password-section {
      margin-bottom: 20px;
    }
    .profile-section p, .password-section label {
      margin: 10px 0;
      font-size: 16px;
    }
    input[type="password"], input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    input[type="submit"] {
      background: #4CAF50;
      color: #fff;
      font-size: 16px;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #45a049;
    }
  </style>
</head>
<body>
<?php include 'header2.php'; ?>
  <div class="container">
    <h2>User Profile</h2>
    <div class="profile-section">
      <h3>Profile Details</h3>
      <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
      <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
      <p><strong>Status:</strong> <?php echo htmlspecialchars($user['status']); ?></p>
    </div>
    <div class="password-section">
      <h3>Change Password</h3>
      <form action="change_password.php" method="POST">
        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <label for="confirm_password">Confirm New Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <input type="submit" value="Change Password">
      </form>
    </div>
  </div>
</body>
</html>
