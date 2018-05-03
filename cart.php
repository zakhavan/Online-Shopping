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



if ($_SERVER['REQUEST_METHOD'] =='POST') {
    if (isset($_POST['add'])) {
        $stmt = $conn->prepare("SELECT Quantity FROM Carts WHERE product_id = ? AND member_id = ?");
        $stmt->bind_param("ii", $_POST['add'], $_SESSION['memberID']);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $quantity = $row['Quantity']+1;
            $stmt = $conn->prepare("UPDATE Carts SET Quantity = ? WHERE product_id = ? AND member_id = ?");
            $stmt->bind_param("iii", $quantity, $_POST['add'], $_SESSION['memberID']);
            if ($stmt->execute()) {
                $msg.= "Inserted sucessfully!";
            } else {
                $msg.= "Failed!!";
            }
        } else {
            $stmt = $conn->prepare("INSERT INTO Carts(member_id,product_id,Quantity) VALUES(?,?,1)");
            $stmt->bind_param("ii", $_SESSION['memberID'], $_POST['add']);
            if ($stmt->execute()) {
                $msg.= "Inserted sucessfully!";
            } else {
                $msg.= "Failed!!";
            }
        }
    }
    if (isset($_POST['remove'])) {
        $stmt = $conn->prepare("DELETE FROM Carts WHERE product_id = ? AND member_id = ?");
        $stmt->bind_param("ii", $_POST['remove'], $_SESSION['memberID']);
        if ($stmt->execute()) {
            $msg.= "Removed sucessfully!";
        } else {
            $msg.= "Failed!!";
        }
    }
}

$stmt = $conn->prepare("SELECT  * FROM Addresses WHERE customer_id = ?");
$stmt->bind_param("i", $_SESSION['memberID']);
$stmt->execute();
$result = $stmt->get_result();
$addresses = [];
while ($row = $result->fetch_assoc()) {
    $addresses[$row['AddressID']] = $row['Address'];
}

$stmt = $conn->prepare("SELECT p.ProductID,p.ProductName,p.Price,c.Quantity,(p.Price * c.Quantity) AS total_price,(SELECT SUM(pp.Price * cc.Quantity) FROM Carts AS cc LEFT JOIN Products AS pp on cc.product_id=pp.ProductID WHERE cc.member_id=? GROUP BY member_id) as total FROM Carts AS c LEFT JOIN Products AS p on c.product_id=p.ProductID WHERE c.member_id=?");
$stmt->bind_param("ii", $_SESSION['memberID'], $_SESSION['memberID']);
$stmt->execute();
 $result = $stmt->get_result();
 $cartView= "<table><tr>   <th>ProductName</th>   <th>Quantity</th>  <th>Unit Price</th> <th>Total Price</th> </tr>";
$cartView .= "<form action='/CS564/cart.php' method='post'>";
$total =0;
  while ($row = $result->fetch_assoc()) {
      $cartView .= "<tr><td>".$row['ProductName']."</td> ";
      $cartView .= "<td>".$row['Quantity']."</td> ";
      $cartView .= "<td>".$row['Price']."</td> ";
      $cartView .= "<td>".$row['total_price']."</td> ";
      $total =$row['total'];

      $cartView .= "<td><button type='submit' name='remove' value=".$row['ProductID'].">Remove</button></td></tr> ";
  }

    $cartView.="</form>";
    $cartView.="</table>";
    $cartView.="Total cart value is $" .$total;
    $cartView.= "<form action='/CS564/transaction.php' method='post'><input name='total' type='hidden' value='". $total . "' disabled/>";
    if (count($addresses) == 0) {
        $cartView .= "Please add an address before placing order";
        $cartView.=" <a href='/CS564/add_address.php'>Add a new address</a>";
        $cartView .="<button type='submit' name ='checkout' value='checkout' disabled> Checkout </button>";
    } else {
        $cartView .=" Select Address :<select name='address'>";
        $first = true;
        foreach ($addresses as $aID => $address_val) {
            $cartView .= "<option value=$aID  ($first ? 'selected' : ' ') > $address_val  </option>";
            $first = false;
        }
        $cartView .= "</select>";
        $cartView .="<button type='submit' name ='checkout' value='checkout' > Checkout </button>";
    }

?>

<?php if (strlen($msg)>0) {
    echo $msg;
}?>


<?php  echo $cartView;
?>
</body>
</html>
