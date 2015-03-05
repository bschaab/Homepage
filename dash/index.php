<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/first.php"); ?>

<?php 
	require_once "../php/models/Session.php";
	require_once "../php/models/User.php";
	
?>


<!DOCTYPE html>

<html ng-app="homepageApp" ng-controller="homepageController">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width" />

		<title ng:bind-template="homepage - {{hpUser.firstName}} {{hpUser.lastName}}">homepage</title>

		<!-- USING CDN FOR NOW, CHANGE LATER -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular-route.js"></script>

		<script src="/js/modules/homepage.js"></script>
		<script src="/js/modules/feed.js"></script>
		<script src="/js/modules/search.js"></script>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="../css/weather.css" rel="stylesheet">

		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/head.php"); ?>

		<link rel="stylesheet" href="/css/homepage.css" type="text/css">
	</head>
	<body onload="startTime()">
	
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/header.php"); ?>

		<a href="#/dash/">Main</a>
		<a href="#/dash/search">Search</a>
		<a href="/php/controllers/logoutUser.php">Log Out</a>
		<span>This here for debug</span>
		<div id="homepage-wrapper">
			<div id="top-bar">
				<div id="logo" class="top-bar-item">Logo Here</div><!--
			 --><div id="quickbar" class="top-bar-item">
					<ul id="quickbar-list">
						<li class="quickbar-item" ng-repeat="quickbarItem in hpUser.quickbarItems">
							<a href="{{quickbarItem.url}}">
								<img ng-src="{{quickbarItem.iconUrl}}" title="{{quickbarItem.title}}" />
							</a>
						</li>
					</ul>
				</div><!--
			 --><div id="black-bar-wrapper" class="top-bar-item">
			 		<div id="user-settings">
						<span id="user-welcome">Welcome <a id="user-name">{{ hpUser.firstName }}</a></span>
						<span id="pref-btn">PRF<!-- Replace me --></span>
						<span id="power-btn">PRW<!-- Replace me --></span>
					</div>
				</div>
			</div>
			
			<div id="categories-wrapper">
				<div id="categories">
					<span id="add-more-cats" class="category-item">
						<span class="category-text">+</span>
					</span>
					<!--  Placeholder -->
					<span class="category-item">Test Item 1</span>
					<span class="category-item">Test Item 2</span>
					<span class="category-item">Test Item 3</span>
				</div>
			</div>

			<div id="search-section">
				<input type="text" id="search-input" placeholder="Search" />
			</div>
			<div id="homepage-main" ng-view></div>

			<div id="bottom-bar">
				<div id="widgets-area" class="bottom-bar-item">
					<div id="widget-0" class="widget" ng-include="widgetsUrl[0]"></div>
					<div id="widget-1" class="widget" ng-include="widgetsUrl[1]"></div>
					<div id="widget-2" class="widget" ng-include="widgetsUrl[2]"></div>
				</div>

				<div id="info" class="bottom-bar-item">
					<div id="weather">
					</div>
				</div>
			</div>
		</div>

		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/footer.php"); ?>
		
	</body>
    <script type="text/javascript" src="/js/weather/weather.js"></script>
    <script type="text/javascript" src="/js/weather/simpleWeather.js"></script>
    <script type="text/javascript" src="/js/weather/currentTime.js"></script>
</html>
