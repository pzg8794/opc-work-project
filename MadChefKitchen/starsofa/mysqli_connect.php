<?php
// This file provides the information for accessing the database and connecting to MySQL. It also sets the language coding to utf-8
// First we define the constants:

DEFINE('DB_USER', 'madchef');
DEFINE('DB_PASSWORD', 'Brando2025');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'madchef_classes');

//Make the connection
$dbcon = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' .mysqli_connect_error() );

//setting
mysqli_set_charset($dbcon, 'utf8');
?>