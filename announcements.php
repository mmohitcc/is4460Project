<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Study Sessions</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tutors.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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

            <?php
            session_start();
            if (isset($_SESSION['FullName'])) {
                echo $_SESSION['FullName'];
                echo '<li class="nav-item">
                <a class="nav-link" href="logout.php">logout</a>
                </li>
                                <li class="nav-item">
                <a class="nav-link" href="editUser.php">edit profile</a>
                </li>';
            }
            else
            {
                echo '<li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
                </li>';

            }
            ?>

            <?php
            session_start();
            if (isset($_SESSION['FullName'])) {
                echo '<li class="nav-item">
                <a class="nav-link" href="dashboard.php">Home</a>
                </li>';
            }
            else
            {
                echo '<li class="nav-item">
                <a class="nav-link" href="home.php">Home</a>
                </li>';

            }
            ?>


            <li class="nav-item">
                <a class="nav-link" href="studyGroups.php">Study Groups</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tutors.php">Tutors</a>
            </li>

        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="studyGroups.php">
            <input class="form-control mr-sm-2" name="searchZip" type="number" placeholder="zip">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>




<!-- Button to Open the Modal -->
<?php

session_start();

$type =  $_SESSION['UserType'];

 if($type == 'admin') {
     echo "
<button style=\"margin: 50px; margin-left: 20%;\" type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#myModal\">
    Create Announcement
</button>";
 } else {

     echo "<br><br>";

 }

?>

<?php

    $query = "SELECT * from announcements;";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $row_count = $result->num_rows;


    while ($row = mysqli_fetch_object($result)) {

        $query2 = "SELECT * from replies where messageId = $row->messageId;";

        $result2 = $conn->query($query2);




        echo "    
     <div style='width: 60%' class='studyCard'>
        <h3>$row->header </h3>
        <p>$row->announcement </p>
        <div>
        <span style='margin: 10px'>
         <form method='post' action='likeDislike.php'>
         <input type='hidden' name='announcementId' value='$row->id'>
         <input type='hidden' name='like' value='$row->likes'>
         <button style='border: none; background: transparent;'><i style='color: green' class='fa fa-thumbs-up'></i> $row->likes</button>
         </form>
         </span>
        <span style='margin: 10px'>
         <form method='post' action='likeDislike.php'>
         <input type='hidden' name='announcementId' value='$row->id'>
         <input type='hidden' name='dislike' value='$row->disLikes'>
         <button style='border: none; background: transparent;'><i style='color: red' class='fa fa-thumbs-down'></i> $row->disLikes</button>
         </form>
         </span>
        </div>
          
</div>";



    }

    // $result= $conn->query($query);
    if(!$result) die($conn->error);

    $result= $conn->query($query);


?>
























<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div style="width: 600px;" class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 style="margin-left: 33%" class="modal-title">Create Announcement</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <body>
                <div>
                    <div class="row">
                        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                            <div style="width: 400px; margin-left: -40%">
                                <div>
                                    <form class="form-signin" method="post" action="addAdminAnnouncement.php">

                                        <div class="form-label-group">
                                            <label for="header">Header</label>
                                            <input type="text" id="header" name="header" class="form-control" placeholder="header" required>
                                        </div>

                                        <div class="form-label-group">
                                            <label for="message">Announcement</label>
                                            <input type="text" id="announcement" name="announcement" class="form-control" required autofocus>
                                        </div>

                                        <br>
                                        <br>
                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Create</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



</body>


</body>
</html>
