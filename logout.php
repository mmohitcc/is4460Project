<?php
destroy_session_and_data();

function destroy_session_and_data(){
    $_SESSION = array();
    setcookie(session_name(), '', time()-2592000, '/');
    session_destroy();

    header("location: login.php");
}

?>