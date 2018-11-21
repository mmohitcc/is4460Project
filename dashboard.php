<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Study Sessions</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tutors.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<!-- Image and text -->
<nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">
        <img src="images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Study Sessions
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php
            session_start();

            if (isset($_SESSION['FullName'])) {
                echo $_SESSION['FullName'];
                echo '<li class="nav-item">
                <a class="nav-link" href="logout.php">logout</a>
                </li>';
            }
            else
            {
                echo '<li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
                </li>';

            }



            ?>
            <li class="nav-item active">
                <a class="nav-link" href="studyGroups.php">Study Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tutors.php">Tutors</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="studyGroups.php">
            <input class="form-control mr-sm-2" type="number" placeholder="zip">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>


<!--body-->
<br>
<div>
    <div align="center">
        <?php session_start();  echo '<h4>Welcome: </h4>'; echo $_SESSION['FullName']  ?>
    </div>
    <div class="row" style="border-style: solid; border-width: 2px;">

        <!--        loop through all the "study groups" based on either the search zip that was sent in

         or the search class or subject

        and print the study card div for them-->


<?php

require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


    session_start();
    $user_id =  $_SESSION['userID'];

    if($_SESSION['UserType'] == 'tutor') {
        $userType = 'tutor';
    } else {
        $userType = 'student';
    }


    if($userType == 'student') {
        $query = "SELECT * FROM studySession, joinedSession, users 
    where studySession.id = joinedSession.studySessionId and joinedSession.userId = $user_id;";
    } else {

    }

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $row_count = $result->num_rows;

    echo '<br>';
    echo '<br>';
    echo '<br>';


    while ($row = mysqli_fetch_object($result)) {

        echo "    
     <div class=\"studyCard\">
        <h3>$row->class </h3>
        <hr>
        <h5>Coordinator: $row->user</h5>
        <p class=\"title\">Subject: $row->subject</p>
        <p>School: $row->university</p>
        <p>Date: $row->timeStart</p>
        <p>Open to public: $row->isPublic</p>
        <form method='post' action='messagesShow.php'><input type='hidden' name='studyGroupId' value=$row->id> <button>Messages</button> </form>
        <a href=\"#\"><i class=\"fa fa-map-pin\"></i> google maps</a>
        <br>
        <a href=\"#\"><i class=\"fa fa-google\"></i> Add to Calendar</a>
        <a href=\"edit.php\"><p style=\"color: gray; font-size: 14px;\">edit group</p></a>
        <p><form method='post' action='unJoinGroup.php'> 
        <input name='groupId' type='hidden' value=$row->id> 
        <button style='background: red' class=\"button\">Remove Group</button></form></p>
    </div>";

    }

    // $result= $conn->query($query);
    if(!$result) die($conn->error);

//    $result= $conn->query($query);

?>


    </div>
</div>




<!--footer-->
<div class="footer">
    <p>&copy; Study Sessions</p>
</div>

<!-- scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>



