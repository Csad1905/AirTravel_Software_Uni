<?php
session_start();
session_destroy();
$_SESSION = null;
header("Location: http://csadler.uosweb.co.uk/index.php?logout=1");
die();