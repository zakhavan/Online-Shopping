<html>
<head>
<title>Product Name </title>

</head>


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
    if( isset(  $_POST['submitReview']) && !empty($_POST['review'])  )
    {
        $review = htmlspecialchars($_POST['review']);
        if(strlen($review) < 5) {
        $msg.= "Review is too short<br>";
        }
        else{
            $stmt =$conn->prepare("SELECT * FROM Reviews WHERE member_id = ? AND product_id = ? ");
            $stmt->bind_param("ii",$_SESSION['memberID'],$productID);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0){
            
                $stmt = $conn->prepare("UPDATE Reviews SET Message =? WHERE member_id = ? AND product_id = ?");
                $stmt->bind_param("sii",$review, $_SESSION['memberID'],$productID);
                if($stmt->execute()){
                $msg.= "Review Updated sucessfully!";
                }else{
                    print_r($stmt->error_list);
                    $msg.= "Failed to update review!!";
                } 
            }
            else{
                $stmt = $conn->prepare("INSERT INTO Reviews(member_id,product_id,Message) VALUES(?,?,?)");
                $stmt->bind_param("iis", $_SESSION['memberID'],$productID,$review);
                if($stmt->execute()){
                $msg.= "Inserted sucessfully!";
                }else{
                    print_r($stmt->error_list);
                    $msg.= "Failed to write review!!";
                }
            }
        }
    }
    if(isset(  $_POST['rate']) )
    {
     
     $stmt =$conn->prepare("SELECT * FROM Ratings WHERE member_id = ? AND product_id = ? ");
     $stmt->bind_param("ii",$_SESSION['memberID'],$productID);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE Ratings SET Value =? WHERE member_id = ? AND product_id = ?");
        $stmt->bind_param("sii",$_POST['rating'], $_SESSION['memberID'],$productID);
        if($stmt->execute()){
                $msg.= "Rating Updated sucessfully!";
         }else{
             print_r($stmt->error_list);
             $msg.= "Failed to update rating!!";
        } 
    }else{
           
        $stmt = $conn->prepare("INSERT INTO Ratings(member_id,product_id,Value) VALUES(?,?,?)");
        $stmt->bind_param("iis", $_SESSION['memberID'],$productID, $_POST['rating']);
        if($stmt->execute()){
                $msg.= "Rating submitted sucessfully!";
         }else{
             print_r($stmt->error_list);
             $msg.= "Failed to submit rating!!";
        } 
    
    }
    
    }
}

$stmt = $conn->prepare("SELECT p.ProductID,p.ProductName,p.ProductType,p.Description,p.Stock,p.Price,s.SupplierID,s.SupplierName,s.Phone,(SELECT AVG(Value) FROM Ratings as rr WHERE rr.product_id = ? GROUP BY rr.product_id) as avg_rating FROM Products AS p JOIN Suppliers AS s ON p.supplier_id = s.SupplierID WHERE ProductID = ?");
$stmt->bind_param("ii",$productID,$productID);
$stmt->execute();
$result = $stmt->get_result();
$productView="";
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $productView .= " Product ID : ".$row['ProductID']."<br>";
    $productView .= " Product Name : ".$row['ProductName']."<br>";
    $productView .= " Category : ".$row['ProductType']."<br>";
    $productView .= " Description : ".$row['Description']."<br>";
    if($row['Stock'] > 0){
                    
                    $productView .= " Available : ".$row['Stock']."<br>";
		}else{
		$productView .= " Available : Out of Stock!<br>";
		}
    
    $productView .= " Price : ".$row['Price']."<br>";
    $productView .= " Rating : ".$row['avg_rating']."<br>";

    $productView .= " Seller Name : ".$row['SupplierName']."<br>";
    $productView .= " Seller Phone : ".$row['Phone']."<br>";
    $productView .= "<form action='/CS564/cart.php' method='post'>";
    $productView .= "<button type='submit' name='add' value=".$row['ProductID']." ". ($row['Stock'] >0 ? " " : "disabled" ) . ">Buy</button></form>";
}else{
    $productView .="Error retriving the product!";
}

$stmt = $conn->prepare("SELECT u.Username,r.Message FROM Reviews AS r JOIN Users AS u ON r.member_id = u.MemberID WHERE product_id = ?");
$stmt->bind_param("i",$productID);
$stmt->execute();
$result = $stmt->get_result();
$reviewView = "<h1> Reviews</h3>";
 while($row = $result->fetch_assoc()) {
    $reviewView .= "<h3> Reviewer: ".$row['Username']." </h3>";
    $reviewView .= "<p> " .$row['Message'] . "</p>";
 
 }
 
    $ratingVal=0;
    $stmt = $conn->prepare("SELECT * FROM Ratings WHERE member_id = ? AND product_id = ? ");
    $stmt->bind_param("ii",$_SESSION['memberID'],$productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ratingVal=$row['Value'];
    }

$reviewVal="";
    $stmt = $conn->prepare("SELECT * FROM Reviews WHERE member_id = ? AND product_id = ? ");
    $stmt->bind_param("ii",$_SESSION['memberID'],$productID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $reviewVal=$row['Message'];
    }

    
    
    
?>


<body>

<?php if(strlen($msg)>0){
    echo $msg;
}?> 


<?php
    echo $productView;    

    
?> 



<form action="/CS564/product.php?id=<?php echo $productID;?>" method="post" id = 'ratingForm'>
 Rating :<select name="rating"> 
    <option value="0"  <?php if ($ratingVal =='0'){echo 'selected'; } ?>> 0  </option> 
    <option value="1"  <?php if ($ratingVal =='1'){echo 'selected'; } ?> >1</option> 
    <option value="2"  <?php if ($ratingVal =='2'){echo 'selected'; } ?> >2</option> 
    <option value="3"  <?php if ($ratingVal =='3'){echo 'selected'; } ?>>3</option> 
    <option value="4"  <?php if ($ratingVal =='4'){echo 'selected'; } ?>>4</option> 
    <option value="5"  <?php if ($ratingVal =='5'){echo 'selected'; } ?>>5</option> 
</select> 
<input type="submit" name = "rate" value="Rate">
  
</form> 

Review:
<form action="/CS564/product.php?id=<?php echo $productID;?>" method="post" id = 'reviewForm'>
<textarea name = 'review'> <?php echo $reviewVal;?> </textarea>

  <input type="submit" name="submitReview" value="Submit">
</form> 
<?php     echo $reviewView;
 ?>

</body>
</html>