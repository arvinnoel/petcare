<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adoption Form Data Report</title>

<style>

body{
    margin:0;
    font-family: Arial, Helvetica, sans-serif;
    background:#f5f5f5;
}


h2{
    margin-bottom:20px;
    color:#2c3e50;
}


table{
    width:100%;
    border-collapse:collapse;
    background:white;
}

th, td{
    padding:10px;
    border:1px solid #ddd;
    text-align:center;
    font-size:14px;
}

th{
    background:#008080;
    color:white;
}

tr:nth-child(even){
    background:#f9f9f9;
}


@media (max-width:900px){

.container2{
    margin-left:0;
    padding:15px;
}

h2{
    text-align:center;
}

table, thead, tbody, th, td, tr{
    display:block;
    width:100%;
}

thead{
    display:none;
}

tr{
    margin-bottom:15px;
    background:white;
    padding:10px;
    border-radius:6px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

td{
    text-align:right;
    padding:10px;
    position:relative;
}

td::before{
    content: attr(data-label);
    position:absolute;
    left:10px;
    font-weight:bold;
    text-align:left;
}

}

</style>

</head>

<body>

<?php require('admin-nav.php'); ?>

<div class="container2">

<h2>Adoption Form Data Report</h2>

<table>

<thead>
<tr>
    <th>Form ID</th>
    <th>User ID</th>
    <th>Pet ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Mobile No.</th>
    <th>Address</th>
    <th>Other Pets</th>
    <th>Adoption Reason</th>
    <th>Budget For Care</th>
    <th>Comments</th>
    <th>Submission Date</th>
</tr>
</thead>

<tbody>

<?php

include '../dbconn.php';

$query = "SELECT * FROM adoption_form";
$result = mysqli_query($con, $query);

if ($result) {

while ($row = mysqli_fetch_assoc($result)) {

echo "<tr>";

echo "<td data-label='Form ID'>{$row['id']}</td>";
echo "<td data-label='User ID'>{$row['user_id']}</td>";
echo "<td data-label='Pet ID'>{$row['pet_id']}</td>";
echo "<td data-label='Full Name'>{$row['fullName']}</td>";
echo "<td data-label='Email'>{$row['email']}</td>";
echo "<td data-label='Mobile No.'>{$row['phone']}</td>";
echo "<td data-label='Address'>{$row['address']}</td>";
echo "<td data-label='Other Pets'>{$row['otherPets']}</td>";
echo "<td data-label='Adoption Reason'>{$row['adoptionMotivation']}</td>";
echo "<td data-label='Budget For Care'>{$row['budgetForCare']}</td>";
echo "<td data-label='Comments'>{$row['comments']}</td>";
echo "<td data-label='Submission Date'>{$row['submissionDate']}</td>";

echo "</tr>";

}

} else {

echo "<tr><td colspan='12'>Error fetching data</td></tr>";

}

mysqli_close($con);

?>

</tbody>

</table>

</div>

</body>
</html>