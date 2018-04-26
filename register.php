<?php
$msg = "";
require_once 'Includes/connection.php';
$hasError = false;

    if($_SERVER['REQUEST_METHOD'] =='POST'){
    if( !empty($_POST['username']) )
    {
        $user = $_POST['username'];
        $stmt = $conn->prepare("SELECT Username,Role FROM Users WHERE Username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
        $msg .= "Username is already taken!<br>";
        $hasError = true;
        }
        
    }
    else {
    $msg .= "Please provide the username!"; 
    }

    if(!empty($_POST['email']))
    {
        $email = $_POST['email'];
        $stmt = $conn->prepare("SELECT Username,Role FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
        $msg .= "Email is already taken!<br>";
        $hasError = true;
        }
        
    }
    else {
    $msg .= "Please provide the email!"; 
    }

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
    $stmt = $conn->prepare("INSERT INTO Users(Username,Password,Role,Email,Fullname,Phone,Gender,BirthDate) VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $_POST['username'], $_POST['password'],$role,$_POST['email'],$_POST['fullname'],$_POST['phone'],$_POST['gender'],$_POST['birthdate']);

        // set parameters and execute

        $stmt->execute();
        $msg ="Registration success!. Please login!";
        header("location: login.php?msg=$msg");

    }
}




/*if(!empty($_POST['username']) && !empty($_POST['password']))
{
    $user = $_POST['username'];
    $pass=  $_POST['password'];
    $stmt = $conn->prepare("SELECT Username,Role FROM Users WHERE Username = ? AND Password= ?");
    $stmt->bind_param("ss", $user, $pass);

    // set parameters and execute

    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //CREATE A SESSION
            //REDIRECT
            session_start();
            $_SESSION['username'] = $user;
            $_SESSION['password'] = $pass;
            $_SESSION['role'] = $row["Role"];

            if($row["Role"] == "Shopper") {
            header("location: index.php");
            }
            else {
                header("location: admin.php");
            }
            
        }
        
    } else {
            echo "Incorrect username or password. Please try again!";
    }


}
*/
//print_r($_POST);

?>




<?php if(strlen($msg)>0){
    echo $msg;
}?>
<form action="/CS564/register.php" method="post">
  Username:
  <input type="text" name="username"><br>
  Password:
  <input type="password" name="password"><br>
  Email:
  <input type="email" name="email"><br>
  Fullname:
  <input type="text" name="fullname"><br>
  Phone:
  <input type="text" name="phone"><br>
  Gender :<select name="gender"> 
    <option value=" "> EMPTY </option> 
    <option value="M">Male</option> 
    <option value="F">Female</option> 
</select> <br>
  BirthDate:
   <input type="date" name="birthdate"><br>
  
  <input type="submit" value="Submit">
</form> 
