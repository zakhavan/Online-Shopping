<?php
$msg = "";
require_once 'Includes/connection.php';
include 'header.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("location: profile.php?msg=You cannot access Add_products page!");
}
$hasError = false;
$desciption = "";
$prod_name="";
$category="";
$quantity=1;
$pid=null;
$supp_id=1;
$price=1;

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    //empty fields
    if (isset($_POST['add']) || isset($_POST['update'])) {
        if (empty($_POST['product_name'])) {
            $msg .= "Please enter product name!<br>";
            $hasError = true;
        }

        if (empty($_POST['category'])) {
            $msg .= "Please enter category!<br>";
            $hasError = true;
        }

        if (empty($_POST['description']) || strlen($_POST['description']) <5) {
            $msg .= "Description should be at least 5 characters!<br>";
            $hasError = true;
        }

        if ($hasError == false) {
            if (isset($_POST['update'])) {
                $stmt = $conn->prepare("UPDATE Products SET ProductName=?, Description=?,ProductType=?,Stock=?,Price=?,supplier_id=? WHERE ProductID =?");
                $stmt->bind_param("sssiiii", $_POST['product_name'], $_POST['description'], $_POST['category'], $_POST['quantity'], $_POST['price'], $_POST['supplier'], $_POST['product_id']);
                if ($stmt->execute()) {
                    $msg.= "Updated sucessfully!";
                    header("location: index.php?msg=$msg");

                } else {
                    echo $stmt->error;
                    $msg.= "Failed!!";
                }
            } else {
                $stmt = $conn->prepare("INSERT INTO Products(ProductName,Description,ProductType,Stock,Price,supplier_id) VALUES(?,?,?,?,?,?)");
                $stmt->bind_param("sssiii", $_POST['product_name'], $_POST['description'], $_POST['category'], $_POST['quantity'], $_POST['price'], $_POST['supplier']);
                if ($stmt->execute()) {
                    $msg.= "Added sucessfully!";
                    header("location: index.php?msg=$msg");

                } else {
                    echo $stmt->error;
                    $msg.= "Failed!!";
                }
            }
        }
    }
    if (isset($_POST['edit'])) {
        $stmt = $conn->prepare("SELECT * FROM Products WHERE ProductID = ?");
        $stmt->bind_param("i", $_POST['edit']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $row = fetchAssocStatement($stmt)
            $desciption = $row['Description'];
            $prod_name=$row['ProductName'];
            $category=$row['ProductType'];
            $quantity=$row['Stock'];
            $supp_id=$row['supplier_id'];
            $price = $row['Price'];
            $pid=$row['ProductID'];
        } else {
            $msg .= "Error removing product!";
        }
    }
}

$stmt = $conn->prepare("SELECT * FROM Suppliers");
$stmt->execute();
$supplierResult = $stmt->get_result();

?>

<?php if (strlen($msg)>0) {
    echo $msg;
}?>


<form action="<?php echo $site_root;?>/add_product.php" method="post">
  Product Name:
  <input type="hidden" name="product_id" value="<?php echo $pid;?>">
  <input type="text" name="product_name" value="<?php echo $prod_name;?>"><br>
  Category:
  <input type="text" name="category" value="<?php echo $category;?>"><br>
  Description:
  <textarea name = 'description'> <?php echo $desciption;?> </textarea><br>

  Quantity:
  <input type="number" name="quantity" value="<?php echo $quantity;?>" ><br>
  Price:
  <input type="number" name="price" value="<?php echo $price;?>" ><br>

  Supplier :<select name='supplier'>
  <?php
        // $first = true;
      while ($row = $supplierResult->fetch_assoc()) {
          echo  "<option value=".$row['SupplierID'] ." ". ($supp_id ==$row['SupplierID'] ? 'selected' : ' ') .">".$row['SupplierName']."</option>";
      }
      echo "</select>";
      if (isset($_POST['edit'])) {
          echo '<input type="submit" name="update" value="Update">';
      } else {
          echo '<input type="submit" name="add" value="Add">';
      }
  ?>



</form>
