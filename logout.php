<?php
session_start();
if(!isset($_SESSION["uname"])){
	header("location:welcomepage.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout | discussion web portal</title>
</head>
<body>
	<?php
	session_destroy();	
	?>
	<script type="text/javascript">
		alert("Logged out successfully.");
		location.href="login.php";
	</script>	
</body>
</html>