<?php 
// Initialize the session

include 'header.php';
require_once 'Includes/connection.php';

$msg="";
 
if(!empty($_GET['msg']) )
{
    $msg = $_GET['msg'];
}


$productID=1;
 
if(!empty($_GET['id']))
{
    $productID = $_GET['id'];
}


if($_SERVER['REQUEST_METHOD'] =='POST'){
    if(!empty($_POST['review']))
    {
        $review = htmlspecialchars($_POST['review']);
        if(strlen($review) < 5) {
        $msg.= "Review is too short<br>";
        }
        else{
            $stmt = $conn->prepare("INSERT INTO Reviews(member_id,product_id,Message) VALUES(?,?,?)");
            $stmt->bind_param("iis", $_SESSION['memberID'],$productID,$review);
            if($stmt->execute()){
            $msg.= "Inserted sucessfully!";
            }else{
                $msg.= "Failed!!";
            } 
        }
    }
}

$stmt = $conn->prepare("SELECT p.ProductID,p.ProductName,p.ProductType,p.Description,p.Stock,p.Price,s.SupplierID,s.SupplierName,s.Phone FROM Products AS p JOIN Suppliers AS s WHERE p.supplier_id = s.SupplierID AND ProductID = ?");
$stmt->bind_param("i",$productID);
$stmt->execute();
$result = $stmt->get_result();
$productView="";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $productView .= " Product Name : ".$row['ProductID']."<br>";
    $productView .= " Product Name : ".$row['ProductType']."<br>";
    $productView .= " Product Name : ".$row['ProductName']."<br>";
       $productView .= " Product Name : ".$row['Description']."<br>";
          $productView .= " Product Name : ".$row['Stock']."<br>";
             $productView .= " Product Name : ".$row['Price']."<br>";
}else{
    $productView .="Error retriving the product!"
}





?>

<html>
<title>Product Name </title>
<head>
</head>
<body>

<?php if(strlen($msg)>0){
    echo $msg;
}?> 


<?php if(strlen($msg)>0){
    echo $msg;
}?> 

Review:
<form action="/CS564/product.php?id=<?php echo $productID;?>" method="post" id = 'reviewForm'>
<textarea name = 'review' ></textarea>

  <input type="submit" value="Submit">
</form> 


</body>
</html>