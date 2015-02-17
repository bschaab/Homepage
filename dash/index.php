<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/first.php"); ?>
<!DOCTYPE html>

<html ng-app="homepageApp">
	<head>
		<meta charset="utf-8">

		<link rel="stylesheet" href="/css/homepage.css" type="text/css">

		<!-- USING CDN FOR NOW, CHANGE LATER -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular-route.js"></script>
		<script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>


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
		<span>This here for debug</span>

		<div id="top-bar">
			<div id="logo" class="top-bar-item">Homepage</div><div id="quickbar" class="top-bar-item">
				<ul id="quickbar-list">
					<li class="quickbar-item">FB</li>
				</ul>
			</div><!--
		--><div id="black-bar-wrapper" class="top-bar-item"><!--
		--><div id="user-settings">
					<span id="user-welcome">Welcome <a id="user-name">Matt</a></span>
					<span id="pref-btn"></span>
					<span id="power-btn"></span>
				</div>
			</div>
		</div>
		
		<div id="categories">
			<span id="add-more-cats" class="category-item"></span>
		</div>

		<div id="homepage-main" ng-view></div>

		<div id="bottom-bar">
			
			<div id="widget-1" class="widget"></div>
			<div id="widget-2" class="widget"></div>
			<div id="widget-3" class="widget"></div>
			
			<div id="info">
				<div id="info-weather">
					<span>It's snowing</span>
				</div>
				<div id="location-info">
					<span>Champaign, IL</span>
					<span>13:00</span>
				</div>
			</div>
		</div>

		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/footer.php"); ?>
		
	</body>
</html>
