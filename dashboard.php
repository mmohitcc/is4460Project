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
                <a class="nav-link" href="studyGroups.php">Home</a>
                </li>';

            }
            ?>


            <li class="nav-item">
                <a class="nav-link" href="home.php">Study Groups</a>
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

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
}

    $user_id =  $_SESSION['userID'];

    if($_SESSION['UserType'] == 'tutor') {
        $userType = 'tutor';
    } else {
        $userType = 'student';
    }


    if($userType == 'student') {
        $query = "SELECT * from studySession where id in (SELECT studySessionId from joinedSession where userId = '$user_id');";
    } else {

        $query = "SELECT * FROM tutorRequest where tutor_id = '$user_id';";
    }

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $row_count = $result->num_rows;


if($userType == 'student') {

    while ($row = mysqli_fetch_object($result)) {

        if($row->isPublic == 1) {
            $public = 'Yes';
        } else {
            $public = "No";
        }

        echo "    
     <div class=\"studyCard\">
        <h3>$row->class </h3>
        <hr>
        <h5>Coordinator: $row->owner</h5>
        <p class=\"title\">Subject: $row->subject</p>
        <p>School: $row->university</p>
        <p>Date: $row->timeStart</p>
        <p>Open to public: $public</p>
        <form method='post' action='messagesShow.php'><input type='hidden' name='studyGroupId' value=$row->id> <button class='btn btn-success'>Messages</button> </form>
        <a href=\"http://maps.google.com/?q='$row->Location'\"><i class=\"fa fa-map-pin\"></i> Map </a>
        <br>
            <form method=\"post\" action=\"download-ics.php\">
            <input type=\"hidden\" name=\"date_start\" value='$row->date 9:00AM'>
            <input type=\"hidden\" name=\"date_end\" value='$row->date 10:00AM'>
            <input type=\"hidden\" name=\"location\" value='$row->Location'>
            <input type=\"hidden\" name=\"description\" value=\"Study Session for '$row->class'\">
            <input type=\"hidden\" name=\"summary\" value=\"Study hard!\">
            <input type=\"hidden\" name=\"url\" value=\"studysession.co\">
                        <i class=\"fa fa-calendar\"></i>
            <input style='background: transparent; border: none;' type=\"submit\" value=\"Add to Calendar\">
        </form>
        <a href=\"edit.php\"><p style=\"color: gray; font-size: 14px;\">edit group</p></a>
        <p><form method='post' action='unJoinGroup.php'> 
        <input name='groupId' type='hidden' value=$row->id> 
        <button style='background: red' class=\"button\">Remove Group</button></form></p>
    </div>";

    }


    $query = "SELECT * FROM tutorRequest where student_id = '$user_id'";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $row_count = $result->num_rows;

    while ($row = mysqli_fetch_object($result)) {

        if($row->changesRequested == 1) {
            $color = 'orange';
        } else if($row->changesRequested == 0) {
            if($row->approved == 1) {
                $color = 'green';
            } else {
                $color = 'yellow';
            }
        }

        echo "    
     <div style='background: $color; padding-bottom: 50px; padding-top: 10px;' class=\"studyCard\">
        <h3>$row->date </h3>
        <hr>
        <h5>Start Time: $row->timeStart</h5>
        <p>Session Length: $row->sessionLength</p>
        <p>Zip: $row->zip</p>
        <p>Address: $row->address</p>
        <p>Student Comment: <br> $row->studentComment</p>
        <a href='showmodal' data-toggle='modal' data-target='#commentModal$row->id'><p style=\"color: gray; font-size: 14px;\">update comment</p></a>
        <p>Tutor Comment: <br> $row->tutorComment</p>
        <a href=\"http://maps.google.com/?q='$row->address'\"><i class=\"fa fa-map-pin\"></i> Map </a>
        <br>
        <form method=\"post\" action=\"download-ics.php\">
            <input type=\"hidden\" name=\"date_start\" value='$row->date 9:00AM'>
            <input type=\"hidden\" name=\"date_end\" value='$row->date 10:00AM'>
            <input type=\"hidden\" name=\"location\" value='$row->address'>
            <input type=\"hidden\" name=\"description\" value=\"TuTor Session\">
            <input type=\"hidden\" name=\"summary\" value=\"Study hard!\">
            <input type=\"hidden\" name=\"url\" value=\"studysession.co\">
                        <i class=\"fa fa-calendar\"></i>
            <input style='background: transparent; border: none;' type=\"submit\" value=\"Add to Calendar\">
        </form>
        ";

            if($row->changesRequested == 1) {
                echo "<div style='background: red;, padding: 5px;'><h3>Your tutor has requested you make changes</h3></div>
                <button style='margin: 10px;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal$row->id'>
            Make Changes
        </button>
    </div>";
            }  else {
                echo "</div>";
            }


            echo "<div class='modal' id='commentModal$row->id'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header text-center'>
                <h4 class='text-center'>Update Tutor Request</h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
                <body>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                            <div class='my-5'>
                                <div>
                                    <h5 class='card-title text-center'>Update Study Session</h5>
                                    <form class='form-signin' method='post' action='updateRequest.php'>

                                        <div class='form-label-group'>
                                            <label for='comment'>Comment</label>
                                            <input type='text' id='comment' name='comment' value='$row->studentComment' class='form-control' required autofocus>
                                        </div>                                       
                                        
                                        <input type='hidden' name='requestId' value='$row->id' >
                                        <br>
                                        <br>
                                        <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'>updateComment</button>
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
</div>";


        if($row->changesRequested == 1) {
           echo "<div class='modal' id='myModal$row->id'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header text-center'>
                <h4 class='text-center'>Update Tutor Request</h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
                <body>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                            <div class='my-5'>
                                <div>
                                    <h5 class='card-title text-center'>Update Study Session</h5>
                                    <form class='form-signin' method='post' action='updateRequest.php'>

                                        <div class='form-label-group'>
                                            <label for='date'>Date</label>
                                            <input type='date' id='date' name='date' class='form-control' value='$row->date' placeholder='date' required>
                                        </div>
                                        
                                        <div class='form-label-group'>
                                            <label for='timeStart'>Time Start</label>
                                            <input type='text' id='timeStart' name='timeStart' value='$row->timeStart' class='form-control' required autofocus>
                                        </div>     

                                        <div class='form-label-group'>
                                            <label for='length'>Session Length</label>
                                            <input type='number' id='length' name='length' value='$row->sessionLength' class='form-control' required autofocus>
                                        </div>                                       
                                         
                                         
                                         <div class='form-label-group'>
                                            <label for='address'>Address</label>
                                            <input type='text' id='address' name='address' value='$row->address' class='form-control' required autofocus>
                                        </div>
                                        
                                        <div class='form-label-group'>
                                            <label for='zip'>Zip</label>
                                            <input type='number' id='zip' name='zip' value='$row->zip' class='form-control' required autofocus>
                                        </div>
                                        
                                        <div class='form-label-group'>
                                            <label for='comment'>Comment</label>
                                            <input type='text' id='comment' name='comment' value='$row->studentComment' class='form-control' required autofocus>
                                        </div>                                       
                                        
                                        <input type='hidden' name='requestId' value='$row->id' >
                                        <input type='hidden' name='updateRequest' value='change' >
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
</div>";
        }


    }





} else {

    while ($row = mysqli_fetch_object($result)) {

        echo "
     <div class=\"studyCard\">
        <h3>$row->date </h3>
        <hr>
        <p>Time: $row->timeStart</p>
        <p>Session Length: $row->sessionLength</p>
        
        <p>Zip: $row->zip</p>
        <p>Address: $row->address</p>
        <a href=\"http://maps.google.com/?q='$row->address'\"><i class=\"fa fa-map-pin\"></i> Map</a>
        <br>
       <form method=\"post\" action=\"download-ics.php\">
            <input type=\"hidden\" name=\"date_start\" value='$row->date 9:00AM'>
            <input type=\"hidden\" name=\"date_end\" value='$row->date 10:00AM'>
            <input type=\"hidden\" name=\"location\" value='$row->address'>
            <input type=\"hidden\" name=\"description\" value=\"Tutor Session'\">
            <input type=\"hidden\" name=\"summary\" value=\"Study hard!\">
            <input type=\"hidden\" name=\"url\" value=\"studysession.co\">
            <i class=\"fa fa-calendar\"></i>
            <input style='background: transparent; border: none;' type=\"submit\" value=\"Add to Calendar\">
            
        </form>
        
        <hr>
        <p>Student Comment: <br> $row->studentComment</p>
        
        
      <p id='test'>
        <form method='post' action='requestChanges.php'> 
        <input name='requestId' type='hidden' value=$row->id> 
        </form>
        ";

        if($row->changesRequested == 0) {
            echo "<button style='background: orange' type='button' data-toggle='modal' data-target='#requestChanges$row->id' class=\"button\">Request Changes</button>";
        } else {
            echo "<button style='background: gray'  type='disabled' class=\"button\" disabled='disabled'>Changes Requested</button>";
        }

    if ($row->approved == 0) {
        echo "
       </form>
      </p>
        
       <p id='test'>
          
        <button style='background: green' type='button' data-toggle='modal' data-target='#approve$row->id' class=\"button\">Approve</button>
    </div>";
    } else {
        echo "</div>";
    }

        echo "
     <div class='modal' id='requestChanges$row->id'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header text-center'>
                <h4 class='text-center'>Contact Tutor Request</h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
                <body>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                            <div class='my-5'>
                                <div>
                                    <form class='form-signin' method='post' action='approveChangeRequest.php'>
                                        
                                        <div class='form-label-group'>
                                            <label for='comment'>Comment</label>
                                            <input type='text' id='comment' name='comment' class='form-control' required autofocus>
                                        </div>                                       
                                        
                                        <input type='hidden' name='requestId' value='$row->id' >
                                        <input type='hidden' name='changeRequest' value='change' >
                                        <br>
                                        <br>
                                        <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'>Request</button>
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


 <div class='modal' id='approve$row->id'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <!-- Modal Header -->
            <div class='modal-header text-center'>
                <h4 class='text-center'>Approve Tutor Session</h4>
                <button type='button' class='close' data-dismiss='modal'>&times;</button>
            </div>
            <!-- Modal body -->
            <div class='modal-body'>
                <body>
                <div class='container'>
                    <div class='row'>
                        <div class='col-sm-9 col-md-7 col-lg-5 mx-auto'>
                            <div class='my-5'>
                                <div>
                                    <form class='form-signin' method='post' action='approveChangeRequest.php'>
                                        
                                        <div class='form-label-group'>
                                            <label for='comment'>Comment</label>
                                            <input style='width: 200px;, height: 40px' type='text' id='comment' name='tutorComment' class='form-control' required autofocus>
                                        </div>                                       
                                        
                                        <input type='hidden' name='requestId' value='$row->id' >
                                        <input type='hidden' name='changeRequest' value='approve' >
                                        <br>
                                        <br>
                                        <button class='btn btn-lg btn-primary btn-block text-uppercase' type='submit'>Approve</button>
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
    
    
    
    
    
    
    ";

    }
}



    // $result= $conn->query($query);
    if(!$result) die($conn->error);

//    $result= $conn->query($query);
?>
    </div>
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
</html>



