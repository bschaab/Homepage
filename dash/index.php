<?php 
	
	require($_SERVER['DOCUMENT_ROOT'] . "/php/include/first.php");
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>homepage</title>
		
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/head.php"); ?>
		
	</head>
	<body class="loginBody">
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/header.php"); ?>
		
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				
				<h1>homepage</h1>
				
				<div class="row">
					<div class="col-xs-12">
						
						You are logged in. Welcome to your very empty homepage.
						<br/><br/>
						<a href="/php/scripts/logout.php">Log Out</a>
						
					</div>
				</div>
				
				
			</div>
			<div class="col-xs-1"></div>
		</div>
		
		
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/footer.php"); ?>
	</body>
</html>