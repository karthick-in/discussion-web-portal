<?php
session_start();
if(!isset($_SESSION["uname"]))
{
	header("location:welcomepage.php");
}
else{
	include 'dbconnection.php';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Event registered students | admin panel</title>
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
							<li style="font-size: medium;"><a href="logout.php">Logout</a></li></ul>
						</li>
					</ul>
				</div>
			</nav>
<div class="container">
	<h2>Cultural registered students</h2>
	<table border="2" class='table table-hover'> 
		<tr style="background-color: #d1b7e2;"><th>S.no</th><th>Cultural Event ID</th>
			<th>Username</th><th>Phone</th>
		</tr>       
		<?php
		$q="select * from cultural_registration";
		$exe=mysqli_query($con,$q);
		displayTable($exe);            
		?>		
		<hr>
		<h2>Sports registered students</h2>
		<table border="2" class='table table-hover'>
			<tr style="background-color: #d1b7e2;">
				<th>S.no</th><th>Sports Event ID</th>
					<th>Username</th><th>Phone</th>
				</tr>
			</tr>
			<?php
			$q="select * from sports_registration";
			$exe=mysqli_query($con,$q);
			displayTable($exe);
			?>    

			<?php
			function displayTable($execute){
				if(!$execute) {
					echo "query failed to execute!";
				}
				else { $i=1;
					while($row=mysqli_fetch_assoc($execute)){
						echo "<tr><td>".$i."</td><td>".$row['event_id']."</td><td>".$row['username']."</td><td>".$row['phone']."</td></tr>"; 
						$i++;
					}
					echo '</table>';
				}
			}

			include 'footer.html';?>
		</div>
</body>
</html>