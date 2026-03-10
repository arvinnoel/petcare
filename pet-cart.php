<?php
session_start();

include 'dbconn.php';

$user_id = $_SESSION['user_id'];
$pet_id_query = "SELECT pet_id FROM adoption_form WHERE user_id = '$user_id'";
$result = mysqli_query($con, $pet_id_query);

$pets = [];
while ($row = mysqli_fetch_assoc($result)) {
    $pet_id = $row['pet_id'];
    $pet_query = "SELECT p.*, u.mob AS owner_phone FROM pets p 
                JOIN users u ON p.user_id = u.user_id
                WHERE p.pet_id = '$pet_id'";;
    $pet_result = mysqli_query($con, $pet_query);
    $pet = mysqli_fetch_assoc($pet_result);
    if ($pet) {
        $pets[] = $pet;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins', sans-serif;
}

body{
    background:#f4f6f7;
}

header{
    background:#5d87d8;
    color:white;
    text-align:center;
    padding:25px 10px;
    margin-bottom:30px;
}

header h2{
    font-size:28px;
}

.pet-list{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
    padding:20px;
    max-width:1200px;
    margin:auto;
}

.pet-profile{
    background:white;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
    transition:0.3s;
    width: fit-content;
}

.pet-profile:hover{
    transform:translateY(-5px);
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

.pet-profile img{
    width:100%;
    height:220px;
    object-fit:cover;
}

.pro-desc{
    padding:18px;
    font-size:15px;
    line-height:1.7;
}

.pro-desc strong{
    color:#333;
}

@media (max-width:768px){

header h2{
    font-size:24px;
}

.pet-profile img{
    height:200px;
}

}

/* Mobile */
@media (max-width:480px){

header{
    padding:20px 5px;
}

header h2{
    font-size:20px;
}

.pet-list{
    padding:15px;
    gap:18px;
}

.pet-profile img{
    height:180px;
}

.pro-desc{
    font-size:14px;
}

}

</style>
</head>

<body>
    <?php require('header.php'); ?>

    <header>
        <h2>Your Adopted pets</h2>
    </header>

    <div class="pet-list">
        <?php foreach ($pets as $pet) : ?>
        <div class="pet-profile">
            <img src="<?php echo $pet['pet_img']; ?>">
            <div class="pro-desc">
                <strong>Pet Name : </strong>
                <?php echo $pet['pet_name']; ?><br>
                <strong>Pet Type : </strong>
                <?php echo $pet['pet_type']; ?><br>
                <strong>Gender : </strong>
                <?php echo $pet['gender']; ?><br>
                <strong>Breed : </strong>
                <?php echo $pet['breed']; ?><br>
                <strong>Age : </strong>
                <?php echo $pet['age']; ?><br>
                <strong>Vaccination : </strong>
                <?php echo $pet['vaccination']; ?><br>
                <strong>Good with kids : </strong>
                <?php echo $pet['good_with_kids']; ?><br>
                <strong>Owner's Contact No. : </strong>
                <?php echo $pet['owner_phone']; ?><br>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</body>

</html>