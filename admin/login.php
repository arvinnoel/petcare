<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../dbconn.php';
   
    $admin = $_POST["admin"];
    $password = $_POST["password"];
    $sql = "Select * from admin where admin_name='$admin' AND password='$password'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['admin'] = $row["admin_name"];
        header("location: users.php");
    }
    else{
        echo "
                <script>
                    alert('Invalid Admin name or Password ');
                    window.location.href='login.php';
                </script>
                ";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="admin.css"> -->
     <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#008080,#00a6a6);
}

/* Login box */

.login-container{
    background:white;
    padding:40px;
    width:350px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
    text-align:center;
}

.login-container h2{
    margin-bottom:25px;
    color:#008080;
}

/* Labels */

label{
    display:block;
    text-align:left;
    margin-top:15px;
    font-size:14px;
    font-weight:500;
}

/* Inputs */

input{
    width:100%;
    padding:10px;
    margin-top:6px;
    border:1px solid #ccc;
    border-radius:6px;
    outline:none;
    font-size:14px;
}

input:focus{
    border-color:#008080;
}

/* Button */

.btn-login{
    width:100%;
    padding:10px;
    margin-top:25px;
    border:none;
    border-radius:6px;
    background:#008080;
    color:white;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

.btn-login:hover{
    background:#006666;
}

/* Mobile */

@media (max-width:900px){

.login-container{
    width:90%;
    padding:30px;
}

}

</style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="login.php" method="post">
                <label for="username">Admin Name:</label>
                <input type="text" id="username" name="admin" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>