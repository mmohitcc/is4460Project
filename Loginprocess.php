<?php

//Check Cred against DB
if (isset($_POST['Email'])) {
    require_once 'classes.php';
    require_once 'setLogin.php';
    session_start();
    $Email = sanitizeMySQL($conn, $_POST['Email']);
    $pwd = sanitizeMySQL($conn, $_POST['pwd']);
     
    $salt1 = 'qm&h*';
    $salt2 = 'pg!@';        
    $input_token = hash('ripemd128', "$salt1$pwd$salt2");
    
    $obj = new SSselect();
    $tmp = $obj->select("Email = '$Email'");
    
    $db_userID = $tmp['id'];
    $db_FullName = $tmp['FullName'];
    $db_Phone = $tmp['Phone'];
    $db_Email = $tmp['Email'];
    $db_Token = $tmp['Token'];
    $db_School = $tmp['School'];
    $db_Major = $tmp['Major'];
    $db_Zip = $tmp['Zip'];
    $db_Address = $tmp['Address'];
    $db_UserType = $tmp['UserType'];
    $db_PayRate = $tmp['PayRate'];
    $db_imgUrl = $tmp['imgUrl'];

    if ($input_token == $db_Token) {

        $_SESSION['FullName'] = $db_FullName;
        $_SESSION['userID'] = $tmp['id'];
        $_SESSION['Phone'] = $db_Phone;
        $_SESSION['Email'] = $db_Email;
        $_SESSION['Token'] = $db_Token;
        $_SESSION['School'] = $db_School;
        $_SESSION['Major'] = $db_Major;
        $_SESSION['Zip'] = $db_Zip;
        $_SESSION['Address'] = $db_Address;
        $_SESSION['UserType'] = $db_UserType;
        $_SESSION['PayRate'] = $db_PayRate;
        $_SESSION['imgUrl'] = $db_imgUrl;
        $_SESSION['test'] = "test";

        header("Location: dashboard.php?message=Successful");
        exit();
    } else {
        header("Location: login.php?message=Error: Failed");
        exit();
    }
}
function sanitizeString($var){
$var = stripslashes($var);
$var = strip_tags($var);
$var = htmlentities($var);
return $var;
}

function sanitizeMySQL($connection, $var){
$var = sanitizeString($var);
$var = $connection->real_escape_string($var);
return $var;
}
?>
