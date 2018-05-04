<html>

<head>


<style>
table, th, td {
   border: 1px solid black;
}
a{
  margin: 2px 2px 2px 2px;
}
a:link    {
  /* Applies to all unvisited links */
  text-decoration:  none;
  font-weight:      bold;
  color:            blue;
  }
a:visited {
  /* Applies to all visited links */
  text-decoration:  none;
  font-weight:      bold;
  color:            blue;
  }
a:hover   {
  /* Applies to links under the pointer */
  text-decoration:  underline;
  font-weight:      bold;
  }
a:active  {
  /* Applies to activated links */
  text-decoration:  underline;
  font-weight:      bold;
  color: black;
  }
</style>

</head>





<body>


<?php

// Initialize the session

session_start();
  $htmlString = '';

// If session variable is not set it will redirect to login page

if (isset($_SESSION['username'])) {
    $htmlString = '<div style="background-color:#BCC6CC;float: left;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/index.php">Home</a>  ';

    if ($_SESSION['role'] =='Admin') {
        $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/admin.php">Admin</a>  ';
    }
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/profile.php">Profile</a>  ';
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/order.php">Orders</a>  ';
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/cart.php">Cart</a> </div> ';

    $htmlString .= '<div style="background-color:#BCC6CC;float: right;overflow: hidden;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/logout.php">Logout</a></div>  ';
    $htmlString .= '<div style="background-color:#E5E4E2;float: none;padding: 50px; text-align: center;">Logged in as '. $_SESSION["username"].' <form action="'.$site_root.'/index.php" method="GET">
    <input id="search" name="search" type="text" placeholder="Type here">
    <input id="submit" type="submit" value="Search">
    </form> </div>';
} else {
    $htmlString = '<div style="background-color:#BCC6CC;float: left;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/index.php">Home</a> </div>';
    $htmlString .= '<div style="background-color:#BCC6CC;float: right;overflow: hidden;padding: 50px"> <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/login.php">Login</a>  ';
    $htmlString .= ' <a style="background-color:#98AFC7;padding:5px 10px 5px 10px" href="'.$site_root.'/register.php">Register</a></div>';
    $htmlString .= '<div style="background-color:#E5E4E2;float: none;padding: 50px; text-align: center;">

    <form action="'.$site_root.'/index.php" method="GET">
    <input id="search" name="search" type="text" placeholder="Type here">
    <input id="submit" type="submit" value="Search">
    </form>

    </div>';

}

echo $htmlString ." <br>" ;
