<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/first.php"); ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>homepage</title>
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/head.php"); ?>
	</head>
	<body>
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/header.php"); ?>
		
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				
				<h1>homepage</h1>
				<div class="row">
					<div class="col-xs-12">
						
						<form class="form-inline">
							<div class="form-group">
						    	<label class="sr-only" for="exampleInputEmail3">Email address</label>
								<input type="email" class="form-control" id="exampleInputEmail3" placeholder="Enter email">
							</div>
							<div class="form-group">
						    	<label class="sr-only" for="exampleInputPassword3">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
							</div>
							<div class="checkbox">
								<label><input type="checkbox"> Remember me</label>
							</div>
							<button type="submit" class="btn btn-default">Sign in</button>
						</form>
						
					</div>
				</div>
				
				
			</div>
			<div class="col-xs-1"></div>
		</div>
		
		
		<?php require($_SERVER['DOCUMENT_ROOT'] . "/php/include/footer.php"); ?>
	</body>
</html>