<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require 'User.php';
  require 'Database.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

  $user = new User($username, $password);
  $database = new Database('localhost', 'username', 'password', 'database_name');

  if (isset($_POST['signup'])) {
    $database->insertUser($user);
  } elseif (isset($_POST['login'])) {
    $database->loginUser($user);
  }

  $database->closeConnection();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sign Up and Login</title>
</head>
<body>
  <h1>Sign Up</h1>
  <form method="POST" action="index.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="signup">Sign Up</button>
  </form>

  <h1>Login</h1>
  <form method="POST" action="index.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
  </form>
</body>
</html>
