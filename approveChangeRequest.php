<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['changeRequest'])) {

    // need to grab user id from session

    session_start();

    $requestId =  $_POST['requestId'];
    $type = $_POST['changeRequest'];
    $comment = $_POST['comment'];

    if ($type == "approve") {
        $approved = 1;
        $query = "UPDATE tutorRequest SET approved = '$approved' where id = $requestId;";

    } else {
        // else changes are requested
        $changesRequested = 1;
        $approved = 0;
        $query = "UPDATE tutorRequest SET changesRequested = '$changesRequested', tutorComment = '$comment', approved = '$approved' where id = $requestId;";
    }



    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("location: dashboard.php");
    exit;
}
?>
