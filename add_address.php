<?php
require_once 'Includes/connection.php';
include 'header.php';

if(!isset($_SESSION['username']) || empty($_SESSION['username']) ){

  header("location: login.php");

  exit;

}
$msg="";
if(!empty($_GET['msg']) )
{
$msg = $_GET['msg'];
}
$addr ="";

if( isset(  $_GET['addrId'])){
    $user = $_SESSION['memberID'];
    $stmt = $conn->prepare("SELECT * FROM Addresses WHERE AddressID = ? AND customer_id = ?");
    $stmt->bind_param("ii",  $_GET['addrId'],$user);

    if($stmt->execute()){
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
                print_r($row,true);

        $addr = $row['Address'];
    }

}
if( isset(  $_POST['submit'])){

    if(!empty($_POST['Address']) ||  strlen($_POST['Address']) <5)
    {
        $id = $_SESSION['memberID'];


        if(isset($_POST['addrId'])){
          $stmt = $conn->prepare("UPDATE Addresses SET Address=? WHERE AddressID =? AND customer_id = ?");
          $stmt->bind_param("sii", $_POST['Address'],$_POST['addrId'], $id);
          if($stmt->execute())
          {
            $msg = "Address Updated <br>";
            header("location: profile.php?msg=$msg");

          }else{
            $msg = "Fail to update address!!!";

          }
        }else{
          $stmt = $conn->prepare("INSERT INTO Addresses(customer_id,Address) VALUES(?,?)");
          $stmt->bind_param("is", $id, $_POST['Address']);
          if($stmt->execute())
          {
            $stmt = $conn->prepare("INSERT INTO Addresses(customer_id,Address) VALUES(?,?)");
            $stmt->bind_param("is", $id, $_POST['Address']);
            $msg = "Address successfully added!<br>";
            header("location: profile.php?msg=$msg");

          }else{
            $msg = "Fail to add address!!!";

          }
        }

        // set parameters and execute


    }else{
        $msg = "Please enter a valid address!";
    }

}

?>


<?php if(strlen($msg)>0){
    echo $msg;
}?>

    <form action="/CS564/add_address.php" method="post">
  Address:<br>
  <?php if(isset($_GET['addrId'])) { echo "<input type='hidden' name='addrId' value='".$_GET['addrId']."''>";}?>
  <input type="text" name="Address" value="<?php echo $addr ?>"><br>


  <input type="submit" name="submit" value="Submit">
</form>
