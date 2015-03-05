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
		
		
		<!--BEGIN hovering panels-->
		
		<div class="hoverPanelCurtain" ng-show="showLogInPanel || showSignUpPanel"
			ng-click="showLogInPanel = false; showSignUpPanel = false"></div>
		
		<div id="logInPanel" class="hoverPanel" ng-show="showLogInPanel">
			<form class="form" method="post" action="/php/controllers/loginUser.php">
				<h2>Log In</h2>
				<h6>experience the magic of homepage</h6>
				<br/>
				<div class="form-group">
			    	<label class="sr-only" for="emailLogInInput">Email</label>
					<input type="email" class="form-control" id="emailLogInInput" placeholder="Email" name="email">
				</div>
				<div class="form-group">
			    	<label class="sr-only" for="passwordLogInInput">Password</label>
					<input type="password" class="form-control" id="passwordLogInInput" placeholder="Password" name="password">
				</div>

				<button type="submit" class="btn btn-default">Sign in</button>
				<br/><br/>
				<button type="button" class="btn btn-link" id="sampleUserButton">Sample User</button>
				<a href="/php/controllers/setupDatabase.php"><button type="button" class="btn btn-link" id="setupDatabaseButton">Setup Database</button></a>
			</form>
		</div>
		
		<div id="signUpPanel" class="hoverPanel" ng-show="showSignUpPanel">
			<form class="form" method="post" action="/php/controllers/createUser.php">
				<h2>Join Homepage</h2>
				<h6>experience the magic of homepage</h6>
				<br/>
				<div class="form-group">
			    	<label class="sr-only" for="firstNameSignUpInput">First Name</label>
					<input type="text" class="form-control" id="firstNameSignUpInput" placeholder="First Name" name="firstName">
				</div>
				<div class="form-group">
			    	<label class="sr-only" for="lastNameSignUpInput">Last Name</label>
					<input type="text" class="form-control" id="lastNameSignUpInput" placeholder="Last Name" name="lastName">
				</div>
				<div class="form-group">
			    	<label class="sr-only" for="emailSignUpInput">Email</label>
					<input type="text" class="form-control" id="emailSignUpInput" placeholder="Email" name="email">
				</div>
				<div class="form-group">
			    	<label class="sr-only" for="passwordSignUpInput">Password</label>
					<input type="password" class="form-control" id="passwordSignUpInput" placeholder="Password" name="password">
				</div>
				<button type="submit" class="btn btn-primary">Sign up</button>
				<br/><br/>
				<a href="/php/controllers/setupDatabase.php"><button type="button" class="btn btn-link" id="setupDatabaseButton">Setup Database</button></a>
			</form>
		</div>
		
		<!--END hovering panels-->
		
		
		<!--BEGIN alert bar-->
		<div id="alertBar" ng-class="{ 'alertBarClose': 1}">
			<?php $alert = $_GET['alert']; ?>
			
			<?php if ($alert == "dbsetup-success"): ?><p class="bg-success alertBox">Database setup successfully</p><?php endif;?>
			<?php if ($alert == "dbsetup-fail"): ?><p class="bg-danger alertBox">Database setup failed. Please try again.</p><?php endif; ?>
			
			<?php if ($alert == "create-duplicate"): ?><p class="bg-danger alertBox">This account already exists. Please log in to your existing account.</p><?php endif; ?>
			<?php if ($alert == "create-missing"): ?><p class="bg-danger alertBox">You are missing fields. Please try again.</p><?php endif; ?>
			<?php if ($alert == "create-fail"): ?><p class="bg-danger alertBox">Account creation failed. Please try again.</p><?php endif; ?>
			<?php if ($alert == "create-success"): ?><p class="bg-success alertBox">Account Created Successfully</p><?php endif; ?>
			
			<?php if ($alert == "login-fail"): ?><p class="bg-danger alertBox">Login failed. Please try again.</p><?php endif; ?>
			<?php if ($alert == "logout-success"): ?><p class="bg-success alertBox">Logout successful</p><?php endif;?>
			
		</div>
		
		<!--END alert bar-->
		
		

		<a href="#/dash/">Main</a>
		<a href="#/dash/search">Search</a>
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
						<span ng-show="hpUser.loggedIn">Welcome, <span class="textLink">{{ hpUser.firstName }}</span>
						&nbsp; &nbsp;
						<span id="pref-btn" class="iconLink"><a href=""><i class="fa fa-cog"></i></a></span>
						&nbsp;
						<span id="power-btn" class="iconLink"><a href="/php/controllers/logoutUser.php"><i class="fa fa-power-off"></i></a></span>
						</span>
						&nbsp;
						<span ng-show="!hpUser.loggedIn">
							<span ng-click="showLogInPanel = true" class="textLink">Log In</span>
							&nbsp; | &nbsp;
							<span ng-click="showSignUpPanel = true" class="textLink">Sign Up</span>
							&nbsp;
						</span>
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
		
		
		
		
		<!--body js-->
		<script>
			$("#sampleUserButton").click(function () {
				$("#emailLogInInput").val("sample@email.com");
				$("#passwordLogInInput").val("password");
			});
		</script>
		
	</body>
	
		
	<!--js-->
    <script type="text/javascript" src="/js/weather/weather.js"></script>
    <script type="text/javascript" src="/js/weather/simpleWeather.js"></script>
    <script type="text/javascript" src="/js/weather/currentTime.js"></script>
</html>
