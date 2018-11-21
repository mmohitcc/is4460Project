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




<!-- Button to Open the Modal -->
<button style="margin: 50px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Create Message
</button>










<?php

if(isset($_POST['messageId'])) {


    $title2 = $_POST['title'];
    $content2 = $_POST['message'];
    $messageId = $_POST['messageId'];

    $query = "INSERT INTO `replies` (`title`, `content`, `messageId`) 
    VALUES ('$title2', '$content2', '$messageId');";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

}


if(isset($_POST['titleMessage'])) {


    $title = $_POST['titleMessage'];
    $content = $_POST['message'];
    $studySessionId = $_POST['studyGroupId'];

    $query = "INSERT INTO `messages` (`title`, `content`, `studySessionId`) 
    VALUES ('$title', '$content', '$studySessionId');";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

}

if(isset($_POST['studyGroupId'])){
    $id =$_POST['studyGroupId'];
    $query = "SELECT * from messages where studySessionId = $id;";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $row_count = $result->num_rows;

    echo '<br>';
    echo '<br>';
    echo '<br>';

    while ($row = mysqli_fetch_object($result)) {

        $query2 = "SELECT * from replies where messageId = $row->messageId;";

        $result2 = $conn->query($query2);

        while ($row2 = mysqli_fetch_object($result2)) {
            echo '<h5>Title: </h5>'.$row2->title.'<br>';
            echo '<h5>Message: </h5>'.$row2->content.'<br>';
        }


        echo "    
     <div class='studyCard'>
        <h3>$row->title </h3>
        <p>$row->content </p>
        <button style='margin: 50px;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal$row->messageId'>
            reply
        </button>
        <div class='modal' id='myModal$row->messageId'>
    <div class='modal-dialog'>
        <div class='modal-content'>

            <!-- Modal Header -->
            <div class='modal-header'>
                <h4 class='modal-title'>Modal Heading</h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
                <body>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                            <div class='card card-signin my-5'>
                                <div class='card-body'>
                                    <h5 class='card-title text-center'>$row->messageId</h5>
                                    <form class='form-signin' method='post' action='messagesShow.php'>

                                        <div class='form-label-group'>
                                            <label for='Title'>Title</label>
                                            <input type='text' id='title' name='title' class='form-control' placeholder='title' required>
                                        </div>

                                        <div class='form-label-group'>
                                            <label for='message'>Message</label>
                                            <input type='text' id='message' name='message' class='form-control' required autofocus>
                                        </div>

                                        <input type='hidden' name='messageId' value='$row->messageId' >
                                        <input type='hidden' name='studyGroupId' value='$id' >

                                        <br>
                                        <br>
                                        <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'>Create</button>
                                        <hr class='my-4'>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal footer -->
            <div class='modal-footer'>
                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
            </div>

        </div>
    </div>
</div>
    </div>";

    }

    // $result= $conn->query($query);
    if(!$result) die($conn->error);

    $result= $conn->query($query);

}
?>
























<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <body>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                            <div class="card card-signin my-5">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Create Message</h5>
                                    <form class="form-signin" method="post" action="messagesShow.php">

                                        <div class="form-label-group">
                                            <label for="Title">Title</label>
                                            <input type="text" id="title" name="titleMessage" class="form-control" placeholder="title" required>
                                        </div>

                                        <div class="form-label-group">
                                            <label for="message">Message</label>
                                            <input type="text" id="message" name="message" class="form-control" required autofocus>
                                        </div>

                                        <input type="hidden" name="studyGroupId" <?php echo "value=".$id ?> >

                                        <br>
                                        <br>
                                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Create</button>
                                        <hr class="my-4">
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

