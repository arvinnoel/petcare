<?php
session_start();
include "dbconn.php";

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
{
  header("location: index.php");
  exit;
}

$user_id = $_SESSION['user_id'];

# ADD TO CART LOGIC
if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];

    $product_query = "SELECT * FROM products WHERE product_id='$product_id'";
    $product_result = mysqli_query($con,$product_query);
    $product = mysqli_fetch_assoc($product_result);

    $product_name = $product['product_name'];
    $price = $product['price'];
    $description = $product['description'];
    $image = $product['image'];
    $category = $product['category'];

    $insert = "INSERT INTO cart (user_id, product_id, product_name, price, description, image, category)
               VALUES ('$user_id','$product_id','$product_name','$price','$description','$image','$category')";

    mysqli_query($con,$insert);
}

# CATEGORY FILTER
$category = "";

if(isset($_GET['category'])){
    $category = $_GET['category'];
}

if($category != ""){
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

.vertical-navbar{
width:220px;
background:#333;
min-height:100vh;
}

.vertical-navbar ul{
list-style:none;
padding:0;
margin:0;
}

.vertical-navbar ul li{
border-bottom:1px solid #444;
}

.vertical-navbar ul li a{
display:block;
padding:12px 15px;
color:white;
text-decoration:none;
}

.vertical-navbar ul li a:hover{
background:#575757;
}

.dropdown-content{
display:none;
background:#444;
}

.dropdown-content a{
padding:10px 20px;
display:block;
color:white;
}

.dropdown:hover .dropdown-content{
display:block;
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
height:350px;
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

.product-info button{
padding:8px 12px;
margin:5px;
border:none;
background:#2e7d32;
color:white;
border-radius:4px;
cursor:pointer;
}

.product-info button:hover{
background:#1b5e20;
}

</style>
</head>

<body>

<?php require('header.php'); ?>

<div class="container">

<!-- Sidebar -->
<nav class="vertical-navbar">
<ul>

<li><a href="accessories.php?category=dogfood">Dog Food</a></li>
<li><a href="accessories.php?category=catfood">Cat Food</a></li>

<li class="dropdown">
<a href="#">Accessories</a>
<div class="dropdown-content">
<a href="accessories.php?category=bows">Bows & Bandanas</a>
<a href="accessories.php?category=beds">Beds & Mats</a>
<a href="accessories.php?category=bowls">Bowls & Feeders</a>
<a href="accessories.php?category=apparels">Apparels</a>
<a href="accessories.php?category=toys">Toys</a>
<a href="accessories.php?category=leash">Leashes, Collars & Harness</a>
</div>
</li>

<li class="dropdown">
<a href="#">Healthcare</a>
<div class="dropdown-content">
<a href="accessories.php?category=grooming">Grooming Supplies</a>
<a href="accessories.php?category=fleas">Fleas & Ticks</a>
<a href="accessories.php?category=training">Training & Cleaning</a>
</div>
</li>

</ul>
</nav>

<div class="accessories-content">

<h1>Pet Products</h1>
<p>Discover a wide range of nutritious options for your furry friend.</p>

<div class="acc-list">

<?php
while($row = mysqli_fetch_assoc($result)){
?>

<div class="product-card">

<img src="admin/db_img/<?php echo $row['image']; ?>" alt="Product Image">

<div class="product-info">

<h2>₹ <?php echo $row['price']; ?></h2>

<p><?php echo $row['product_name']; ?></p>

<form method="POST">
<input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
<button type="submit" name="add_to_cart">Add to Cart</button>
</form>

</div>

</div>

<?php
}
?>

</div>

</div>

</div>

<?php require('footer.php'); ?>

</body>
</html>