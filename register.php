<?php
require_once 'db.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $username = $_POST['username'];
   $password = $_POST['password'];
   $email = $_POST['email'];

   // Insert data into the users table
   $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
   $stmt->bind_param("sss", $username, $password, $email);

   if ($stmt->execute()) {
      // Redirect to login.php after successful registration
      header("Location: login.php");
      exit;
   } else {
      echo "Error: " . $stmt->error;
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
      <title>Register</title>
   </head>

   <body>
      <div class="login-container">
         <h2>REGISTER FORM</h2>
         <form method="POST" action="" class="login-form">
            <div class="form-group">
               <label for="username">Username:</label>
               <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
               <label for="password">Password:</label>
               <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
               <label for="email">Email:</label>
               <input type="email" id="email" name="email" required>
            </div>
            <button type="submit">Register</button>
         </form>
         <span class='login-here'>Already have an account. <a href='login.php'>Login here</a></span>
      </div>
   </body>

</html>
