<?php
$servername = "chester.cs.unm.edu";
$username = "zakhavan";
$password = "IFyX1X45";
$site_root ="/CS564";
//$GLOBALS['a'] = 'localhost';


$dbname = "zakhavan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
