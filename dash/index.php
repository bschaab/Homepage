<?php include_once("php/include/first.php"); ?>

<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/first.php"); ?>
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

		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/head.php"); ?>
		
	</head>
	<body>
	
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/header.php"); ?>

		<a href="#/dash/">Main</a>
		<a href="#/dash/search">Search</a>

		<a href="/php/scripts/logout.php">Log Out</a>

		<div ng-view></div>

		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/footer.php"); ?>
	</body>
</html>
