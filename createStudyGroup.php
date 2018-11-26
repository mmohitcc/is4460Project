<?php
require_once 'setLogin.php';
$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['schoolForClasses'])) {
    $schoolForClasses = $_POST['schoolForClasses'];
} else {
    $schoolForClasses = "University of Utah";
}



if(isset($_POST['subject'])) {


    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $school = $_POST['school'];
    $class = $_POST['class'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $zip = $_POST['zip'];

    session_start();
    $user_id =  $_SESSION['userID'];
    $ownerName =  $_SESSION['FullName'];


    if(isset($_POST['password'])) {
        $password = $_POST['password'];
        $isPublic = 1;
    } else {
        $password = "";
        $isPublic = 0;
    }

    // set owner to user from session
    // if password is set then we set open to false if not set it to true
    // grab user from the session

    $query = "INSERT INTO `studySession` (`name`, `ownerId`, `owner` ,`class`, `subject`, `university`, `timeStart`, `Location`, `isPublic`, `password`, `zip`) 
VALUES ('$name', '$user_id', '$ownerName' ,'$class', '$subject', '$school', '$date', '$location', '$isPublic', '$password', '$zip');";

    $result = $conn->query($query);
    if (!$result) die($conn->error);

    header("location: studySessionCreatedSuccess.php");
    exit;
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Study Sessions</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tutors.css">

    <?php $a = 'a'; ?>
    <script>

        function test() {
            // inputSchool
            // grab input school value
            // set value of
            var schoolVal = $("#inputSchool")[0].value;
            $("#classSchool")[0].value = schoolVal;
            $("#classUniversityForm").submit()
        }

        function addUniValue() {
            var schoolValForClass = $("#inputSchool")[0].value;
            $("#uniForClass")[0].value = schoolValForClass;
        }

    </script>
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


<!--body-->

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Create New Group</h5>
                    <form class="form-signin" method="post" id="createStudyGroup" action="createStudyGroup.php">

                        <div class="form-label-group">
                            <input type="Text" id="name" name="name" class="form-control" placeholder="study session name" required>
                            <label for="name">Name</label>
                        </div>

                        <div class="form-label-group">
                            <select onchange="test()" name="School" id="inputSchool" required class="form-control">
                                <?php
                                // query for all schools and echo an option for them
                                require_once 'setLogin.php';
                                $conn = new mysqli($hn, $un, $pw, $db);
                                if($conn->connect_error) die($conn->connect_error);


                                session_start();
                                $user_id =  $_SESSION['userID'];

                                $query = "SELECT * FROM university;";

                                $result = $conn->query($query);
                                if(!$result) die($conn->error);

                                $row_count = $result->num_rows;
                                while ($row = mysqli_fetch_object($result)) {
                                    if ($schoolForClasses == $row->name) {
                                        echo "<option selected='selected' value='$row->name'> $row->name </option>";
                                    } else {
                                        echo "<option value='$row->name'> $row->name </option>";
                                    }

                                }

                                ?>
                            </select>
                            <label for="inputUniversity">University</label>
                            <a href='showmodal' data-toggle='modal' data-target='#addUniversity'><p style="color: gray; font-size: 14px;">add university</p></a>
                        </div>


                        <div class="form-label-group">
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="subject" required>
                            <label for="subject">Subject</label>
                        </div>

                        <div class="form-label-group">
                            <select onchange="test()" name="class" id="inputClass" required class="form-control">
                                <?php
                                // query for all schools and echo an option for them
                                require_once 'setLogin.php';
                                $conn = new mysqli($hn, $un, $pw, $db);
                                if($conn->connect_error) die($conn->connect_error);


                                session_start();
                                $user_id =  $_SESSION['userID'];

                                $query = "SELECT * FROM university where name = '$schoolForClasses';";
                                $result = $conn->query($query);
                                $uni =  mysqli_fetch_object($result);
                                $schoolId = $uni->id;

                                $query = "SELECT * FROM class where universityId = '$schoolId'";

                                $result = $conn->query($query);
                                if(!$result) die($conn->error);

                                $row_count = $result->num_rows;
                                while ($row = mysqli_fetch_object($result)) {
                                    echo "<option value='$row->name'> $row->name </option>";
                                }

                                ?>
                            </select>
                            <label for="inputUniversity">Class</label>
                            <a href='showmodal' data-toggle='modal' data-target='#addClass'><p style="color: gray; font-size: 14px;">add class</p></a>
                        </div>


                        <div class="form-label-group">
                            <input type="date" id="date" name="date" class="form-control" placeholder="date" autofocus>
                            <label for="date">Date</label>
                        </div>

<!--                        <div class="form-label-group">-->
<!--                            <select id="open">-->
<!--                                <option>Public</option>-->
<!--                                <option>Closed</option>-->
<!--                            </select>-->
<!--                            <br>-->
<!--                            <label for="open">Open / Closed</label>-->
<!--                        </div>-->

                        <div class="form-label-group">
                            <input type="text" id="password" name="password" class="form-control" placeholder="password" autofocus>
                            <label for="password">Password</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" id="location" name="location" class="form-control" placeholder="Address" autofocus>
                            <label for="location">Location</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" id="zip" name="zip" class="form-control" placeholder="zip" autofocus>
                            <label for="zip">Zip</label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Create Group</button>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal" id="addUniversity">
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
                                        <h5 class="card-title text-center">Add University</h5>
                                        <form class="form-signin" method="post" action="addUniversity.php">

                                            <div class="form-label-group">
                                                <label for="university">University</label>
                                                <input type="text" id="university" name="university" class="form-control" required autofocus>
                                            </div>
                                            <br>
                                            <br>
                                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Add</button>
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

    <!-- The Modal -->
    <div class="modal" id="addClass">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add a Class</h4>
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
                                        <h5 class="card-title text-center">Add Class</h5>
                                        <form class="form-signin" method="post" action="addClass.php">

                                            <div class="form-label-group">
                                                <label for="class">Class</label>
                                                <input type="hidden" id="uniForClass" name="uniForClass" value="universityOfUtah">
                                                <input onchange="addUniValue()" type="text" id="class" name="class" class="form-control" required autofocus>
                                            </div>
                                            <br>
                                            <br>
                                            <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Add</button>
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



    <form method="post" id="classUniversityForm"  action="createStudyGroup.php">
        <input id="classSchool" type="hidden" name="schoolForClasses" >
    </form>

</div>
</body>


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
