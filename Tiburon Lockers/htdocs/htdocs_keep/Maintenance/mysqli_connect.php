<?php
DEFINE ('DB_U', 'RobertD');
DEFINE ('DB_PW', 'LemonShark');
DEFINE ('DB_H', 'localhost');
DEFINE ('DB_N', 'tlmr');
$dbcon = mysqli_connect (DB_H, DB_U, DB_PW, DB_N)
OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
mysqli_set_charset($dbcon, 'utf8');
