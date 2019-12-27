<?php
if(!isset($_SESSION["uname"]))
{
	//header("location:welcomepage.php");
}
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">	
</head>
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="home.php">Web portal</a>
		</div>
		<ul class="nav navbar-nav">
			<li class="active"><a href="home.php">Home</a></li>
			<li><a href="askquestion.php">Ask question</a></li>
			<li><a href="event.php">Events</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<span class="glyphicon glyphicon-user"></span> profile</a>
					<ul class="dropdown-menu">
						<li style="font-size: medium;">&nbsp;
							Welcome <?php echo $_SESSION["name"]; ?>
						</li>
						<li class="divider"></li>
						<li style="font-size: medium;"><a href="profile.php">Information</a></li>
						<li style="font-size: medium;"><a href="changeinfo.php">Reset password</a></li>
						<li style="font-size: medium;"><a href="logout.php">Logout</a></li>
					</li>
				</ul>
			</div>
		</nav>
		<br>
		</html>