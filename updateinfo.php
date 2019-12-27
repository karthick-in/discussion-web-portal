<?php
session_start();
if(!isset($_SESSION["uname"]))
{
	header("location:login.php");
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
	
	<?php
	if(isset($_POST["fname"])&&isset($_POST["pass"]))
	{
		$fname=$_POST["fname"];
		$pass=$_POST["pass"];
		$pass1=$_POST["pass1"];
		$dept=$_POST["dept"];
		$mail=$_POST["mail"];
		include 'dbconnection.php';
		if($pass!=$pass1)
		{
			?>
			<script type="text/javascript">
				alert("password mismatched!");
				location.href="changeinfo.php";
			</script>
			<?php 
		}
		else
		{	
			$un=$_SESSION["uname"];
			$qry="update profile set name='$fname',password='$pass',department='$dept',email='$mail' where username='$un'";
			$x1=mysqli_query($con,$qry);
			if(!$x1)
			{
				?>
				<script type="text/javascript">
					alert("Failed to update..!");
					location.href="profile.php";
				</script>
				<?php 
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Profile updated successfully...");
					location.href="login.php";
				</script>			
				<?php 
				session_destroy();
			}
		}
	}

	?>
</body>
</html>
