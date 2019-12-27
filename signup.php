<?php
session_start();
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">

	<title>Register | discussion web portal</title>
</head>
<body>	
	<center>
		<div class="container">

			<center><h2><i>Signup page</i></h2></center>
			<hr>
			<form method="post" action=<?php echo $_SERVER["PHP_SELF"];?>>
				<table class="table table-borderless text-center">
					<tr>
						<td>Firstname</td>
						<td><input type="text" class="form-control" name="fname"required placeholder="name"></td>
					</tr>
					<tr>
						<td>Lastname</td>
						<td><input type="text" class="form-control" name="lname" placeholder="optional"></td>
					</tr>
					<tr>
						<td>Username</td>
						<td><input type="text" class="form-control" name="uname" required placeholder="your register number eg: a173438"></td>
					</tr>
					<tr>
						<td>
							Password
						</td>
						<td>
							<input type="password" class="form-control" name="pass"required>
						</td>
					</tr>
					<tr>
						<td>
							Confirm Password
						</td>
						<td>
							<input type="password" class="form-control" name="pass1"required>
						</td>
					</tr>
					<tr>
						<td>Department</td>
						<td><select name="dept" class="form-control">
							<option>civil</option>
							<option>mechanic</option>
							<option>ECE</option>
							<option>computer</option>
							<option>EEE</option>
							<option>ICE</option>
							<option>paper tech</option>
						</select></td>
					</tr>
					<tr>
						<td>Email</td>
						<td><input type="email" class="form-control" name="mail" required></td>
					</tr>
					<tr>
						<td><input type="submit" name="" class="form-control btn-primary" value="submit"></td>
						<td><input type="reset" name="" class="form-control btn-primary" value="Clear"></td>
					</tr>
				</table>

			</form>
			<a href="welcomepage.php" class="btn btn-default" role="button">Go back</a>
			<?php
			if(isset($_POST["fname"])&&isset($_POST["uname"])&&isset($_POST["pass"])&&isset($_POST["pass1"])&&isset($_POST["mail"]))
			{
				$fname=$_POST["fname"];
				$uname=$_POST["uname"];
				$pass=$_POST["pass"]; 
				$pass1=$_POST["pass1"];
				$dept=$_POST["dept"];
				$mail=$_POST["mail"];

				if($pass!=$pass1)
				{
					?>
					<script type="text/javascript">
						alert("password mismatched!");
					</script>
					<?php 
				}
				else
				{
					include 'dbconnection.php';
					$qry="insert into profile values('$fname','$uname','$pass','$dept','$mail')";
					$x=mysqli_query($con,$qry);
					if(!$x)
					{
						?>
						<script type="text/javascript">
							alert("Failed to sign up. May be your username(register number) is incorrect.");
						</script>
						<?php 						
					}
					else
					{
						?>
						<script type="text/javascript">
							alert("Successfully signed up. you can login now.");
							location.href="login.php";
						</script>
						<?php						
					}
				}
			}
			?>
			<br>
			<?php include 'footer.html';?>	
		</center>
	</body>
	</html>