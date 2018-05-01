<?php

// Initialize the session

session_start();
  $htmlString = ' <a href="/CS564/index.php">Home</a>  ';
 

// If session variable is not set it will redirect to login page

if(isset($_SESSION['username'])){
    $htmlString .= 'Welcome '. $_SESSION["username"];

  $htmlString .= ' <a href="/CS564/profile.php">Profile</a>  ';
  $htmlString .= ' <a href="/CS564/cart.php">Cart</a>  ';
   $htmlString .= ' <a href="/CS564/order.php">Order</a>  ';
  $htmlString .= ' <a href="/CS564/logout.php">Logout</a>  ';
  

}else{

      $htmlString .= ' <a href="/CS564/login.php">Login</a>  ';
      $htmlString .= ' <a href="/CS564/register.php">Register</a>';


}

echo $htmlString ." <br>" ;

?> 
 
 
 
 
 
 
 
 
 
 