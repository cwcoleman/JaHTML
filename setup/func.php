<?php


define('USERNAME','root');

define('password',"");

define('DBNAME','pro');

define('HOST','localhost');



$link=mysqli_connect(HOST,USERNAME,password) or die("Incorrect Details");

mysqli_select_db($link, DBNAME) or die("Incorrect Database");


?>