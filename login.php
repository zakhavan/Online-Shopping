<?php
require_once 'Includes/connection.php';
include 'header.php';

if (isset($_SESSION['username'])) {
    header("location: profile.php?msg=Please logout to login again!");
}




$msg="";
if (!empty($_GET['msg'])) {
    $msg = $_GET['msg'];
}

if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $user = $_POST['username'];
    $pass=  $_POST['password'];
    $stmt = $conn->prepare("SELECT MemberID,Role FROM Users WHERE Username = ? AND Password= ?");
    $stmt->bind_param("ss", $user, $pass);

    // set parameters and execute

    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //CREATE A SESSION
            //REDIRECT
            session_start();
            $_SESSION['username'] = $user;
            $_SESSION['memberID'] =  $row["MemberID"];

            $_SESSION['role'] = $row["Role"];

            if ($row["Role"] == "Shopper") {
                header("location: index.php");
            } else {
                header("location: admin.php");
            }
        }
    } else {
        echo "Incorrect username or password. Please try again!";
    }
}



?>


<?php if (strlen($msg)>0) {
    echo $msg;
}?>


<form action="/CS564/login.php" method="post">
  Username:<br>
  <input type="text" name="username"><br>
  Password:<br>
  <input type="password" name="password">
  <input type="submit" value="Submit">
</form>
