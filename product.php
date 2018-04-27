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
 
 if(!empty($_GET['msg']) )
{
$msg = $_GET['msg'];
}


$page=1;
 
 if(!empty($_GET['page']))
{
	$page = $_GET['page'];
}

 
/*
// If session variable is not set it will redirect to login page

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){

  header("location: login.php");

  exit;

}
*/
// query database for products
$numItems = 10;
$offset = ($page-1) * $numItems;
$orderBy = "Price";
$stmt = $conn->prepare("SELECT count(*) AS numProducts FROM Products");
$stmt->execute();
$result = $stmt->get_result();
$maxProducts = 0;
while($row = $result->fetch_assoc()) {
    $maxProducts =$row['numProducts'];
}

$numPages = ceil($maxProducts / $numItems); 




print_r($result,true);
$stmt = $conn->prepare("SELECT * FROM Products ORDER BY ? LIMIT ? OFFSET ?");
$stmt->bind_param("sii", $orderBy, $numItems, $offset );

// set parameters and execute
$productsView ="";
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
	$productsView .= "<table><tr>   <th>ProductName</th>   <th>Description</th>  <th>Stock</th> <th>Price</th> </tr>";
			$productsView .= "<form action='/CS564/cart.php' method='post'><tr>";

    while($row = $result->fetch_assoc()) {
		$productsView .= "<th>".$row['ProductName']."</th> ";
		$productsView .= "<th>".$row['Description']."</th> ";
		$productsView .= "<th>".$row['Stock']."</th> ";
		$productsView .= "<th>".$row['Price']."</th> ";
		$productsView .= "<th><button type='submit' name='add' value=".$row['ProductID'].">Buy</button></th></tr> ";
	}
	$productsView .= "</form></table>";
	for ($i=0;$i < $numPages; $i++) {
            $p = $i+1;
            $productsView.="<a href='/CS564/product.php?page=$p'> $p</a>";
	}
    }


echo $productsView;

echo "Total number of Products are $maxProducts";
?>
</body>
 </html>
 

 
 