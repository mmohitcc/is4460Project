
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
    <a class="navbar-brand" href="#">
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
    <h1>Find a Tutor</h1>
</div>

<div class="row" style="border-style: solid; border-width: 2px;">

<!--    loop though all the tutors and show the card div for each-->
<!-- insert php loop here-->


    <?php

    require_once 'setLogin.php';
    $conn = new mysqli($hn, $un, $pw, $db);
    if($conn->connect_error) die($conn->connect_error);


    session_start();

    if (!isset($_SESSION['userID'])) {
        header("Location: login.php");
    }

    $user_id =  $_SESSION['userID'];



    $query = "SELECT * FROM users where UserType = 'tutor';";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    $row_count = $result->num_rows;
    while ($row = mysqli_fetch_object($result)) {

        echo "
        <div class=\"card\">
        <img src=$row->imgUrl alt=\"John\" style=\"width:100%\">
        <h1>$row->FullName</h1>
        <p class=\"title\">Computer Engineering</p>
        <p>$row->School</p>
        <p>Price: &nbsp; \$$row->PayRate / HR</p>
        <p>Major: &nbsp; $row->Major </p>
        <p>Zip: &nbsp; $row->Zip </p>
        <a href=\"#\"><i class=\"fa fa-linkedin\"></i></a>
        <a href=\"#\"><i class=\"fa fa-facebook\"></i></a>
        <button style='margin: 50px;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal$row->id'>
            Contact
        </button>
    </div>
  
  <div class='modal' id='myModal$row->id'>
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
                                    <h5 class='card-title text-center'>Contact $row->FullName</h5>
                                    <form class='form-signin' method='post' action='contactTutor.php'>

                                        <div class='form-label-group'>
                                            <label for='date'>Date</label>
                                            <input type='date' id='date' name='date' class='form-control' placeholder='date' required>
                                        </div>
                                        
                                        <div class='form-label-group'>
                                            <label for='timeStart'>Time Start</label>
                                            <input type='text' id='timeStart' name='timeStart' class='form-control' required autofocus>
                                        </div>     

                                        <div class='form-label-group'>
                                            <label for='length'>Session Length</label>
                                            <input type='number' id='length' name='length' class='form-control' required autofocus>
                                        </div>                                       
                                         
                                         
                                         <div class='form-label-group'>
                                            <label for='address'>Address</label>
                                            <input type='text' id='address' name='address' class='form-control' required autofocus>
                                        </div>
                                        
                                        <div class='form-label-group'>
                                            <label for='zip'>Zip</label>
                                            <input type='number' id='zip' name='zip' class='form-control' required autofocus>
                                        </div>
                                        
                                        <div class='form-label-group'>
                                            <label for='comment'>Comment</label>
                                            <input type='text' id='comment' name='comment' class='form-control' required autofocus>
                                        </div>                                       
                                        
                                        <input type='hidden' name='tutorId' value='$row->id' >
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
    
    ";


    }

    // $result= $conn->query($query);
    if(!$result) die($conn->error);

    $result= $conn->query($query);

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
