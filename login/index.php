<?php 
	
	//keep sessions alive for 2 weeks
	ini_set('session.gc_maxlifetime', 3600 * 24 * 7 * 2);
	ini_set('session.cookie_lifetime', 3600 * 24 * 7 * 2);
	session_start();
	
	date_default_timezone_set('America/Chicago');
	$noCache = time(); 
	
	//check that we are not logged in
	if (isset($_SESSION['userID'])) {
		header('Location: /');
		exit;
	}
	
	$alert = $_GET['alert'];
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>homepage | Login</title>
		
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/head.php"); ?>
		
		<!--css-->
		<link href="/css/login.css" rel="stylesheet">
		
	</head>
	<body class="loginBody">
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/header.php"); ?>
		
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				
				<div class="row">
					<div class="col-xs-12">
						<?php if ($alert == "dbsetup-success"): ?><p class="bg-success alertBox">Database Setup Successfully</p><?php endif;?>
						<?php if ($alert == "dbsetup-fail"): ?><p class="bg-danger alertBox">Database Setup Failed. Please try again.</p><?php endif; ?>
						<?php if ($alert == "create-missing"): ?><p class="bg-danger alertBox">You are missing fields. Please try again.</p><?php endif; ?>
						<?php if ($alert == "login-fail"): ?><p class="bg-danger alertBox">Login Failed. Please try again.</p><?php endif; ?>
						<?php if ($alert == "logout-success"): ?><p class="bg-success alertBox">Logout Successful</p><?php endif;?>
					</div>
				</div>
				
				<h1>homepage</h1>
				
				<div class="row">
					<div class="col-xs-12">
						
						<form class="form-inline" method="post" action="/php/controllers/loginUser.php">
							<div class="form-group">
						    	<label class="sr-only" for="emailLogInInput">Email</label>
								<input type="email" class="form-control" id="emailLogInInput" placeholder="Email" name="email">
							</div>
							<div class="form-group">
						    	<label class="sr-only" for="passwordLogInInput">Password</label>
								<input type="password" class="form-control" id="passwordLogInInput" placeholder="Password" name="password">
							</div>

							<button type="submit" class="btn btn-default">Sign in</button>
						</form>
						
					</div>
				</div>
				
				<button type="button" class="btn btn-link" id="sampleUserButton">Sample User</button>
				<a href="/php/controllers/setupDatabase.php"><button type="button" class="btn btn-link" id="setupDatabaseButton">Setup Database</button></a>
				
				
				<div class="row">
					<div class="col-sm-4 col-xs-1"></div>
					<div class="col-sm-4 col-xs-10 text-center signUpBox">
						
						<form method="post" action="/php/controllers/createUser.php">
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
						</form>
						
					</div>
					<div class="col-sm-4 col-xs-1"></div>
				</div>
				
				
			</div>
			<div class="col-xs-1"></div>
		</div>
		
		
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/footer.php"); ?>
		
		<!--js-->
		<script>
			$("#sampleUserButton").click(function () {
				$("#emailLogInInput").val("sample@email.com");
				$("#passwordLogInInput").val("password");
			});
		</script>
	</body>
</html>