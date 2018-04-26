<?php

// Initialize the session

session_start();

 

// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username']) || empty($_SESSION['username']) ){

  header("location: login.php");

  exit;

}

if($_SESSION['role'] != 'Admin') {
echo "You are not authorized to view this page";
}

?> 
 
 
 
 
 
 
 
 
 
 <a href="/CS564/logout.php">logout</a> 
 