<?php
// Start a session to store user information on successful login
session_start();

require 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare and execute query to check if the user exists with the given username and password
  $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $stmt->store_result();

  if ($stmt->num_rows > 0) {
    // If a match is found, login is successful
    $stmt->bind_result($user_id);
    $stmt->fetch();
    $_SESSION['user_id'] = $user_id;

    // Redirect to index.php
    header("Location: index.php");
    exit;
  } else {
    // If no match, show an error
    echo "Invalid username or password.";
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
    <link rel="stylesheet" href="loginregister.css">
    <title>Login</title>
  </head>

  <body>
      <div class="login-container">
    <h2>LOGIN FORM</h2>
    <form method="POST" action="" class="login-form">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>
    </form>
    <span>Create Account: <a href="register.php">Register here</a></span>
  </div>
  </body>


</html>
