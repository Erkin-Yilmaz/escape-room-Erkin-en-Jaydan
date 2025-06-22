<?php
$server = "localhost"; 
$username = "root";
$password = ""; 
$db = "escape-room"; //pas dit aan indien de naam van jullie database anders is

try {
  $dbConnection = new PDO("mysql:host=$server; dbname=$db", $username, $password);
  $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Verbinding mislukt" . $e->getMessage();
}