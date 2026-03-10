<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>header</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>

/* GLOBAL */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    overflow-x:hidden;
}

/* NAVBAR */
.navbar{
    width:100%;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:#008080;
    padding:10px 5%;
    flex-wrap:wrap;
}

/* LOGO */
.logo img{
    width:120px;
}

/* MENU */
.navbar ul{
    list-style:none;
    display:flex;
    align-items:center;
    gap:25px;
}

.navbar li{
    position:relative;
}

.navbar li a{
    text-decoration:none;
    color:white;
    font-size:16px;
}

/* HOVER LINE */
.navbar ul li .line::after{
    content:"";
    position:absolute;
    background-color:rgb(244,141,74);
    height:3px;
    width:0;
    left:50%;
    bottom:-8px;
    transform:translateX(-50%);
    transition:0.3s;
}

.navbar li:hover a::after{
    width:100%;
}

/* ICONS */
.cart{
    width:35px;
    margin-left:15px;
    filter:brightness(0) invert(1);
}

.pro{
    width:35px;
    margin-left:15px;
    filter:brightness(0) invert(1);
}

/* LOGIN / LOGOUT BUTTON */
.login button,
.logout button{
    margin-left:15px;
    padding:8px 16px;
    background:rgb(246,158,100);
    border:none;
    border-radius:10px;
    font-weight:500;
    cursor:pointer;
    transition:0.3s;
}

.login button:hover,
.logout button:hover{
    background:rgb(241,124,45);
}

/* MOBILE RESPONSIVE */
@media (max-width:900px){

    .navbar{
        flex-direction:column;
        align-items:flex-start;
    }

    .navbar ul{
        flex-direction:column;
        width:100%;
        margin-top:10px;
        gap:10px;
    }

    .cart,
    .pro{
        margin-top:10px;
    }

}

</style>

</head>

<body>

<nav class="navbar">
<div class="logo">
<a href="index.php"><img src="img/logo.png" alt="logo"></a>
</div>

<ul>
<li><a href="index.php" class="line">HOME</a></li>
<li><a href="adoption.php" class="line">ADOPTION</a></li>
<li><a href="accessories.php" class="line">ACCESSORIES</a></li>
<li><a href="donate.php" class="line">DONATE</a></li>
<li><a href="resources.php" class="line">PET CARE</a></li>
<li><a href="about.php" class="line">ABOUT</a></li>
<li><a href="cart.php" class="line">CART</a></li>
</ul>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
echo "<a href='pet-cart.php'><img class='cart' src='img/cartn.png'></a>";
echo "<a href='profile.php'><img class='pro' src='img/add_pet1.png'></a>";
echo "<div class='logout'><button onclick=\"document.location='logout.php'\">LOGOUT</button></div>";
}
else
{
echo "<div class='login'><button onclick=\"document.getElementById('signInModal').style.display='block'\">LOGIN</button></div>";
}
?>

</nav>

<?php require('signup.php'); ?>
<?php require('login.php'); ?>

</body>
</html>