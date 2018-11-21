<?php

require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['groupId'])){
    $groupId =$_POST['groupId'];
    session_start();

    $user_id =  $_SESSION['userID'];

    echo "user id";
    echo $user_id.'<br>';
    echo "user_id";
    echo $groupId.'<br>';

    $query = "DELETE FROM joinedSession WHERE studySessionId = '$groupId' AND userId = '$user_id';";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

}
?>