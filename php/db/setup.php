<?php 
	
	error_reporting(1);
	
	//open database connection
	$connection = mysql_connect("localhost","root", "root");
	if (!$connection) {
		die("Database connected failed:" . mysql_error());
	}
	
	//drop old database if exists
	$query = "DROP DATABASE homepageDB";
	mysql_query($query, $connection);
	
	//create new database
	$query = "CREATE DATABASE homepageDB";
	if (!mysql_query($query, $connection)) {
		die("Database query failed:" . mysql_error());
	}
	
	//select our new database
	mysql_select_db("homepageDB", $connection);
	
	//create the users table
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
	
	//create a sample user
	$password = password_hash("password", PASSWORD_DEFAULT);
	$query = "INSERT INTO users
				(lastName, firstName, email, password) VALUES
				('User', 'Sample', 'sample@email.com', '$password');";
	if (!mysql_query($query, $connection)) {
		die("Database query failed:" . mysql_error());
	}
	
	
	
	echo "Database Setup Complete!";
	
	echo "<br/><br/><a href='/testing'>Click to return</a>";

?>