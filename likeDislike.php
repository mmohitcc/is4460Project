<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


$announcementId = $_POST['announcementId'];
if(isset($_POST['like'])) {

    $likes = (int) $_POST['like'];
    ++$likes;
        $query = "UPDATE announcements
SET likes = '$likes' where id = $announcementId";
} else {
    $dislikes = (int) $_POST['dislike'];
    ++$dislikes;
    $query = "UPDATE announcements
SET disLikes = '$dislikes' where id = $announcementId";
}



$result = $conn->query($query);
if(!$result) die($conn->error);

header("Location: announcements.php");

?>
