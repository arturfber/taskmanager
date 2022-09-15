<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "taskmanager_db";


// Create connection
$con = new mysqli($servername, $username, $password, $database);


// Check connection
if ($con->connect_error) {
  die("Houve um erro ao conectar-se ao banco de dados: " . $con->connect_error);
}
?>