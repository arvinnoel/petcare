<?php
session_start();
include "dbconn.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
  header("location: index.php");
  exit;
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['remove'])){
    $cart_id = $_GET['remove'];
    mysqli_query($con,"DELETE FROM cart WHERE id='$cart_id'");
}

if(isset($_POST['place_order'])){

    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $cart_query = mysqli_query($con,"SELECT * FROM cart WHERE user_id='$user_id'");

    while($row = mysqli_fetch_assoc($cart_query)){

        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $price = $row['price'];

        mysqli_query($con,"INSERT INTO orders(user_id,product_id,product_name,price,phone,address,payment_method)
        VALUES('$user_id','$product_id','$product_name','$price','$phone','$address','Cash on Delivery')");
    }

    mysqli_query($con,"DELETE FROM cart WHERE user_id='$user_id'");

    echo "<script>alert('Order Placed Successfully');</script>";
}

$sql = "SELECT * FROM cart WHERE user_id='$user_id'";
$result = mysqli_query($con,$sql);

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>My Cart</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
}

.cart-container{
    width:80%;
    margin:auto;
    margin-top:40px;
}

.cart-item{
    background:white;
    padding:15px;
    margin-bottom:10px;
    display:flex;
    align-items:center;
    gap:20px;
    border-radius:6px;
}

.cart-item img{
    width:80px;
    height:80px;
    object-fit:cover;
}

.remove-btn{
    background:red;
    color:white;
    border:none;
    padding:6px 10px;
    cursor:pointer;
}

.buy-btn{
    background:#2e7d32;
    color:white;
    border:none;
    padding:8px 12px;
    cursor:pointer;
}

.order-form{
    background:white;
    padding:20px;
    margin-top:20px;
}

.order-form input,
.order-form textarea{
    width:100%;
    padding:8px;
    margin-bottom:10px;
}

</style>

</head>

<body>

<?php require('header.php'); ?>

<h1 style="text-align:center;">Shopping Cart</h1>

<div class="cart-container">

<?php

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

$total += $row['price']; 

?>

<div class="cart-item">

<img src="admin/db_img/<?php echo $row['image']; ?>">

<div>

<h3><?php echo $row['product_name']; ?></h3>

<p>Price : ₹ <?php echo $row['price']; ?></p>

<a href="cart.php?remove=<?php echo $row['id']; ?>">
<button class="remove-btn">Remove</button>
</a>

</div>

</div>

<?php
}
?>

<div class="order-form">

<h2>Cash on Delivery</h2>

<form method="POST">

<input type="text" name="phone" placeholder="Enter Phone Number" required>

<textarea name="address" placeholder="Enter Delivery Address" required></textarea>

<h3>Total : ₹ <?php echo $total; ?></h3>

<button class="buy-btn" type="submit" name="place_order">Buy Now</button>

</form>

</div>

<?php

}else{
echo "<p style='text-align:center;'>Your cart is empty</p>";
}

?>

</div>

</body>
</html>