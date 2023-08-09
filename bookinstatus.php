<?php
if(!isset($_COOKIE["user"])) {
  header('Location: homepage.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKING STATUS</title>
</head>
<body>
<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: url("images/carbg2.jpg") center/cover;
    font-family: Arial, sans-serif;
}

ul {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
}

ul li {
    list-style: none;
    font-size: 20px;
    color: #fff;
}

.utton {
    background: #ff7200;
    border: none;
    font-size: 18px;
    border-radius: 5px;
    cursor: pointer;
    color: #fff;
    transition: 0.4s ease;
    padding: 10px 20px;
    text-decoration: none;
}

.utton:hover {
    background: #e65a00;
}

.name {
    font-weight: bold;
    font-size: 22px;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.box {
    margin: 50px auto;
    padding: 20px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    width: 80%;
    display: flex;
    align-items: center;
}

.box .imgBx {
    width: 150px;
    flex: 0 0 150px;
    margin-right: 20px;
}

.box .imgBx img {
    max-width: 100%;
    border-radius: 8px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.3);
}

.box .content {
    flex: 1;
}

.box h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.box h1:last-child {
    margin-bottom: 0;
}






</style>



<?php
    require_once('connection.php');
    session_start();
    $email = $_COOKIE['user'];

    $sql="select * from booking where EMAIL='$email' order by BOOK_ID DESC LIMIT 1";
    $name = mysqli_query($con,$sql);
    $rows=mysqli_fetch_assoc($name);
    if($rows==null){
        echo '<script>alert("THERE ARE NO BOOKING DETAILS")</script>';
        echo '<script> window.location.href = "cardetails.php";</script>';
    }
    else{
    $sql2="select * from users where EMAIL='$email'";
    $name2 = mysqli_query($con,$sql2);
    $rows2=mysqli_fetch_assoc($name2);
    $car_id=$rows['CAR_ID'];
    $sql3="select * from cars where CAR_ID='$car_id'";
    $name3 = mysqli_query($con,$sql3);
    $rows3=mysqli_fetch_assoc($name3);





?>
   <ul>
    <li><button class="utton"><a href="cardetails.php">Go to Home</a></button></li>
    <li class="name">HELLO! <?php echo $rows2['FNAME']." ".$rows2['LNAME']?></li>
</ul>

<div class="box">
    <div class="imgBx">
        <img src="images/<?php echo $rows3['CAR_IMG']?>">
    </div>
    <div class="content">
        <h1>CAR NAME : <?php echo $rows3['CAR_NAME']?></h1><br>
        <h1>NO OF DAYS : <?php echo $rows['DURATION']?></h1><br>
        <h1>BOOKING STATUS : <?php echo $rows['BOOK_STATUS']?></h1><br>
    </div>
</div>



<?php }
?>
    
</body>
</html>