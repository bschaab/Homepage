<?php 
	// 1. Create a database connection
	error_reporting(0);
	$connection = mysql_connect("localhost","root","root");
	if (!$connection) {
		die("Database connected failed:" . mysql_error());
	}
	
	// 2. Select database to use
	$db_select = mysql_select_db("homepageDB", $connection);
	if (!$db_select) {
		die("Database selection failed:" . mysql_error());
	}
?>