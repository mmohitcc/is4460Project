<?php

require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

session_start();
$user_id =  $_SESSION['userID'];
$nameOld = $_SESSION['FullName'];
$phoneOld = $_SESSION['Phone'];
$emailOld = $_SESSION['Email'];
$tokenOld = $_SESSION['Token'];
$schoolOld = $_SESSION['School'];
$majorOld = $_SESSION['Major'];
$zipOld = $_SESSION['Zip'];
$addressOld = $_SESSION['Address'];
$userTypeOld = $_SESSION['UserType'];
$payRateOld = $_SESSION['PayRate'];

if (isset($_POST['editUser'])) {
    $FullName = $_POST['FullName'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $School = $_POST['School'];
    $Major = $_POST['Major'];
    $Zip = $_POST['Zip'];
    $Address = $_POST['Address'];
    $UserType = $_POST['UserType'];
    $PayRate = $_POST['PayRate'];
    $pwd = $_POST['pwd'];
    $imgUrl = $_POST['imageUrl'];

    $salt1 = 'qm&h*';
    $salt2 = 'pg!@';
    //$pwd = sanitizeMySQL($conn, $_POST['pwd']);
    $Token = hash('ripemd128', "$salt1$pwd$salt2");


    if($nameOld != $FullName){
        $nameOld = $FullName;
    }

    if($phoneOld != $Phone){
        $phoneOld = $Phone;
    }

    if($emailOld != $Email){
        $emailOld = $Email;
    }

    if($tokenOld != $Token && $Token != '8867bbb3ace1570194ee5f7dc37eeec9'){
        $tokenOld = $Token;
    }

    if($schoolOld != $School){
        $schoolOld = $School;
    }

    if($majorOld != $Major){
        $majorOld = $Major;
    }

    if($zipOld != $Zip){
        $zipOld = $Zip;
    }

    if($addressOld != $Address){
        $addressOld = $Address;
    }

    if($payRateOld != $PayRate && $payRateOld != ""){
        $payRateOld = $PayRate;
    }

    echo "<h1>test</h1>";
    echo $schoolOld."<br>";
    echo $user_id."<br>";
    echo $payRateOld."<br>";


    $query = "UPDATE users
    SET FullName = '$nameOld', Phone = '$phoneOld',
    Email = '$emailOld', Token = '$tokenOld',
    School = '$schoolOld', Major = '$majorOld',
    Zip = '$zipOld', Address = '$addressOld',
    PayRate = '$payRateOld', imgUrl = '$imgUrl'
    WHERE id = $user_id;";

    $result = $conn->query($query);

    $_SESSION['FullName'] = $nameOld;
    $_SESSION['Phone'] = $phoneOld;
    $_SESSION['Email'] = $emailOld;
    $_SESSION['Token'] = $tokenOld;
    $_SESSION['School'] = $db_School;
    $_SESSION['Major'] = $majorOld;
    $_SESSION['Zip'] = $zipOld;
    $_SESSION['Address'] = $addressOld;
    $_SESSION['PayRate'] = $payRateOld;
    $_SESSION['imgUrl'] = $imgUrl;

    //if(!$result) die($conn->error);
    header("location: dashboard.php");

}
