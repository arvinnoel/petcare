<?php
include "dbconnection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    $folder = "db_img/".$image;

    move_uploaded_file($temp_name, $folder);

    $sql = "INSERT INTO products(product_name,price,description,image,category)
            VALUES('$product_name','$price','$description','$image','$category')";

    if(mysqli_query($con,$sql)){
        echo "Product added successfully";
    }else{
        echo "Error: ".mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
<style>
body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}

h2{
    text-align:center;
    margin-top:30px;
}

.main{
    display:flex;
    justify-content:center;
    align-items:center;
    margin-top:0;
}

.form{
    background:white;
    padding:30px;
    width:350px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    display:flex;
    flex-direction:column;
    gap:10px;
}

.form label{
    font-weight:bold;
}

.form input,
.form textarea{
    padding:8px;
    border:1px solid #ccc;
    border-radius:4px;
    font-size:14px;
}

.form textarea{
    resize:none;
    height:80px;
}

.form input:focus,
.form textarea:focus{
    outline:none;
    border-color:#007bff;
}

button{
    margin-top:10px;
    padding:10px;
    border:none;
    border-radius:5px;
    background:#007bff;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#0056b3;
}
</style>
</head>
<body>

<?php require('admin-nav.php'); ?>

<h2 style="display:flex; flex-direction:row; justify-content:center;align-items:center">Add Product</h2>
<div class="main">
    <form method="POST" class="form" enctype="multipart/form-data">

        <label for="pname">Product Name</label>
        <input type="text" name="product_name" placeholder="Enter product name" required>

        <label for="price">Price</label>
        <input type="number" name="price" placeholder="Enter the price" required>

        <label for="desc">Description</label>
        <textarea name="description" placeholder="Enter description"></textarea>
        <label>Category</label>
        <select name="category" required>

        <option value="">Select Category</option>

        <option value="dogfood">Dog Food</option>
        <option value="catfood">Cat Food</option>

        <option value="bows">Bows & Bandanas</option>
        <option value="beds">Beds & Mats</option>
        <option value="bowls">Bowls & Feeders</option>
        <option value="apparels">Apparels</option>
        <option value="toys">Toys</option>
        <option value="leash">Leashes, Collars & Harness</option>

        <option value="grooming">Grooming Supplies</option>
        <option value="fleas">Fleas & Ticks</option>
        <option value="training">Training & Cleaning</option>

        </select>
        <label for="file">Product Image</label>
        <input type="file" name="image" required>

        <button type="submit">Add Product</button>

</form>
</div>
</body>
</html>