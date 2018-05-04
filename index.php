
<?php

// Initialize the session
require_once 'Includes/connection.php';
include 'header.php';

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
$pageSet =floor($page/10);
$search="";
if (!empty($_GET['search'])) {
  $msg .= "Showing search results for : ".$_GET['search']."<br>";
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
$orderBy = "ProductID";


$stmt =null;
if(strlen($search) >1  ){
  $stmt = $conn->prepare("SELECT count(*) AS numProducts FROM Products WHERE ProductType LIKE ? OR ProductName LIKE ?");
  $stmt->bind_param("ss",$search,$search);
}else{
    $stmt= $conn->prepare("SELECT count(*) AS numProducts FROM Products");
}
$stmt->execute();
$stmt->store_result();
$maxProducts = 0;
while ($row = fetchAssocStatement($stmt)) {
    $maxProducts =$row['numProducts'];
}

$numPages = ceil($maxProducts / $numItems);

if(strlen($search) > 0){
  $stmt = $conn->prepare("SELECT * FROM Products WHERE ProductType LIKE ? OR ProductName LIKE ? ORDER BY ? LIMIT ? OFFSET ?");
  $stmt->bind_param("sssii",$search,$search, $orderBy, $numItems, $offset);

}else{
  $stmt = $conn->prepare("SELECT * FROM Products ORDER BY ? LIMIT ? OFFSET ?");
  $stmt->bind_param("sii", $orderBy, $numItems, $offset);
}

// set parameters and execute
$productsView ="";
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $productsView .= "<table><tr>   <th>ProductName</th>   <th>Category</th>  <th>Stock</th> <th>Price</th> <th>Action</th></tr>";
    $productsView .= "<form action='$site_root/cart.php' method='post'>";

    while ($row = fetchAssocStatement($stmt)) {
        $productsView .= "<tr><td><a href='$site_root/product.php?id=".$row['ProductID']."'>".$row['ProductName']."</a></td> ";
        $productsView .= "<td>".$row['ProductType']."</td> ";
        $productsView .= "<td>";
        if ($row['Stock'] > 0) {
            $productsView .=$row['Stock'];
        } else {
            $productsView .="Out of Stock!";
        }
        $productsView.="</td> ";
        $productsView .= "<td>".$row['Price']."</td> ";
        $productsView .= "<td><button type='submit' formaction='$site_root/cart.php' name='add' value=".$row['ProductID']." ". ($row['Stock'] >0 ? " " : "disabled") . ">Buy</button></th>";
        if ($isAdmin ==true) {
            $productsView .= "<td><button type='submit' formaction='$site_root/index.php?page=$page' name='remove' value=".$row['ProductID'].">Remove</button></th>";
            $productsView .= "<td><button type='submit' formaction='$site_root/add_product.php' name='edit' value=".$row['ProductID'].">Edit</button></th>";
        }
        $productsView .= "</tr>";
    }
    $productsView .= "</form></table>";


    $nextnext = (($pageSet+1)*10)+1;
    $prevprev = (($pageSet)*10)-1;
    if($prevprev >0){
      if(strlen($search) > 0){
        $productsView.="<a href='$site_root/index.php?page=$prevprev&search=".$_GET['search']."'> << </a>";
      }else{
        $productsView.="<a href='$site_root/index.php?page=$prevprev'> <<  </a>";
      }
    }
    if($page!=1){
      $prev = $page-1;
      if(strlen($search) > 0){
        $productsView.="<a href='$site_root/index.php?page=$prev&search=".$_GET['search']."'> < </a>";
      }else{
        $productsView.="<a href='$site_root/index.php?page=$prev'> < </a>";
      }
    }
    $startList = $pageSet*10;
    for ($i=$startList;$i < $nextnext; $i++) {
        $p = $i+1;
        if($page !=$p){
        if(strlen($search) > 0){
          $productsView.="<a href='$site_root/index.php?page=$p&search=".$_GET['search']."'> $p</a>";
        }else{
          $productsView.="<a href='$site_root/index.php?page=$p'> $p</a>";
        }
      }else{
        $productsView.="$p";
      }
    }
    if($numPages > $page){
        $next = $page+1;
        if(strlen($search) > 0){
          $productsView.="<a href='$site_root/index.php?page=$next&search=".$_GET['search']."'> > </a>";
        }else{
          $productsView.="<a href='$site_root/index.php?page=$next'> > </a>";
        }
    }
    if($nextnext > $page){
      if(strlen($search) > 0){
        $productsView.="<a href='$site_root/index.php?page=$nextnext&search=".$_GET['search']."'> >> </a>";
      }else{
        $productsView.="<a href='$site_root/index.php?page=$nextnext'> >> </a>";
      }
    }

}

echo $msg;
echo $productsView;

echo "Total number of Products are $maxProducts";
?>
</body>
</html>
