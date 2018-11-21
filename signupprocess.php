<?php

if (isset($_POST['Email'])) {
    require_once 'setLogin.php';
    require_once 'classes.php';

    // $userID = $_POST['userID'];
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


    // DB security. Hashes will be stored in DB. 
    $salt1 = 'qm&h*';
    $salt2 = 'pg!@';
    //$pwd = sanitizeMySQL($conn, $_POST['pwd']);
    $Token = hash('ripemd128', "$salt1$pwd$salt2");

    $user = new SSUser($FullName, $Phone, $Email, $Token, $School, $Major, $Zip, $Address, $UserType, $PayRate);
    $user->insert();
    $obj = new SSselect();
    $tmp = $obj->select("Email = '$Email'");

    $Email = $tmp['Email'];
    session_start();
    $_SESSION['userID'] = $tmp['id'];
    $_SESSION['FullName'] = $FullName;
    $_SESSION['Phone'] = $Phone;
    $_SESSION['Email'] = $Email;
    $_SESSION['Token'] = $Token;
    $_SESSION['School'] = $School;
    $_SESSION['Major'] = $Major;
    $_SESSION['Zip'] = $Zip;
    $_SESSION['Address'] = $Address;
    $_SESSION['UserType'] = $UserType;
    $_SESSION['PayRate'] = $PayRate;

header("Location: home.php?message=Works");
exit();
}
/*function sanitizeString($var){
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
}
function sanitizeMySQL($connection, $var){
$var = sanitizeString($var);
$var = $connection->real_escape_string($var);
return $var;
}*/
?>