<?php

class Database {
  private $connection;

  public function __construct($host, $username, $password, $database) {
    $this->connection = new mysqli($host, $username, $password, $database);

    if ($this->connection->connect_error) {
      die("Connection failed: " . $this->connection->connect_error);
    }
  }

  public function insertUser(User $user) {
    $username = $user->getUsername();
    $password = $user->getPassword();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";

    if ($this->connection->query($sql) === true) {
      echo "User created successfully";
    } else {
      echo "Error: " . $this->connection->error;
    }
  }

  public function loginUser(User $user) {
    $username = $user->getUsername();
    $password = $user->getPassword();

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $this->connection->query($sql);

    if ($result->num_rows === 1) {
      $row = $result->fetch_assoc();
      $hashedPassword = $row['password'];

      if (password_verify($password, $hashedPassword)) {
        echo "Login successful";
      } else {
        echo "Incorrect password";
      }
    } else {
      echo "User not found";
    }
  }

  public function closeConnection() {
    $this->connection->close();
  }
}
