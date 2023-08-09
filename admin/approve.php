<?php
if(!isset($_COOKIE["admin"])) {
  header('Location: adminlogin.php');
}
?>
<?php
require_once('../connection.php');

$bookid = $_GET['id'];

// Get booking information
$query = "SELECT * FROM booking WHERE BOOK_ID = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $bookid);
$stmt->execute();
$result = $stmt->get_result();
$res = $result->fetch_assoc();

$car_id = $res['CAR_ID'];

// Get car information
$query2 = "SELECT * FROM cars WHERE CAR_ID = ?";
$stmt2 = $con->prepare($query2);
$stmt2->bind_param("i", $car_id);
$stmt2->execute();
$carres = $stmt2->get_result();
$carresult = $carres->fetch_assoc();

$email = $res['EMAIL'];
$carname = $carresult['CAR_NAME'];

if ($carresult['AVAILABLE'] == 'Y') {
    if ($res['BOOK_STATUS'] == 'APPROVED' || $res['BOOK_STATUS'] == 'RETURNED') {
        echo '<script>alert("ALREADY APPROVED")</script>';
        echo '<script>window.location.href = "adminbook.php";</script>';
    } else {
        $query3 = "UPDATE booking SET BOOK_STATUS = 'APPROVED' WHERE BOOK_ID = ?";
        $stmt3 = $con->prepare($query3);
        $stmt3->bind_param("i", $bookid);
        $stmt3->execute();
        
        $query4 = "UPDATE cars SET AVAILABLE = 'N' WHERE CAR_ID = ?";
        $stmt4 = $con->prepare($query4);
        $stmt4->bind_param("i", $res['CAR_ID']);
        $stmt4->execute();
        
        echo '<script>alert("APPROVED SUCCESSFULLY")</script>';
        echo '<script>window.location.href = "adminbook.php";</script>';
    }
} else {
    echo '<script>alert("CAR IS NOT AVAILABLE")</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
}
?>
