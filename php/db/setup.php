<?php 
	
	error_reporting(1);
	
	//open database connection
	$connection = mysql_connect("localhost","root","root");
	if (!$connection) {
		die("Database connected failed:" . mysql_error());
	}
	
	$query = "DROP DATABASE homepageDB";
	if (!mysql_query($query, $connection)) {
		die("Database query failed:" . mysql_error());
	}
	
	$query = "CREATE DATABASE homepageDB";
	if (!mysql_query($query, $connection)) {
		die("Database query failed:" . mysql_error());
	}
	
	mysql_select_db("homepageDB", $connection);
	
	$query = "CREATE TABLE users (
				id int(16) UNIQUE NOT NULL AUTO_INCREMENT,
				lastName varchar(255),
				firstName varchar(255),
				email varchar(255) UNIQUE,
				password varchar(512),
				PRIMARY KEY (id)
				);";
	if (!mysql_query($query, $connection)) {
		die("Database query failed:" . mysql_error());
	}
	
	
	
	echo "Database Setup Complete!";
	
	echo "<br/><br/><a href='/testing'>Click to return</a>";

?>