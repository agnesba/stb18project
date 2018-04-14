<?php

$servername= "localhost";
$username ="root";
$password= "bottTAEJIN1809";
$db = "test";

// Create connection
$conn= mysqli_connect ($servername,$username,$password,$db) or die ("You are connected");

// Check connection
echo "Your are connected";
?>
