<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
}

$admin_name = isset($_SESSION['admin']) ? $_SESSION['admin'] : "Admin";
?>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#f4f6f8;
}

/* Top Navbar */

.nav{
    width:100%;
    background:#008080;
    color:white;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 25px;
}

.logo img{
    height:45px;
}

.a{
    display:flex;
    align-items:center;
    gap:15px;
}

.a button{
    padding:7px 15px;
    border:none;
    background:#ff4d4d;
    color:white;
    border-radius:4px;
    cursor:pointer;
}

/* Layout */

.container{
    display:flex;
}

/* Sidebar */

.vertical-navbar{
    width:230px;
    min-height:100vh;
    background:white;
    border-right:1px solid #ddd;
}

.vertical-navbar ul{
    list-style:none;
}

.vertical-navbar ul li{
    padding:12px 20px;
    position:relative;
}

.vertical-navbar ul li a{
    text-decoration:none;
    color:#333;
    font-weight:500;
    display:block;
}

.vertical-navbar ul li:hover{
    background:#f2f2f2;
}

.dropdown-content{
    display:none;
    background:#f9f9f9;
}

.dropdown-content a{
    padding:10px 30px;
    display:block;
    font-size:14px;
}

.dropdown:hover .dropdown-content{
    display:block;
}

.main-content{
    flex:1;
    padding:20px;
}

</style>

<div class="nav">
    <div class="logo">
        <a href="users.php"><img src="../img/logo.png"></a>
    </div>

    <div class="a">
        <h3>Hello <?php echo $admin_name; ?>!</h3>
        <button onclick="document.location='logout.php'">Logout</button>
    </div>
</div>

<div class="container">

<nav class="vertical-navbar">
    <ul>

        <h3 style="text-align:center;margin:15px 0;color:#008080;">ADMIN DASHBORD</h3>

        <li>
            <a href="users.php">Users</a>
        </li>

        <li class="dropdown">
            <a href="pets.php">Pets</a>

            <div class="dropdown-content">
                <a href="pets.php">All Pets</a>
                <a href="available pets.php">Available Pets</a>
                <a href="adopted pets.php">Adopted Pets</a>
            </div>
        </li>

        <li>
            <a href="adoption form.php">Adoption Form</a>
        </li>
        <li>
            <a href="add_products.php">Add products</a>
        </li>
        <li>
             <a href="products.php">Accessories</a>
        </li>

    </ul>
</nav>

<div class="main-content">