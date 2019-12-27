<?php
session_start();
if(!isset($_SESSION["uname"]))
{
	header("location:Welcomepage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>profile | student discussion web portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" onclick="goBack()"><span class="glyphicon glyphicon-arrow-left"></span> Web portal</a>
          <script>
            function goBack() {
              window.history.back();
            }
          </script>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="home.php"><span class='glyphicon glyphicon-home'></span> Home</a></li>
            <li><a href="askquestion.php"><span class='glyphicon glyphicon-question-sign'></span> Ask question</a></li>
            <li><a href="event.php"><span class='glyphicon glyphicon-knight'></span> Events</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php include 'adminpages.php';?>
				<li class="dropdown active">
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
				</ul>
			</div>
		</nav>			
		<center>
			<h1>Your profile</h1>
			<hr>
			<br>
			<?php
			include 'dbconnection.php';
			$un=$_SESSION["uname"];
			$qry="select * from profile where username='$un'";
			$x=mysqli_query($con,$qry);
			if(!$x)
			{
				echo "query failed to execute";
			}
			$row=mysqli_fetch_assoc($x);
			?>
			<div class="container">
				<table class="table text-center table-hover table-borderless">
					<caption>Information</caption>
					<tr>
						<td>Name</td><td><?php echo $row['name'];?></td>
					</tr>
					<tr>
						<td>Username</td><td><?php echo $row['username'];?></td>
					</tr>
					<tr>
						<td>Department</td><td><?php echo $row['department'];?></td>
					</tr>
					<tr>
						<td>Email</td><td><?php echo $row['email'];?></td>
					</tr>
				</table>
			</div>
			<?php
			?>
			<form action="changeinfo.php">
				<hr>
				<input type="submit" class="btn btn-info btn-lg" value="Edit">
				&nbsp;&nbsp;
				<a href="home.php" class="btn btn-info btn-lg" role="button">Home</a>
			</form><br>
			<p>You can change your information like login password by clicking on Edit button.</p>
		</center>
		<br><br>
		<?php include 'footer.html';?>	
	</body>
	</html>

