<?php

$db_config = [
    "db_host" => "185.114.98.6",
    "db_name" => "airTravelDB",
    "db_user" => "csadleruoswebco_",
    "db_pass" => "password"
];

try {
    $Conn = new PDO("mysql:host=".$db_config['db_host'].";dbname=".$db_config['db_name'], $db_config['db_user'], $db_config['db_pass']);
} catch (PDOException $e) { }
