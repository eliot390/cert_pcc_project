<?php
  define('servername', 'localhost');
  define('username', 'root');
  define('password', 'qwerty');
  define('dbname', 'cert_project');

  // Create connection
  $conn = new mysqli(servername, username, password, dbname);

  // Check connection
  if ($conn->connect_error)
  {
    die("Connection failed: " . $conn->connect_error);
  }
?>
