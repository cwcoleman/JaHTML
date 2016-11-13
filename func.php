<?php


define('USERNAME','chhur4gu');

define('password',"4+R5dD8#U~K_");

define('DBNAME','chhur4gu_rj_pic');

define('HOST','localhost');



$link=mysqli_connect(HOST,USERNAME,password) or die("Incorrect Details");

mysqli_select_db($link, DBNAME) or die("Incorrect Database");


?>