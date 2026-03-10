<?php
session_start();
include "dbconnection.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: index.php");
    exit;
}

# DELETE PRODUCT
if(isset($_GET['delete'])){
    $product_id = intval($_GET['delete']);

    mysqli_query($con,"DELETE FROM products WHERE product_id=$product_id");

    header("Location: products.php");
    exit;
}

# CATEGORY FILTER
if(isset($_GET['category']) && $_GET['category'] != ""){
    $category = mysqli_real_escape_string($con,$_GET['category']);
    $sql = "SELECT * FROM products WHERE category='$category'";
}else{
    $sql = "SELECT * FROM products";
}

$result = mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pet Accessories</title>

<style>

body{
margin:0;
font-family: Arial, Helvetica, sans-serif;
background:#f5f5f5;
}

.container{
display:flex;
width:100%;
}

.accessories-content{
flex:1;
padding:20px;
}

.acc-list{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.product-card{
background:white;
border-radius:8px;
box-shadow:0 2px 8px rgba(0,0,0,0.1);
overflow:hidden;
text-align:center;
padding:10px;
}

.product-card img{
width:100%;
height:180px;
object-fit:cover;
}

.product-info{
padding:10px;
}

.product-info h2{
color:#2e7d32;
margin:5px 0;
}

.product-info p{
font-size:14px;
}

.delete-btn{
display:inline-block;
padding:8px 12px;
margin-top:8px;
background:red;
color:white;
border-radius:4px;
text-decoration:none;
}

.delete-btn:hover{
background:darkred;
}

</style>
</head>

<body>

<?php require('admin-nav.php'); ?>

<div class="accessories-content">

<div class="acc-list">

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<div class="product-card">

<img src="admin/db_img/<?php echo $row['image']; ?>" alt="Product Image">

<div class="product-info">

<h2>₹ <?php echo $row['price']; ?></h2>

<p><?php echo $row['product_name']; ?></p>

<a class="delete-btn"
href="products.php?delete=<?php echo $row['product_id']; ?>"
onclick="return confirm('Delete this product?')">
Remove
</a>

</div>

</div>

<?php
}
?>

</div>

</div>

</body>
</html>