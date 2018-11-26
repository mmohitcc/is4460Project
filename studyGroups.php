
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Study Sessions</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="tutors.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script>

        function password(id){
            var password = $("#password" + id)[0].value;
            var passwordTyped = $("#changedPassword" + id)[0].value;

            if(password == passwordTyped) {
                $("#" + id).show();
                $("#changedPassword" + id).hide();
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
<br>
<div>
    <div align="center">
        <h1>Find a Study Group</h1>
        <a href="createStudyGroup.php"><h5 style="color: gray">Create a study Group</h5>  <i class="fa fa-plus"></i></a>
    </div>
    <div class="row" style="border-style: solid; border-width: 2px;">

            <!--        loop through all the "study groups" based on either the search zip that was sent in

             or the search class or subject

            and print the study card div for them-->

        <?php

        require_once 'setLogin.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if($conn->connect_error) die($conn->connect_error);
        $zip =$_POST['searchZip'];
        if(isset($_POST['searchZip'])){

            if($zip == "") {

                $query = "SELECT * from studySession;";

            } else {

                $query = "SELECT * from studySession where zip = '$zip'";
            }


        } else {
            $query = "SELECT * from studySession;";
        }


            $result = $conn->query($query);
            if(!$result) die($conn->error);

        $row_count = $result->num_rows;

        echo '<br>';
        echo '<br>';
        echo '<br>';

        echo "<script>
        function test(id){
            alert(id)}</script>";
        while ($row = mysqli_fetch_object($result)) {
            if($row->password == "") {
                $public = 'Yes';
            } else {
                $public = "No";
            }

            if($row->password != NULL) {
                // means a password is set on the study session
                echo "    
                 <div class=\"studyCard\">
                    <h3>$row->class </h3>
                    <hr>
                    <h5>Coordinator: $row->owner</h5>
                    <div style='display: none' id='$row->id'>
                    <p class=\"title\">Subject: $row->subject</p>
                    <p>School: $row->university</p>
                    <p>Date: $row->timeStart</p>
                    <p>Open to public: $public</p>
                    <form method='post' action='messagesShow.php'><input type='hidden' name='studyGroupId' value=$row->id> <button class='btn btn-success'>Messages</button> </form>
                    <a href=\"http://maps.google.com/?q='$row->Location'\"><i class=\"fa fa-map-pin\"></i> Map</a>
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
                    <p><form method='post' action='joinGroup.php'> 
                    <input name='joinGroupId' type='hidden' value=$row->id> 
                    <button class=\"button\">Join Group</button></form></p>
                    <input style='display: none' type='text' id='password$row->id' value='$row->password'>
                    </div>
                    <input id='changedPassword$row->id' onchange='password($row->id)' type='text' class='form-control' placeholder='Password'>
                </div>";
            } else {

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
        <a href=\"http://maps.google.com/?q='$row->Location'\"><i class=\"fa fa-map-pin\"></i> Map</a>
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
        <p><form method='post' action='joinGroup.php'> 
        <input name='joinGroupId' type='hidden' value=$row->id> 
        <button class=\"button\">Join Group</button></form></p>
    </div>";
            }
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
