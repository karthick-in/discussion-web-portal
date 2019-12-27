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
	<title>Add competitions | admin panel</title>
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
		<?php
		if (isset($_POST['addcultural'])) {
			$eventname=$_POST['eventname'];
			$time=$_POST['time'];
			$incharge=$_POST['incharge'];
			$q="insert into cultural values('','$eventname','$time','$incharge')";
			addEvent($con,$q);
		}
		if (isset($_POST['addsports'])) {
			$eventname=$_POST['eventname'];
			$time=$_POST['time'];
			$incharge=$_POST['incharge'];
			$q="insert into sports values('','$eventname','$time','$incharge')";
			addEvent($con,$q);		}
		?>
		<h2>Cultural competition</h2>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' class='form-group'>
			Event name 	<input type="text" name="eventname" class="form-control" required="">
			Time 	<input type="date" name="time" class="form-control" required="">
			Staff incharge 	<input type="text" name="incharge" class="form-control" required="">
			<br><center>
			<input type="submit" name="addcultural" class="btn btn-success" value="Add">
			<input type="reset" name="" value=" Clear" class="btn btn-success"></center>
		</form>
		<hr>
		<h2>Sports competition</h2>
		<form action="<?php echo $_SERVER['PHP_SELF'];?>" method='post' class='form-group'>
			Event name 	<input type="text" name="eventname" class="form-control" required="">
			Time 	<input type="date" name="time" class="form-control" required="">
			Staff incharge 	<input type="text" name="incharge" class="form-control" required="">
			<br><center>
				<input type="submit" name="addsports" class="btn btn-success" value="Add">
			<input type="reset" name="" value=" Clear" class="btn btn-success"></center>
			</form>
		</div>
			<?php
			function addEvent($conn,$qry){
				$x=mysqli_query($conn,$qry);
				if(!$x){
					?>
					<script type="text/javascript">
						alert('Failed to add.. May be already added!');
						location.href='addcompetition.php';
					</script>
					<?php
				}
				else{
					?>
					<script type="text/javascript">
						alert('Event added successfully.');
						location.href='addcompetition.php';
					</script>
					<?php
				}
			}
			include 'footer.html';?>			
		</body>
		</html>