<?php

require_once 'Includes/connection.php';
include 'header.php';
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}


$msg="";

 if (!empty($_GET['msg'])) {
     $msg = $_GET['msg'];
 }


$stmt = $conn->prepare("SELECT * FROM Orders WHERE customer_id = ?");
$stmt->bind_param("i", $_SESSION['memberID']);
$stmt->execute();
$result = $stmt->get_result();
$orderView="";

if ($result->num_rows > 0) {
    $orderView .= "<table><tr>   <th>Order ID</th>    <th>Time</th>  <th>Total</th>  <th>Status</th> </tr>";


    while ($row = $result->fetch_assoc()) {
        $orderView .= "<tr><td><a href='/CS564/orderView.php?id=".$row['OrderID']."'>".$row['OrderID']."</a></td> ";
        $orderView .= "<td>".$row['Date_Time']."</td> ";
        $orderView .= "<td>".$row['TotalCost']."</td> ";
        $orderView .= "<td>".$row['Status']."</td> </tr>";
    }
    $orderView .= "</table>";
} else {
    $orderView .= "You haven't placed any orders!";
}
echo $orderView;
