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

	<title>Login | discussion web portal</title>
</head>
<body>
	<div class="container-fluid">
		<div class="jumbotron">
			<h1>TechArt Student Discussion Web Portal</h1>
		</div>
		<center><h2><i>Login page</i></h2></center>
		<hr>
		<?php		
		if(isset($_POST["uname"]) && isset($_POST["pass"]))
		{
			if($_POST["uname"]!=null || $_POST["uname"]!="")
			{
				$uname=$_POST["uname"];
				$pass=$_POST["pass"];
				$_SESSION["uname"]=$uname;
				include 'dbconnection.php';
				$qry="select * from profile where username='$uname' and password='$pass'";
				$x=mysqli_query($con,$qry);
				if(mysqli_num_rows($x)>0)
				{
					$row=mysqli_fetch_assoc($x);
					$_SESSION["name"]=$row["name"];
					header("location:home.php");
				}
				else
				{				
					echo "<center><p style=color:red;>wrong username or password!</p></center>";
				}
			}
		}
		?>
		<form method="post" action=<?php echo $_SERVER["PHP_SELF"];?>>
			<center>
				<div class="container">
					<table class="text-center">
						<tr>
							<td>Username&nbsp;&nbsp;&nbsp;</td>
							<td><input type="text" name="uname" class="form-control" placeholder="regno" required></td>
						</tr>
						<tr>
							<td>Password&nbsp;&nbsp;&nbsp;</td>
							<td><input type="password" class="form-control" name="pass" placeholder="password" required></td>
						</tr>
					</table><br>
					<input type="submit" class="btn btn-primary" value="Login">
					&nbsp;&nbsp;
					<input type="reset" class="btn btn-primary" value="Reset">
					<br><br>	
					<p>Can't remember the password? click here<input type="submit" name="forgot-pwd" class="btn btn-link btn-md" value="Forgot password?" formnovalidate=""></p>
					<p>New user? Sign up<a href="signup.php"> here</a></p>
				</div>
			</center>
		</form>
		<br>
		<?php include 'footer.html';?>	
	</div>
	<?php
	if(isset($_POST["forgot-pwd"]))
	{			
		if($_POST["uname"]!="" || $_POST["uname"]!=null)
		{
			$checkuname=$_POST["uname"];

			$qry="select * from profile where username='$checkuname'";
			$xreturn=mysqli_query($con,$qry);
			if(mysqli_num_rows($xreturn)>0)
			{
				$row=mysqli_fetch_assoc($xreturn);	
				$_SESSION["email"]=$row["email"];
				$_SESSION["pwd"]=$row["password"];
				header("location:forgotpassword.php");
			}
			else
			{	
				?>
				<script type="text/javascript">
					alert("Invalid username");
				</script>
				<?php
			}
		}
		else
		{
			?>
			<script>
				alert('Enter your username to get password to your mail..');
			</script>
			<?php
		}
	}
	?>
</body>
</html>