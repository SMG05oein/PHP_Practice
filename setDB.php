<?php
ini_set( 'display_errors', '0' );
$hostname="localhost";
$dbuserid="root";
$dbpasswd="SMG05!eoin";
$dbname="testDB";

$mysqli = new mysqli($hostname, $dbuserid, $dbpasswd, $dbname);
if ($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_error);
}
?>
