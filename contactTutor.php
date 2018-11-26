<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['tutorId'])) {

    // need to grab user id from session

    session_start();

    $user_id =  $_SESSION['userID'];
    $tutorId = $_POST['tutorId'];
    $date = $_POST['date'];
    $sessionLength = $_POST['length'];
    $address = $_POST['address'];
    $zip = $_POST['zip'];
    $approved = 0;
    $changesRequested = 0;
    $timeStart = $_POST['timeStart'];
    $tutorComment = "";


    if(isset($_POST['length'])){
        $studentComment = $_POST['comment'];
    } else {
        $studentComment = "";
    }

    var_dump($_SESSION);
    echo '<br>';
    echo '<br>';
    echo '<br>';
    echo "seriously".$_SESSION['FullName'];
    echo $user_id;
    echo "here boi";


    $query = "INSERT INTO `tutorRequest` (`address`, `approved`, `changesRequested`, `date`, sessionLength ,`studentComment`, `student_id`, tutorComment  ,`tutor_id`, `zip`, timeStart) 
VALUES ('$address', '$approved', '$changesRequested', '$date', '$sessionLength' ,'$studentComment', '$user_id', '$tutorComment' ,'$tutorId', '$zip', '$timeStart');";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("location: dashboard.php");
    exit;
}
?>
