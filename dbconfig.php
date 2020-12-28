<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lrms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	if($conn->connect_error == "Unknown database 'lrms'"){
		header("Location: http://localhost/phpmyadmin/");
	}else {
  	die("Connection failed: " . $conn->connect_error);
	}
}
?>