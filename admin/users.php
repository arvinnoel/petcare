<?php
require('admin-nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Data Report</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, Helvetica, sans-serif;
}

body{
    background:#f4f6f8;
}


.main-content{
    flex:1;
    padding:25px;
}


.container2{
    width:100%;
}


h2{
    text-align:center;
    margin-bottom:25px;
    color:#008080;
}


table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
    border-radius:6px;
    overflow:hidden;
}

th{
    background:#008080;
    color:white;
    padding:14px;
    text-align:left;
}

td{
    padding:14px;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f5f5f5;
}


@media (max-width:600px){

table, thead, tbody, th, td, tr{
    display:block;
    width:100%;
}

thead{
    display:none;
}

tr{
    width: 400px;
    margin-bottom:15px;
    background:white;
    padding:10px;
    border-radius:6px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

td{
    padding:10px;
    text-align:right;
    position:relative;
}

td::before{
    position:absolute;
    left:10px;
    font-weight:bold;
    text-align:left;
}

td:nth-of-type(1)::before{content:"User ID";}
td:nth-of-type(2)::before{content:"Username";}
td:nth-of-type(3)::before{content:"Mobile No";}
td:nth-of-type(4)::before{content:"Registration Date";}

}

</style>

</head>

<body>

<div class="main-content">

<div class="container2">
<h2>User Data Report</h2>

<table>
    <thead>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Mobile No.</th>
        <th>Registration Date & Time</th>
    </tr>
    </thead>

<tbody>

<?php

include '../dbconn.php';

$query = "SELECT * FROM users";
$result = mysqli_query($con, $query);

if ($result) {

while ($row = mysqli_fetch_assoc($result)) {

echo "<tr>";
echo "<td>{$row['user_id']}</td>";
echo "<td>{$row['username']}</td>";
echo "<td>{$row['mob']}</td>";
echo "<td>{$row['registration_date_time']}</td>";
echo "</tr>";

}

} else {

echo "<tr><td colspan='4'>Error fetching user data</td></tr>";

}

mysqli_close($con);

?>

</tbody>
</table>

</div>

</div>

</body>
</html>