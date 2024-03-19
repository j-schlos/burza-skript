<?php
$database = 'ete32e_2324zs_06';
$username = 'ete32e_2324zs_06';
$password = '150sF6T098!32';
$mysqli = new mysqli('localhost',$username,$password,$database);
if ($mysqli->connect_errno) { echo 'Failed to connect to MySQL: '.$mysqli->connect_error; exit(); } else { echo 'Connection to DB is OK.'; }
