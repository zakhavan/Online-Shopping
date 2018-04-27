<?php
require_once 'Includes/connection.php';
include 'header.php';


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
        $stmt = $conn->prepare("INSERT INTO Addresses(customer_id,Address) VALUES(?,?)");
        $stmt->bind_param("is", $id, $_POST['Address']);

        // set parameters and execute

        if($stmt->execute())
        {$msg = "Address successfully added!\n";
         header("location: profile.php?msg=$msg");
        
        }else{
        $msg = "Fail to add address!!!";
        
        }
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
  <input type="text" name="Address" value="<?php echo $addr ?>"><br>
 
  
  <input type="submit" name="submit" value="Submit">
</form> 