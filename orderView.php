<?php
// Initialize the session
require_once 'Includes/connection.php';
include 'header.php';

$msg="";

if (!empty($_GET['msg'])) {
    $msg = $_GET['msg'];
}

 $ordersView="";

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


if (!empty($_GET['id'])) {
    $productID = $_GET['id'];

    $addr = "";
    $total=0;
    $status="";
    $stmt = $conn->prepare("SELECT OrderID,Date_Time,Status,address_id,TotalCost FROM Orders WHERE customer_id = ? AND OrderID = ?");
    $stmt->bind_param("ii", $_SESSION['memberID'], $_GET['id']);

    if($_SESSION['role'] == 'Admin'){
      $stmt = $conn->prepare("SELECT OrderID,Date_Time,Status,address_id,TotalCost FROM Orders WHERE OrderID = ?");
      $stmt->bind_param("i", $_GET['id']);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $ordersView .= "<table><tr>   <th>Order ID</th>    <th>Time</th>   <th>Status</th> </tr>";


        while ($row = $result->fetch_assoc()) {
            $ordersView .= "<td>".$row['OrderID']."</td> ";
            $ordersView .= "<td>".$row['Date_Time']."</td> ";
            $ordersView .= "<td>".$row['Status']."</td> </tr>";
            $status = $row['Status'];
            $addr = $row['address_id'];
            $total = $row['TotalCost'];
        }
        $ordersView .= "</table>";


        $stmt = $conn->prepare("SELECT Address FROM Addresses WHERE customer_id = ? AND AddressID = ?");
        $stmt->bind_param("ii", $_SESSION['memberID'], $addr);
        $stmt->execute();
        $result = $stmt->get_result();



        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ordersView .="<h1>Shipping Address</h1>";
            $ordersView .= "<p>".$row['Address']."</p> ";
        }

        $stmt = $conn->prepare("SELECT p.ProductName,p.Price,op.Quantity,(p.Price * op.Quantity) AS total_price FROM OrderProducts AS op LEFT JOIN Products AS p ON op.product_id = p.ProductID WHERE op.order_id = ?");

        $stmt->bind_param("i", $_GET['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $ordersView .= "<h1>Products:</h1><table><tr>   <th>ProductName</th>   <th>Quantity</th>  <th>Unit Price</th> <th>Total Price</th> </tr>";
        while ($row = $result->fetch_assoc()) {
            $ordersView .= "<tr><td>".$row['ProductName']."</td> ";
            $ordersView .= "<td>".$row['Quantity']."</td> ";
            $ordersView .= "<td>".$row['Price']."</td> ";
            $ordersView .= "<td>".$row['total_price']."</td> ";
        }

        $ordersView .="</table>";
        $ordersView .="Total order value is $" .$total;
        $ordersView .= "<form action='$site_root/orderView.php?id=".$_GET['id']."' method='post'><input type='hidden' name='oid' value=".$_GET['id'].">";

        if ($status !="Delivered" || $status !="Canceled") {
          if($_SESSION['role'] == 'Admin'){
            if ($status =="Placed") {
                $ordersView .= "<button type='submit'  name='action' value='Confirmed'>Confirm</button>";
                $ordersView .= "<button type='submit'  name='action' value='Canceled'>Cancel</button>";
            } elseif ($status =="Confirmed") {
                $ordersView .= "<button type='submit'  name='action' value='Shipped'>Ship</button>";
                $ordersView .= "<button type='submit'  name='action' value='Canceled'>Cancel</button>";
            } elseif ($status =="Shipped") {
                $ordersView .= "<button type='submit'  name='action' value='Delivered'>Deliver</button>";
                $ordersView .= "<button type='submit'  name='action' value='Canceled'>Cancel</button>";
            } else {
                $ordersView .= "";
            }
          }else{
            $ordersView .= "<button type='submit'  name='action' value='Canceled'>Cancel</button>";

          }
          $ordersView .= "</form >";
        }


    } else {
        $ordersView .= "You haven't placed any orders!";
    }
} else {
    echo "Problem with the order id";
}






echo $ordersView;



?>



</body>
</html>
