<!DOCTYPE html>
<html>
<head>
	<title>send report</title>
</head>
<body>
	<h1>If you are 100% sure that your username cannot be registered, fill your regno and send a report here. Admin will check your problem very soon.</h1>
	<h2>Remember once you click send report, the report will be sent. Admin will take action.</h2>
	<hr><br>
	<form method="post" action=<?php echo $_SERVER["PHP_SELF"];?>>
		username (regno) <input type="text" name="uname"><br><br>
		Email <input type="email" name="mail"><br><br>
		<input type="submit" value="send report">
	</form>
	<?php
	if(isset($_POST["uname"])&&isset($_POST["uname"]))
	{
	$regno=$_POST["uname"];
	$mail=$_POST["mail"];
		include 'dbconnection.php';
		$qry="insert into report values('$regno','$mail')";
		$x=mysqli_query($con,$qry);
		if(!$x)
		{
			echo "<br><div style=color:red;>report sending failed! May be you already reported!</div>";
		}
		else
		{
			echo "<hr><br>";
			echo "<b style=color:green;>Report sent successfully</b><br><br>";
			echo "<a href=login.php>Login page</a>";
			//header('location:login.php');
		}
	}
	else
	{

	}
	?>

</body>
</html>