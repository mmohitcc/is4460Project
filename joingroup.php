<?php

require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['joinGroupId'])){
    $groupId =$_POST['joinGroupId'];
    session_start();

    $user_id =  $_SESSION['userID'];

    echo "user id";
    echo $user_id.'<br>';
    echo "user_id";
    echo $groupId.'<br>';

    $query = "INSERT INTO `joinedSession` (`studySessionId`, `userId`) 
VALUES ('$groupId', '$user_id');";

    $result = $conn->query($query);
    if(!$result) die($conn->error);


    echo '<br>';
    echo '<h1> added </h1>';
    echo '<br>';
    echo '<br>';


}
?>