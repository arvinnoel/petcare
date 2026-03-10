<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pets Data Report</title>

<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
}


h2{
    margin-bottom:20px;
}
.table-wrapper{
    width:100%;
    overflow-x:auto;
}
table{
    width:100%;
    border-collapse:collapse;
    background:white;
    min-width:900px;
}

th,td{
    padding:8px;
    border:1px solid #ddd;
    text-align:center;
    font-size:14px;
}

th{
    background:#008080;
    color:white;
}

img{
    width:80px;
    height:80px;
    object-fit:cover;
    border-radius:6px;
}

@media screen and (max-width:900px){

.container2{
    margin-left:0;
    padding:15px;
}

h2{
    font-size:20px;
    text-align:center;
}

}

</style>
</head>

<body>

<?php require('admin-nav.php'); ?>

<div class="container2">
<h2>Pets Data Report</h2>

<div class="table-wrapper">

<table>

<tr>
    <th>Pet ID</th>
    <th>Pet Image</th>
    <th>User ID</th>
    <th>Pet Name</th>
    <th>Pet Type</th>
    <th>Breed</th>
    <th>Gender</th>
    <th>Age</th>
    <th>Vaccination</th>
    <th>Good With Kids</th>
    <th>Adoption Status</th>
    <th>Date</th>
</tr>

<?php

include '../dbconn.php';

$query = "SELECT * FROM pets";
$result = mysqli_query($con,$query);

if($result){

while($row=mysqli_fetch_assoc($result)){

echo "<tr>";

echo "<td>{$row['pet_id']}</td>";
echo "<td><img src='../{$row["pet_img"]}'></td>";
echo "<td>{$row['user_id']}</td>";
echo "<td>{$row['pet_name']}</td>";
echo "<td>{$row['pet_type']}</td>";
echo "<td>{$row['breed']}</td>";
echo "<td>{$row['gender']}</td>";
echo "<td>{$row['age']}</td>";
echo "<td>{$row['vaccination']}</td>";
echo "<td>{$row['good_with_kids']}</td>";
echo "<td>{$row['adoption_status']}</td>";
echo "<td>{$row['date']}</td>";

echo "</tr>";

}

}else{

echo "<tr><td colspan='12'>Error fetching pet data</td></tr>";

}

mysqli_close($con);

?>

</table>

</div>
</div>

</body>
</html>