<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/first.php"); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>homepage</title>
		
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
						<p class="bg-danger alertBox">Login Failed. Please try again.</p>
					</div>
				</div>
				
				<h1>homepage</h1>
				
				<div class="row">
					<div class="col-xs-12">
						
						<form class="form-inline">
							<div class="form-group">
						    	<label class="sr-only" for="emailLogInInput">Email</label>
								<input type="email" class="form-control" id="emailLogInInput" placeholder="Email" name="email">
							</div>
							<div class="form-group">
						    	<label class="sr-only" for="passwordLogInInput">Password</label>
								<input type="password" class="form-control" id="passwordLogInInput" placeholder="Password" name="password">
							</div>
							
							<div class="checkbox">
								<label><input type="checkbox" name="remember"> Remember me</label>
							</div>

							<button type="submit" class="btn btn-default">Sign in</button>
						</form>
						
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-sm-4 col-xs-1"></div>
					<div class="col-sm-4 col-xs-10 text-center signUpBox">
						
						<form>
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
								<input type="text" class="form-control" id="passwordSignUpInput" placeholder="Password" name="password">
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
	</body>
</html>