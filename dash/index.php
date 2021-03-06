<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/first.php"); ?>

<?php 
	
	//display errors
	ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);

	//required files
	require_once "../php/models/Session.php";
	require_once "../php/models/User.php";
	require_once "../php/models/Session.php";
	
	//background selection
	$bkgd_choice = rand(1,10);
?>


<!DOCTYPE html>

<html ng-app="homepageApp" ng-controller="homepageController">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width" />

		<title ng:bind-template="homepage - {{hpUser.firstName}} {{hpUser.lastName}}">homepage</title>
        <script type="text/javascript" src="/js/calculator/math.min.js"></script>

		<!-- USING CDN FOR NOW, CHANGE LATER -->
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular-route.js"></script>

		<script src="/js/modules/homepage.js"></script>
		<script src="/js/modules/feed.js"></script>
		<script src="/js/modules/search.js"></script>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="../css/weather.css" rel="stylesheet">

		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/head.php"); ?>
		
		<!--styles-->
		<link rel="stylesheet" href="/css/homepage.css" type="text/css">
		
		<!--fonts-->
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
		
				
		<!-- Calculator Widget includes -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<link href="/css/bootstrap.icon-large.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/css/calc.css">
        <link rel="stylesheet" type="text/css" href="/css/stocks.css">
        <link rel="stylesheet" type="text/css" href="/css/todos.css">
		<script type="text/javascript" src="/js/calculator/calculator.js"></script>
		<script type="text/javascript" src="/Calculator/jscolor/jscolor.js"></script>
		<script type="text/javascript" src="/js/calculator/math.min.js"></script>
		<script src="/js/calculator/calc.js" type ="text/javascript"></script>
	</head>
	<body onload="startTime()" style="background-image: url('../img/bkgd/bkgd_<?php echo $bkgd_choice; ?>.jpg');">
	
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/header.php"); ?>
		
		
		<!--BEGIN hovering panels-->
		
		<div class="hoverPanelCurtain" ng-show="showLogInPanel || showSignUpPanel || addQuickbarPanel || addBookmarkPanel || editBookmarkPanel || editWidgetPanel || settingsPanel"
			ng-click="showLogInPanel = false; showSignUpPanel = false; addQuickbarPanel = false; addBookmarkPanel = false; editBookmarkPanel = false; editWidgetPanel = false; settingsPanel = false;"></div>
		
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
		
		<div id="addQuickbarPanel" class="hoverPanel" ng-show="addQuickbarPanel">
            <form class="form" method="post" action="/php/controllers/addQuickbarItem.php">
                <h2>My Quickbar</h2>
                <h6>here you can add a new quickbar link</h6>
                <br/>
                <div class="form-group">
                    <label class="sr-only" for="QuickbarLinkTitleInput">Title</label>
                    <input type="text" class="form-control" id="QuickbarLinkTitleInput" placeholder="Title  (ex: 'Facebook')" name="linkTitle">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="QuickbarLinkInput">Link</label>
                    <input type="text" class="form-control" id="QuickbarLinkInput" placeholder="Link  (ex: 'http://facebook.com/')" name="link">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <br/><br/>
            </form>
        </div>

        <div id="addBookmarkPanel" class="hoverPanel" ng-show="addBookmarkPanel">
            <form class="form" method="post" action="/php/controllers/addBookmarkItem.php">
                <h2>My Bookmarks</h2>
                <h6>here you can add a new bookmark</h6>
                <br/>
                <div class="form-group">
                    <label class="sr-only" for="BookmarkCategoryInput">Folder</label>
                    <input type="text" class="form-control" id="BookmarkCategoryInput" placeholder="Folder  (ex: 'News')" name="bmarkCategory">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="BookmarkNameInput">Name</label>
                    <input type="text" class="form-control" id="BookmarkNameInput" placeholder="Name  (ex: 'CNN')" name="bmarkName">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="BookmarkLinkInput">Link</label>
                    <input type="text" class="form-control" id="BookmarkLinkInput" placeholder="Link  (ex: 'http://cnn.com/')" name="bmarkLink">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
                <br/><br/>
            </form>
        </div>

        <div id="editBookmarkPanel" class="hoverPanel" ng-show="editBookmarkPanel">
            <form class="form" method="post" action="/php/controllers/editBookmarks.php">
                <h2>My Bookmarks</h2>
                <h6>here you can remove existing bookmark</h6>
                <br/>
                <div ng-repeat="bookmark in hpUser.bookmarks" class="form-group">
                    <h1>{{bookmark.categoryName}}</h1>
                    <li ng-repeat="site in bookmark.sites"><input name="deletedBmarkIdxs[]" class='toggle' type='checkbox' value={{site.bookmarkIdx}}><label data=''>&nbsp;&nbsp;{{site.bookmarkName}}</li>
                </div>
                <button type="submit" class="btn btn-primary">Delete</button>
                <br/><br/>
            </form>
        </div>
		
		<div id="editWidgetPanel" class="hoverPanel" ng-show="editWidgetPanel">
			<form class="form" method="post" action="/php/controllers/editWidgetPanel.php">
				<h2>Edit Widget Slot {{edgeWidgetPanelSlot + 1}}</h2>
				<h6>choose which widget shows in this slot</h6>
				<br/>
				<div class="form-group">
					<label class="sr-only" for="WidgetInput">Title</label>
					<select name="widget" id="WidgetInput" class="form-control">
						<option value="calc" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'calc'">Customizable Calculator</option>
						<option value="multiUtility" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'multiUtility'">Multi Utility</option>
						<option value="spotifyDeepFocus" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'spotifyDeepFocus'">Spotify Deep Focus</option>
						<option value="spotifyMixedGenParty" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'spotifyMixedGenParty'">Spotify Mixed Generations Party</option>
						<option value="spotifyTopTracks" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'spotifyTopTracks'">Spotify Top US Tracks</option>
						<option value="mathGame" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'mathGame'">Math Game</option>
						<option value="sudoku" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'sudoku'">Sudoku</option>
                        <option value="stocks" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'stocks'">Stocks</option>
                        <option value="todos" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'todos'">Todo List</option>
                        <option value="gmail" ng-selected="hpUser.widgets[edgeWidgetPanelSlot] === 'gmail'">gmail</option>

					</select>
				</div>
				<input type="hidden" name="slot" value="{{edgeWidgetPanelSlot}}"/> 
				<button type="submit" class="btn btn-primary">Select</button>
				<br/><br/>
			</form>
		</div>
		
		<div id="settingsPanel" class="hoverPanel" ng-show="settingsPanel">
			<form class="form" method="post" action="/php/controllers/editWidgetPanel.php">
				<h2>User Preferences</h2>
				<h6>tweak homepage to your personal preferences</h6>
				<br/>
				<div class="form-group">
					<div id="allow">
						<a href="/twitter/requestAuthentication.php">Sign in with Twitter</a>
						<a href="/php/controllers/instagram/requestAuthentication.php">Sign in with Instagram</a>
					</div>
				</div>
			</form>
		</div>
		
		<!--END hovering panels-->
		
		
		<!--BEGIN alert bar-->
		<div id="alertBar" ng-class="{ 'alertBarClose': 1}">
			<?php if (isset($_GET['alert'])) {$alert = $_GET['alert'];} else {$alert = "";} ?>
			
			<?php if ($alert == "dbsetup-success"): ?><p class="bg-success alertBox">Database setup successfully</p><?php endif;?>
			<?php if ($alert == "dbsetup-fail"): ?><p class="bg-danger alertBox">Database setup failed. Please try again.</p><?php endif; ?>
			
			<?php if ($alert == "create-duplicate"): ?><p class="bg-danger alertBox">This account already exists. Please log in to your existing account.</p><?php endif; ?>
			<?php if ($alert == "create-missing"): ?><p class="bg-danger alertBox">You are missing fields. Please try again.</p><?php endif; ?>
			<?php if ($alert == "create-fail"): ?><p class="bg-danger alertBox">Account creation failed. Please try again.</p><?php endif; ?>
			<?php if ($alert == "create-success"): ?><p class="bg-success alertBox">Account Created Successfully</p><?php endif; ?>
			
			<?php if ($alert == "login-fail"): ?><p class="bg-danger alertBox">Login failed. Please try again.</p><?php endif; ?>
			<?php if ($alert == "logout-success"): ?><p class="bg-success alertBox">Logout successful</p><?php endif;?>
			
			<?php if ($alert == "quickbar-add-invalid-input"): ?><p class="bg-danger alertBox">Quickbar Add Failed. You were missing required fields.</p><?php endif; ?>
			<?php if ($alert == "quickbar-add-fail"): ?><p class="bg-danger alertBox">Quickbar Add Failed. Please try again.</p><?php endif; ?>
			<?php if ($alert == "quickbar-add-success"): ?><p class="bg-success alertBox">Quickbar Add Succeeded</p><?php endif; ?>
			
			<?php if ($alert == "widget-edit-fail"): ?><p class="bg-danger alertBox">Widget Slot Change Failed. Please try again.</p><?php endif; ?>
			<?php if ($alert == "widget-edit-success"): ?><p class="bg-success alertBox">Widget Slot Successfully Changed</p><?php endif; ?>
			<?php if ($alert == "todo-duplicate"): ?><p class="bg-danger alertBox">Cannot Add Duplicates to To-Do List</p><?php endif; ?>
			<?php if ($alert == "bookmark-add-success"): ?><p class="bg-success alertBox">Bookmark Added Successfully</p><?php endif; ?>
			<?php if ($alert == "bookmark-delete-success"): ?><p class="bg-success alertBox">Bookmark Deleted Successfully</p><?php endif; ?>
			<?php if ($alert == "bookmark-delete-fail"): ?><p class="bg-danger alertBox">Please Select a Bookmark to Delete</p><?php endif; ?>
		</div>
		
		<!--END alert bar-->

		<div id="homepage-wrapper">
			<div id="top-bar">
				<div id="logo" class="top-bar-item"><img src="../img/logo.png" alt="homepage" height="100%"/></div>
				<div id="quickbar" class="top-bar-item">
					<ul id="quickbar-list">
						<li class="quickbar-item" ng-repeat="quickbarItem in hpUser.quickbarItems">
							<i class="fa fa-times quickbarItemRemoveButton" onclick="removeQuickbarItem(this)"></i>
							<a href="{{quickbarItem.url}}" title="{{quickbarItem.title}}">
								<img ng-src="{{quickbarItem.iconUrl}}"/>
							</a>
						</li>
					</ul>
					<i id="add-qb-item" class="fa fa-plus-square" ng-click="addQuickbarPanel = true" ng-show="hpUser.loggedIn"></i>
					<i id="edit-qb-item" class="fa fa-pencil-square-o" onclick="editQuickbar()" ng-show="hpUser.loggedIn"></i>
				</div><!--
			 --><div id="black-bar-wrapper" class="top-bar-item">
			 		<div id="user-settings">
						<span ng-show="hpUser.loggedIn">Welcome, {{ hpUser.firstName }}
							<span class="user-settings-btn" class="iconLink">
								<a class="fa fa-cog" ng-click="settingsPanel = true"></a>
							</span>
							<span class="user-settings-btn" class="iconLink">
								<a class="fa fa-power-off" href="/php/controllers/logoutUser.php"></a>
							</span>
						</span>
						<span id="not-logged-in" ng-show="!hpUser.loggedIn">
							<span ng-click="showLogInPanel = true" class="textLink">Log In</span>
							<span class="divider">|</span>
							<span ng-click="showSignUpPanel = true" class="textLink">Sign Up</span>
						</span>
					</div>
				</div>
			</div>
			
			<div id="bookmark-wrapper">
				<div id="bookmarks">
					<span id="add-more-bmarks" class="bookmark-category bookmark-list-item" ng-show="hpUser.loggedIn">
						<span class="category-text"><i class="fa fa-plus-square" ng-click="addBookmarkPanel = true"></i></span>
					</span>
                    <span id="add-more-bmarks" class="bookmark-category bookmark-list-item" ng-show="hpUser.loggedIn">
						<span class="category-text"><i class="fa fa-pencil-square-o" ng-click="editBookmarkPanel = true"></i></span>
					</span>
					<div id="bookmark-click-bg" ng-show="bookmarkToggle != -1" ng-click="bookmarkToggle = -1"></div>
					<div class="bookmark-category bookmark-list-item" ng-repeat="bookmark in hpUser.bookmarks" ng-click="$parent.bookmarkToggle = $parent.bookmarkToggle == $index ? -1 : $index">
						<span class="bookmark-text">{{bookmark.categoryName}}</span>
						<ul ng-show="$parent.bookmarkToggle == $index">
							<li class="bookmark-list-item" ng-repeat="site in bookmark.sites">
								<a ng-href="{{site.bookmarkUrl}}">{{site.bookmarkName}}</a>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<div id="search-section">
				<form ng-submit="search($event)">
				<input type="text" id="search-input" placeholder="Search" ng-model="searchQuery" ng-focus="searchFocus" ng-blur="searchBlur" />
				</form>
			</div>
			<div id="homepage-main" ng-view></div>

			<div id="bottom-bar">
				<div id="widgets-area" class="bottom-bar-item">

					<div class="widgetWrapper">
                    	<div class="widget" ng-include="widgetsUrl[0]"></div>
						<div class="editWidgetButton">
                    	    <i class="fa fa-pencil-square-o" ng-click="editWidgetPanel = true; edgeWidgetPanelSlot = 0;" ng-show="hpUser.loggedIn"></i>
                    	</div>
					</div>

					<div class="widgetWrapper">
                    	<div class="widget" ng-include="widgetsUrl[1]"></div>
						<div class="editWidgetButton">
							<i class="fa fa-pencil-square-o" ng-click="editWidgetPanel = true; edgeWidgetPanelSlot = 1;" ng-show="hpUser.loggedIn"></i>
                    	</div>
					</div>

					<div class="widgetWrapper">
						<div class="widget" ng-include="widgetsUrl[2]"></div>
						<div class="editWidgetButton">
                        	<i class="fa fa-pencil-square-o" ng-click="editWidgetPanel = true; edgeWidgetPanelSlot = 2;" ng-show="hpUser.loggedIn"></i>
                    	</div>
					</div>
                    

				</div><!--end widget area-->

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
		<script type="text/javascript" src="/js/weather/weather.js"></script>
		<script type="text/javascript" src="/js/weather/simpleWeather.js"></script>
		<script type="text/javascript" src="/js/weather/currentTime.js"></script>
		<script type="text/javascript" src="/js/quickbar/quickbar.js"></script>
        
        <div class="clearAll"></div>
	</body>
</html>
