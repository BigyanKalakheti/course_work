<?php
if(!isset($_COOKIE["admin"])) {
  header('Location: adminlogin.php');
}
?>
<?php
require_once('../connection.php');

$carid = $_GET['id'];
$book_id = $_GET['bookid'];

// Get booking information
$query2 = "SELECT * FROM booking WHERE BOOK_ID = ?";
$stmt2 = $con->prepare($query2);
$stmt2->bind_param("i", $book_id);
$stmt2->execute();
$result2 = $stmt2->get_result();
$res2 = $result2->fetch_assoc();

// Get car information
$query = "SELECT * FROM cars WHERE CAR_ID = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $carid);
$stmt->execute();
$result = $stmt->get_result();
$res = $result->fetch_assoc();

if ($res['AVAILABLE'] == 'Y') {
    echo '<script>alert("ALREADY CAR IS RETURNED")</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
} else {
    // Update car availability
    $query3 = "UPDATE cars SET AVAILABLE = 'Y' WHERE CAR_ID = ?";
    $stmt3 = $con->prepare($query3);
    $stmt3->bind_param("i", $res['CAR_ID']);
    $stmt3->execute();

    // Update booking status
    $query4 = "UPDATE booking SET BOOK_STATUS = 'RETURNED' WHERE BOOK_ID = ?";
    $stmt4 = $con->prepare($query4);
    $stmt4->bind_param("i", $res2['BOOK_ID']);
    $stmt4->execute();

    echo '<script>alert("CAR RETURNED SUCCESSFULLY")</script>';
    echo '<script>window.location.href = "adminbook.php";</script>';
}
?>
