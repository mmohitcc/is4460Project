<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);



    // need to grab user id from session

    session_start();
    $name = $_POST['university'];

    if(isset($_POST['from'])){
        // go back to sign up page
        $backTo = "signUp";
    }


    $query = "INSERT INTO `university` (`name`) 
VALUES ('$name');";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    if($backTo == "signUp") {
        header("location: signup.php");
    } else {
        header("location: dashboard.php");
    }

    exit;
?>
