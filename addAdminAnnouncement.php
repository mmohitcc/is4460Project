<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


$header = $_POST['header'];
$announcement = $_POST['announcement'];
$likes = 0;
$dislikes = 0;


$query = "INSERT INTO announcements (header, announcement, likes, dislikes)
VALUES ('$header', '$announcement', $likes, $dislikes);";

$result = $conn->query($query);
if(!$result) die($conn->error);

header("location: announcements.php");

?>
