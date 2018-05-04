<?php

require_once 'Includes/connection.php';
include 'header.php';
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("location: login.php");
    exit;
}


if ($_SESSION['role'] != 'Admin') {
    $msg = "You are not authorized to view admin page! \n";
    header("location: profile.php?msg=$msg");
    exit;
}
function printOrderAction($currStatus, $pid)
{
    $actionView = "<form action='$site_root/manage_orders.php' method='post'><input type='hidden' name='oid' value=$pid>";
    if ($currStatus =="Placed") {
        $actionView .= "<button type='submit'  name='action' value='Confirmed'>Confirm</button>";
        $actionView .= "<button type='submit'  name='action' value='Canceled'>Cancel</button>";
    } elseif ($currStatus =="Confirmed") {
        $actionView .= "<button type='submit'  name='action' value='Shipped'>Ship</button>";
        $actionView .= "<button type='submit'  name='action' value='Canceled'>Cancel</button>";
    } elseif ($currStatus =="Shipped") {
        $actionView .= "<button type='submit'  name='action' value='Delivered'>Deliver</button>";
        $actionView .= "<button type='submit'  name='action' value='Canceled'>Cancel</button>";
    } else {
        $actionView .= "";
    }
    $actionView .= "</form >";
    return $actionView;
}

$msg="";
$status="%";
if (!empty($_GET['msg'])) {
    $msg = $_GET['msg'];
}
if (!empty($_POST['status'])) {
    $status= $_POST['status'];
}
if (!empty($_POST['action'])) {
    $action= $_POST['action'];
    $stmt = $conn->prepare("UPDATE Orders SET Status=? WHERE OrderID =?");
    $stmt->bind_param("si", $_POST['action'], $_POST['oid']);
    if ($stmt->execute()) {
        $msg.= "Order Updated sucessfully!";
    } else {
        echo $stmt->error;
        $msg.= "Failed!!";
    }
}

$stmt = $conn->prepare("SELECT * FROM Orders WHERE Status Like ?");
$stmt->bind_param("s", $status);
$stmt->execute();
$result = $stmt->get_result();
$orderView="";
$orderView .= "<form action='$site_root/manage_orders.php' method='post'>";
$orderView .="<td><button type='submit'  name='status' value='%' >Show All</button></th>";
$orderView .="<td><button type='submit'  name='status' value='Placed'>Show Placed</button></th>";
$orderView .="<td><button type='submit'  name='status' value='Canceled'>Show Cancelled</button></th>";
$orderView .="<td><button type='submit'  name='status' value='Confirmed'>Show Confirmed</button></th>";
$orderView .="<td><button type='submit'  name='status' value='Shipped'>Show Shipped</button></th>";
$orderView .="<td><button type='submit'  name='status' value='Delivered'>Show Delivered</button></th></form>";
if ($result->num_rows > 0) {
    $orderView .= "<table><tr>   <th>Order ID</th>    <th>Time</th>  <th>Total</th>  <th>Status</th> </tr>";

    while ($row = $result->fetch_assoc()) {
        $orderView .= "<tr><td><a href='$site_root/orderView.php?id=".$row['OrderID']."'>".$row['OrderID']."</a></td> ";
        $orderView .= "<td>".$row['Date_Time']."</td> ";
        $orderView .= "<td>".$row['TotalCost']."</td> ";
        $orderView .= "<td>".$row['Status']."</td> ";
        $orderView .="<td>". printOrderAction($row['Status'], $row['OrderID'])."</td> </tr>";
    }
    $orderView .= "</table>";
} else {
    $orderView .= "No orders with selected category!";
}
echo $orderView;
