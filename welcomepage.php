<!DOCTYPE html>
<html>
<head>
	<title>Get started with our discussion web portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div class="container-fluid">
		<div class="jumbotron">
			<h1>TechArt Student Discussion Web Portal</h1>
		</div>
		<hr>
		<center>
			<div class="container">
				<i><h1 class="text-success" style="">Welcome to our students discussion world... Join us to get better.</h1></i>
				<hr>
				<form method="POST" action=<?php echo $_SERVER["PHP_SELF"];?>>
					<table class="table text-center table-borderless">
						<caption>Get inside our discussion world. Join us by login or signup your new account right now...</caption>
						<tr>
							<td><input type="submit" name="login" value="Login" class="btn btn-block btn-primary btn-lg"></td>
							<td><input type="submit" name="signup" value="Signup" class="btn btn-block btn-primary btn-lg"></td>
						</tr>
					</table>
				</form>
				<?php
				if (isset($_POST['login'])) {
					header("location:login.php");
				}
				else if (isset($_POST['signup'])) {
					header("location:signup.php");					
				}
				?>
				<hr>
				<h1>About</h1>
				<p class="para">
					This is a web application which let students discuss their technical doubts among other students. It helps students to blow away their doubts as soon as possible...Sign up now to join the discussion.
				</p>
			</div>
		</center>		
		<?php include 'footer.html';?>	
	</div>
</body>