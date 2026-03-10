<?php
session_start();
include 'dbconn.php';

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
  header("location: index.php");
  exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user_id = $_SESSION["user_id"]; 

    $amount = $_POST["amount"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $sql = "INSERT INTO donations (user_id, amount, name, mail, message)
            VALUES ('$user_id','$amount','$name','$email','$message')";

    if(mysqli_query($con,$sql)){
        echo "Donation Successful";
    }else{
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate</title>
    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#f5f5f5;
}

/* Main container */
.container{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:60px;
    padding:60px 20px;
    flex-wrap:wrap;
}

/* Image section */
.img img{
    width:200px;
    max-width:100%;
}

/* Donation form */
.donation-form{
    width:420px;
    max-width:100%;
    padding:30px;
    border:1px solid #ddd;
    border-radius:8px;
    background-color:#fff;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

h1{
    color:#008080;
    margin-bottom:10px;
}

.desc{
    color:#555;
    margin-bottom:20px;
}

/* Form */
form{
    display:flex;
    flex-direction:column;
}

label{
    margin-top:10px;
    font-weight:500;
}

/* Inputs */
input,
textarea{
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
    width:100%;
    font-size:14px;
}

/* Textarea */
textarea{
    resize:none;
    height:100px;
}

/* Button */
button{
    background-color:#008080;
    color:#fff;
    padding:12px;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-size:16px;
    transition:0.3s;
}

button:hover{
    background-color:#006666;
}

/* Tablet */
@media(max-width:900px){

.container{
    flex-direction:column;
    text-align:center;
}

.img img{
    width:200px;
}

}

/* Mobile */
@media(max-width:500px){

.container{
    padding:40px 15px;
}

.img img{
    width:100px;
}

h1{
    font-size:24px;
}

}

</style>
</head>

<body>
    <?php require('header.php'); ?>

    <div class="container">
        <div class="img">
            <img src="img/donate.png" alt="donate">
        </div>
        <div class="donation-form">
            <h1>Make a Donation</h1>
            <p class="desc">Your support helps us care for more pets in need. Thank you for your generosity!</p>

            <form action="donate.php" method="post">
                <label for="amount">Donation Amount:</label>
                <input type="text" id="amount" name="amount" placeholder="Enter amount">

                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" placeholder="Your full name">

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" placeholder="Your email address">

                <label for="message">Leave a Message (optional):</label>
                <textarea id="message" name="message" placeholder="Your message"></textarea>

                <button type="submit">Donate Now</button>
            </form>
        </div>
    </div>

    <?php require('footer.php'); ?>
</body>

</html>