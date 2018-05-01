<?php

// Initialize the session

session_start();
  $htmlString = '';

// If session variable is not set it will redirect to login page

if (isset($_SESSION['username'])) {
    $htmlString = '<div style="background-color:#BCC6CC;float: left;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/index.php">Home</a>  ';

    if ($_SESSION['role'] =='Admin') {
        $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/admin.php">Admin</a>  ';
    }
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/profile.php">Profile</a>  ';
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/order.php">Orders</a>  ';
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/cart.php">Cart</a> </div> ';

    $htmlString .= '<div style="background-color:#BCC6CC;float: right;overflow: hidden;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/logout.php">Logout</a></div>  ';
    $htmlString .= '<div style="background-color:#E5E4E2;float: none;padding: 50px; text-align: center;">Logged in as '. $_SESSION["username"]."</div>";
} else {
  $htmlString = '<div style="background-color:#BCC6CC;float: left;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/index.php">Home</a> </div>';

    $htmlString .= '<div style="background-color:#BCC6CC;float: right;overflow: hidden;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/login.php">Login</a>  ';
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="/CS564/register.php">Register</a></div>';
    $htmlString .= '<div style="background-color:#E5E4E2;float: none;padding: 50px; text-align: center;">Welcome</div>';

}

echo $htmlString ." <br>" ;
