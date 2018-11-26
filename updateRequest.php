<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['updateRequest'])) {

    // means we are updating the entire request

    session_start();

    $requestId =  $_POST['requestId'];
    $date = $_POST['date'];
    $sessionLength = $_POST['length'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $approved = 0;
    $changesRequested = 0;
    $timeStart = $_POST['timeStart'];

    if(isset($_POST['comment'])){
        $studentComment = $_POST['comment'];
    } else {
        $studentComment = "";
    }

    $query =
    "UPDATE tutorRequest 
    SET date = '$date',
    sessionLength = '$sessionLength',
    address = '$address',
    zip = '$zip', 
    approved = '$approved',
    changesRequested = '$changesRequested',
    timeStart = '$timeStart'
    where id = $requestId;";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("location: dashboard.php");
    exit;
} else {
    // we are only updating the comment
    $comment = $_POST['comment'];
    $requestId =  $_POST['requestId'];
    $query = "UPDATE tutorRequest SET studentComment = '$comment' where id = $requestId;";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("location: dashboard.php");
    exit;

}



?>
