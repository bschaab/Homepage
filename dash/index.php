<?php include_once("php/include/first.php"); ?>

<!DOCTYPE html>

<html ng-app="homepageApp">
	<head>
		<meta charset="utf-8">

		<link rel="stylesheet" href="/css/homepage.css" type="text/css">

		<!-- USING CDN FOR NOW, CHANGE LATER -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular-route.js"></script>

		<script src="/js/modules/homepage.js"></script>
		<script src="/js/modules/feed.js"></script>
		<script src="/js/modules/search.js"></script>

		<?php include_once("php/include/head.php"); ?>
	</head>
	<body>
		<?php include_once("php/include/header.php"); ?>

		<a href="#/dash/">Main</a>
		<a href="#/dash/search">Search</a>

		<div ng-view></div>

		<?php include_once("php/include/footer.php"); ?>
	</body>
</html>

