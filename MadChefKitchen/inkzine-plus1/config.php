<?php
$rcsid='$Id: config.php,v 1.8 2004/08/04 16:24:58 engine Exp engine $ ';
$copyRight="Copyright (c) Ohad Aloni 1990-2004. All rights reserved.";
$licenseId="Released under http://ohad.dyndns.org/license.txt (BSD)";
/************************************************************/
$lwcVersion = '1.0' ;
$msdbConfig['DB_HOST'] = 'localhost' ;
$msdbConfig['DB_USER'] = 'lwc' ;
$msdbConfig['DB_PW'] = 'lwc' ;
$msdbConfig['DB_NAME'] = 'lwc' ;

// $msdbDir = '/usr/local/msdb' ;
$msdbDir = 'msdb' ; // ./msdb

/************************************************************/
// create data with each table lwc creates on its own
$lwcConfig['Tutor'] = false ;
// this is the default if not passed with calTable= in the url
// $lwcConfig['tableName'] = 'lwc' ;
/************************************************************/
?>
