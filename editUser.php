<?php

session_start();
$user_id =  $_SESSION['userID'];
$nameOld = $_SESSION['FullName'];
$phoneOld = $_SESSION['Phone'];
$emailOld = $_SESSION['Email'];
$tokenOld = $_SESSION['Token'];
$schoolOld = $_SESSION['School'];
$majorOld = $_SESSION['Major'];
$zipOld = $_SESSION['Zip'];
$addressOld = $_SESSION['Address'];
$userTypeOld = $_SESSION['UserType'];
$payRateOld = $_SESSION['PayRate'];
$imgOld = $_SESSION['imgUrl'];

if (isset($_POST['editUser'])) {
    $FullName = $_POST['FullName'];
    $Phone = $_POST['Phone'];
    $Email = $_POST['Email'];
    $School = $_POST['School'];
    $Major = $_POST['Major'];
    $Zip = $_POST['Zip'];
    $Address = $_POST['Address'];
    $UserType = $_POST['UserType'];
    $PayRate = $_POST['PayRate'];
    $pwd = $_POST['pwd'];

    $salt1 = 'qm&h*';
    $salt2 = 'pg!@';
    //$pwd = sanitizeMySQL($conn, $_POST['pwd']);
    $Token = hash('ripemd128', "$salt1$pwd$salt2");


    if($nameOld != $FullName){
        $nameOld = $FullName;
    }

    if($phoneOld != $Phone){
        $phoneOld = $Phone;
    }

    if($emailOld != $Email){
        $emailOld = $Email;
    }

    if($tokenOld != $Token){
        $tokenOld = $Token;
    }

    if($schoolOld != $School){
        $schoolOld = $School;
    }

    if($majorOld != $Major){
        $majorOld = $Major;
    }

    if($zipOld != $Zip){
        $zipOld = $Zip;
    }

    if($addressOld != $Address){
        $addressOld = $Address;
    }

    if($payRateOld != $PayRate){
        $payRateOld = $PayRate;
    }

    $query = "UPDATE users
SET FullName = '$nameOld', Phone = '$phoneOld',
    Email = '$emailOld', Token = '$tokenOld',
    School = '$schoolOld', Major = '$majorOld',
    zipa = '$zipOld', Address = '$addressOld',
    PayRate = '$payRateOld'
WHERE id = $user_id;";

    $result = $conn->query($query);
    if(!$result) die($conn->error);

    // update session with the new data



}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Study Sessions</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <script>
        function test() {
            if ($("#inputUserType")[0].value == "student") {
                $("#inputPayRate").hide();
                $("#inputPayRateLabel").hide();
            } else {
                $("#inputPayRate").show();
                $("#inputPayRateLabel").show();
            }
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
                    <h5 class="card-title text-center">update user</h5>
                    <form class="form-signin" method="Post" action="testEditUser.php">

                        <div class="form-label-group">
                            <input value="<?php echo $imgOld ?>" type="Text" name="imgUrl" id="imgUrl" class="form-control" placeholder="Image URL" required>
                            <label for="imgUrl">Name</label>
                        </div>


                        <div class="form-label-group">
                            <input value="<?php echo $nameOld ?>" type="Text" name="FullName" id="name" class="form-control" placeholder="Name (first last)" required>
                            <label for="name">Name</label>
                        </div>

                        <div class="form-label-group">
                            <input value="<?php echo $phoneOld ?>" type="number" name="Phone" id="phone" class="form-control" placeholder="Phone" required>
                            <label for="inputPassword">Phone</label>
                        </div>

                        <div class="form-label-group">
                            <input value="<?php echo $emailOld ?>" type="email" name="Email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                            <label for="inputEmail">Email address</label>
                        </div>

                        <div class="form-label-group">
                            <input value="<?php echo $emailOld ?>" type="email" id="inputConfirmEmail" class="form-control" placeholder="Confirm Email address" required autofocus>
                            <label for="inputConfirmEmail">Confirm Email address</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" name="pwd" id="inputPassword" class="form-control" placeholder="Password" >
                            <label for="inputPassword">Password</label>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Confirm Password" >
                            <label for="inputConfirmPassword">Confirm Password</label>
                        </div>

                        <div class="form-label-group">
                            <select name="School" id="inputSchool" required class="form-control">
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
                                    if ($schoolOld == $row->name) {
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
                            <input value="<?php echo $majorOld ?>" type="text" name="Major" id="inputMajor" class="form-control" placeholder="Major" required>
                            <label for="inputMajor">Major</label>
                        </div>

                        <div class="form-label-group">
                            <input value="<?php echo $zipOld ?>" type="text" name="Zip" id="inputZip" class="form-control" placeholder="ZIP Code" required>
                            <label for="inputZip">ZIP Code</label>
                        </div>

                        <div class="form-label-group">
                            <input value="<?php echo $addressOld ?>" type="text" name="Address" id="inputAddress" class="form-control" placeholder="Address" required>
                            <label for="inputAddress">Address</label>
                        </div>

<!--                        <div class="form-label-group" >-->
<!---->
<!--                            <select onchange="test()" id="inputUserType" class="form-control" name ="UserType" >-->
<!--                                <option value="student"> Student </option>-->
<!--                                <option value="tutor"> Tutor </option>-->
<!--                            </select>-->
<!--                            <label for="inputUserType">Student or Tutor</label>-->
<!--                        </div>-->


                        <?php

                        session_start();
                        $type =  $_SESSION['UserType'];
                        $pay = $_SESSION['PayRate'];

                        if($type == "tutor") {
                            echo "<div class=\"form-label-group\">
                                <input value='$payRateOld' value=\"0\" type=\"text\" name=\"PayRate\" id=\"inputPayRate\" class=\"form-control\" placeholder=\"Pay Rate\" required>
                                <label id=\"inputPayRateLabel\" for=\"inputPayRate\">For Tutors Only: Pay Rate</label>
                                </div>";

                        }

                        ?>

                        <input type="hidden" name="editUser" value="edit">

                        <!--Changed button to input-->
                        <input class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Update Account">
                        <hr class="my-4">
                    </form>
                </div>
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
                                        <input type="hidden" name="from" value="signup">
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
