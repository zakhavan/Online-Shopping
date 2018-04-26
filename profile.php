<?php
require_once 'Includes/connection.php';
 session_start();
 $msg="";
 
 if(!empty($_GET['msg']) )
{
$msg = $_GET['msg'];
}

// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username']) || empty($_SESSION['username']) ){

  header("location: login.php");

  exit;

}


$user = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM Users WHERE Username = ?");
$stmt->bind_param("s", $user);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

if($_SERVER['REQUEST_METHOD'] =='POST'){
$hasError=false;
    //empty fields

    if(empty($_POST['password'])){
    $msg .= "Please enter password!<br>";
        $hasError = true;
    }

    if(empty($_POST['fullname'])){
    $msg .= "Please enter name!<br>";
        $hasError = true;
    }

    if(empty($_POST['phone'])){
    $msg .= "Please enter phone!<br>";
        $hasError = true;
    }

    if(empty($_POST['gender']) || $_POST['gender']==" "){
    $msg .= "Please enter gender!<br>";
        $hasError = true;
    }

    if(empty($_POST['birthdate'])){
    $msg .= "Please enter birthdate!<br>";
        $hasError = true;
    }

    if($hasError == false) {
    $role ="Shopper";
    $stmt = $conn->prepare("UPDATE Users SET Password=?,Fullname=?,Phone=?,Gender=?,BirthDate=? WHERE Username=?");
    $stmt->bind_param("ssssss", $_POST['password'],$_POST['fullname'],$_POST['phone'],$_POST['gender'],$_POST['birthdate'],$_SESSION['username']);

        // set parameters and execute

        $stmt->execute();
        $msg ="Update success!!";
        header("location: profile.php?msg=$msg");

    }
}



?>

<?php if(strlen($msg)>0){
    echo $msg;
}?>


<form action="/CS564/profile.php" method="post">
  Username:
  <input type="text" name="username" value="<?php echo $row['Username']?>" disabled><br>
  Password:
  <input type="password" name="password" value="<?php echo $row['Password']?>" ><br>
  Email:
  <input type="email" name="email" value="<?php echo $row['Email']?>" disabled><br>
  Fullname:
  <input type="text" name="fullname" value="<?php echo $row['Fullname']?>"><br>
  Phone:
  <input type="text" name="phone" value="<?php echo $row['Phone']?>" ><br>
  Gender :<select name="gender" > 
    <option value=" "> EMPTY </option> 
    <option value="M" selected="<?php if ($row['Gender'] ='M'){echo 'selected'; } ?>">Male</option> 
    <option value="F" selected="<?php if ($row['Gender'] ='F'){echo 'selected'; } ?>">Female</option> 
</select> <br>
  BirthDate:
   <input type="date" name="birthdate" value="<?php echo $row['BirthDate']?>" ><br>
  
  <input type="submit" value="Update" >
</form> 

<h1> Manage Addresses</h1>
 <a href="/CS564/add_address.php">Add a new address</a> 
