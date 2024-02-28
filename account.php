<?php
session_start();

if(!$_SESSION['user_data']) {
    header("Location: http://csadler.uosweb.co.uk/DIR HERE/index.php");
    die();
}

?>
