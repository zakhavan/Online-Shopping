<html>

<head>


<style>
table, th, td {
   border: 1px solid black;
}

</style>

</head>





<body>

<?php

// Initialize the session

include 'header.php';
require_once 'Includes/connection.php';

$msg="";

if (!empty($_GET['msg'])) {
    $msg = $_GET['msg'];
}

if ($_SERVER['REQUEST_METHOD'] =='POST') {
    if (isset($_POST['remove'])) {
        $stmt = $conn->prepare("DELETE FROM Products WHERE ProductID = ?");
        $stmt->bind_param("i", $_POST['remove']);
        if ($stmt->execute()) {
            $msg .="Product removed sucessfully!";
        } else {
            $msg .= "Error removing product! Product may be in some carts!";
        }
    }
}




$page=1;

if (!empty($_GET['page'])) {
    $page = $_GET['page'];
}
$search="";
if (!empty($_GET['search'])) {
  $msg .= "Showing search results for : ".$_GET['search'];
  $search = "%".$_GET['search']."%";
}

/*
// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

 header("location: login.php");

 exit;

}
*/
$isAdmin = false;
if (isset($_SESSION["role"]) && $_SESSION["role"] == "Admin") {
    $isAdmin =true;
}


// query database for products
$numItems = 10;
$offset = ($page-1) * $numItems;
$orderBy = "Price";
$stmt =null;
if(strlen($search) >1  ){
  $stmt = $conn->prepare("SELECT count(*) AS numProducts FROM Products WHERE ProductType LIKE ? OR Description LIKE ? OR ProductName LIKE ?");
  $stmt->bind_param("sss", $search,$search,$search);
}else{
    $stmt= $conn->prepare("SELECT count(*) AS numProducts FROM Products");
}
$stmt->execute();
$result = $stmt->get_result() ;
$maxProducts = 0;
while ($row = $result->fetch_assoc()) {
    $maxProducts =$row['numProducts'];
}

$numPages = ceil($maxProducts / $numItems);

if(strlen($search) > 0){
  $stmt = $conn->prepare("SELECT * FROM Products WHERE ProductType LIKE ? OR Description LIKE ? OR ProductName LIKE ? ORDER BY ? LIMIT ? OFFSET ?");
  $stmt->bind_param("ssssii",$search,$search,$search, $orderBy, $numItems, $offset);

}else{
  $stmt = $conn->prepare("SELECT * FROM Products ORDER BY ? LIMIT ? OFFSET ?");
  $stmt->bind_param("sii", $orderBy, $numItems, $offset);
}

// set parameters and execute
$productsView ="";
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    $productsView .= "<table><tr>   <th>ProductName</th>   <th>Category</th>  <th>Stock</th> <th>Price</th> <th>Action</th></tr>";
    $productsView .= "<form action='/CS564/cart.php' method='post'>";

    while ($row = $result->fetch_assoc()) {
        $productsView .= "<tr><td><a href='/CS564/product.php?id=".$row['ProductID']."'>".$row['ProductName']."</a></td> ";
        $productsView .= "<td>".$row['ProductType']."</td> ";
        $productsView .= "<td>";
        if ($row['Stock'] > 0) {
            $productsView .=$row['Stock'];
        } else {
            $productsView .="Out of Stock!";
        }
        $productsView.="</td> ";
        $productsView .= "<td>".$row['Price']."</td> ";
        $productsView .= "<td><button type='submit' formaction='/CS564/cart.php' name='add' value=".$row['ProductID']." ". ($row['Stock'] >0 ? " " : "disabled") . ">Buy</button></th>";
        if ($isAdmin ==true) {
            $productsView .= "<td><button type='submit' formaction='/CS564/index.php?page=$page' name='remove' value=".$row['ProductID'].">Remove</button></th>";
            $productsView .= "<td><button type='submit' formaction='/CS564/add_product.php' name='edit' value=".$row['ProductID'].">Edit</button></th>";
        }
        $productsView .= "</tr>";
    }
    $productsView .= "</form></table>";
    for ($i=0;$i < $numPages; $i++) {
        $p = $i+1;
        if(strlen($search) > 0){
          $productsView.="<a href='/CS564/index.php?page=$p&search=".$_GET['search']."'> $p</a>";
        }else{
          $productsView.="<a href='/CS564/index.php?page=$p'> $p</a>";
        }
    }
}

echo $msg;
echo $productsView;

echo "Total number of Products are $maxProducts";
?>
</body>
</html>
