<?php
  $servername = "localhost";
  $username = "aanaryom_usr_practice9";
  $password = "usr_practice9";
  $dbname = "aanaryom_db_practice9";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed : ". $conn->connect_error);
  }
?>