<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


$school = $_POST['uniForClass'];
$class = $_POST['class'];

$query = "SELECT * FROM university where name = '$school';";
$result = $conn->query($query);
$uni =  mysqli_fetch_object($result);
$schoolId = $uni->id;

echo "class: ".$class.'<br>';
echo "school: ".$school.'<br>';
echo "school id: ".$schoolId.'<br>';

$query = "INSERT INTO class (name, universityId)
VALUES ('$class', '$schoolId');";

$result = $conn->query($query);
if(!$result) die($conn->error);

header("location: createStudyGroup.php");

?>
