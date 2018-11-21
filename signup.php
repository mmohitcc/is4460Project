<?php
require_once 'signupprocess.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Study Sessions</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
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

            <li class="nav-item">
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

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign Up</h5>
                    <form class="form-signin" method="Post" action="signup.php">

                        <div class="form-label-group">
                            <input type="Text" name="FullName" id="name" class="form-control" placeholder="Name (first last)" required>
                            <label for="name">Name</label>
                        </div>

                        <div class="form-label-group">
                            <input type="number" name="Phone" id="phone" class="form-control" placeholder="Phone" required>
                            <label for="inputPassword">Phone</label>
                        </div>

                        <div class="form-label-group">
                            <input type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                            <label for="inputEmail">Email address</label>
                        </div>

                        <div class="form-label-group">
                            <input type="email" id="inputConfirmEmail" class="form-control" placeholder="Confirm Email address" required autofocus>
                            <label for="inputConfirmEmail">Confirm Email address</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" name="pwd" id="inputPassword" class="form-control" placeholder="Password" required>
                            <label for="inputPassword">Password</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" required>
                            <label for="inputConfirmPassword">Confirm Password</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" name="School" id="inputSchool" class="form-control" placeholder="University" required>
                            <label for="inputUniversity">University</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" name="Major" id="inputMajor" class="form-control" placeholder="Major" required>
                            <label for="inputMajor">Major</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" name="Zip" id="inputZip" class="form-control" placeholder="ZIP Code" required>
                            <label for="inputZip">ZIP Code</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" name="Address" id="inputAddress" class="form-control" placeholder="Address" required>
                            <label for="inputAddress">Address</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" name="UserType" id="inputUserType" class="form-control" placeholder="Student or Tutor" required>
                            <label for="inputUserType">Student or Tutor</label>
                        </div>

                        <div class="form-label-group">
                            <input type="text" name="PayRate" id="inputPayRate" class="form-control" placeholder="Pay Rate" required>
                            <label for="inputPayRate">For Tutors Only: Pay Rate</label>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember password</label>
                        </div>
                        <!--Changed button to input-->
                        <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Create Account">
                        <hr class="my-4">
                    </form>
                    <div style="text-align: center"><p>have an account?</p></div>
                    <a href="login.php"><button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><i class="fab fa-google mr-2"></i>Sign In</button></a>
                </div>
            </div>
        </div>
    </div>
</div>


<!--footer
<div class="footer">
    <p>&copy; Study Sessions</p>
</div>-->

<!-- scripts-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
