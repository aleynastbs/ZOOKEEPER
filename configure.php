<?php
if(!defined('host')) define('host', 'jdbc:mysql://localhost/');
if(!defined('dbname')) define('dbname', 'cs353');
if(!defined('username')) define('username', 'user');
if(!defined('password')) define('password', 'user');
$mysqli = new mysqli(host, username, password, dbname);
if($mysqli->connect_errno){
    echo "Failed to connect to MySQl: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
?>