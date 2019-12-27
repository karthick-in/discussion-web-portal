<?php
session_start();
if(!isset($_SESSION["uname"]))
{
	header("location:welcomepage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>update info | student discussion web portal</title>
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
							<li style="font-size: medium;"><a href="logout.php">Logout</a></li>
						</li>
					</ul>
				</ul>
			</div>
		</nav>
		<center>
			<h1>Edit information</h1>
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
			<p>Username 	:	<?php echo $row['username'];?></p>
			<?php
			?>
			<hr>

			<div class="container">
				<form method=post action=updateinfo.php>
					<table class="table text-center table-hover table-borderless">
						<caption>Edit</caption>
						<tr>
							<td>Name</td>
							<td><input type="text" class="form-control" name=fname value=<?php echo $row['name'];?>></td>
						</tr>
						<tr>
							<td>Department</td>
							<td><select name="dept" class="form-control" selected="selected" value=<?php echo $row['department'];?>>
								<option value="civil"<?=$row['department'] == 'civil' ? ' selected="selected"' : '';?>>civil</option>
								<option value="mechanic"<?=$row['department'] == 'mechanic' ? ' selected="selected"' : '';?>>mechanic</option>
								<option value="ECE"<?=$row['department'] == 'ECE' ? ' selected="selected"' : '';?>>ECE</option>
								<option value="computer"<?=$row['department'] == 'computer' ? ' selected="selected"' : '';?>>computer</option>
								<option value="EEE"<?=$row['department'] == 'EEE' ? ' selected="selected"' : '';?>>EEE</option>
								<option value="ICE"<?=$row['department'] == 'ICE' ? ' selected="selected"' : '';?>>ICE</option>
								<option value="paper tech"<?=$row['department'] == 'paper tech' ? ' selected="selected"' : '';?>>paper tech</option>
							</select></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="email" class="form-control" name=mail value=<?php echo $row['email'];?>></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" class="form-control" name="pass" value="<?php echo $row["password"];?>"></td>
						</tr>
						<tr>
							<td>Confirm Password</td>
							<td><input type="password" class="form-control" name="pass1" value="<?php echo $row["password"];?>"></td>
						</tr>
					</table>
					<p>Once you click save button, you will be logged out to update your data</p>
					<input type="submit" class="btn btn-block btn-info btn-lg" value="Save">
				</form>
				<br><br>
				<?php include 'footer.html';?>	
			</div>
		</center>
	</body>
	</html>