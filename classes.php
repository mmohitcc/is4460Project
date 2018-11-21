<?php

require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->error) {
    die($conn->error);
}
class SSUser
{
    public $FullName, $Phone, $Email, $Token, $School, $Major, $Zip, $Address, $UserType, $PayRate;
    public function __construct($FullName, $Phone, $Email, $Token, $School, $Major, $Zip, $Address, $UserType, $PayRate)
    {
        //$this->userID = $userID;
        $this->FullName = $FullName;
        $this->Phone = $Phone;
        $this->Email = $Email;
        $this->Token = $Token;
        $this->School = $School;
        $this->Major = $Zip;
        $this->Address = $Address;
        $this->UserType = $UserType;
        $this->PayRate = $PayRate;
    }
    public function insert()
    {
        global $conn;
        //$userID = $this->userID;
        $FullName = $this->FullName;
        $Phone = $this->Phone;
        $Email = $this->Email;
        $Token = $this->Token;
        $School = $this->School;
        $Major = $this->Major;
        $Zip = $this->Zip;
        $Address = $this->Address;
        $UserType = $this->UserType;
        $PayRate = $this->PayRate;

        $query = "insert into users (FullName, Phone, Email, Token, School, Major, Zip, Address, UserType, PayRate)
			values ('$FullName', '$Phone', '$Email', '$Token', '$School', '$Major', '$Zip', '$Address', '$UserType', '$PayRate');";
        $result = $conn->query($query);
        if (!$result) {
            die(
                $conn->error
            );
        }
    }
}
class SSselect
{
    public $users = array();
    public function select($where)
    {
        global $conn;
        $query = "Select * from users where $where ";
        $result = $conn->query($query);
        if (!$result) {
            die($conn->error);
        }
        $data = $result->fetch_assoc();
        return $data;
    }
    public function delete($where)
    {
        global $conn;
        $query = "delete from users where $where";
        $result = $conn->query($query);
        if (!$result) {
            die($conn->error);
        }
    }
    public function update($FullName, $Phone, $Email, $Token, $School, $Major, $Zip, $Address, $UserType, $PayRate)
    {
        global $conn;
        $query = "UPDATE `users` SET `FullName` = '$FullName', `Phone` = '$Phone', `Email` = '$Email', `Token` = '$Token','School' = '$School','Major' = '$Major','Zip'='$Zip' WHERE `Email`.`Email` = $Email";
        $result = $conn->query($query);
        if (!$result) {
            die($conn->error);
        }
    }
}
?>