<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>forgot password</title>
</head>
<body>
	<?php
	
	$email=$_SESSION["email"];
	$pwd=$_SESSION["pwd"];

	$mailto = $email;
	$mailSub = "Forgot password";
	$mailMsg = "Your password from TechArt student discussion web portal is ".$pwd;
	require 'PHPMailer-master/PHPMailerAutoload.php';
	$mail = new PHPMailer();
	$mail ->IsSmtp();
	$mail ->SMTPDebug = 0;
	$mail ->SMTPAuth = true;
	$mail ->SMTPSecure = 'ssl';
	$mail ->Host = "smtp.gmail.com";
   $mail ->Port = 465; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "<youremail>@gmail.com";
   $mail ->Password = "<yourpassword>";
   $mail ->SetFrom("<yoursetfromemail>@gmail.com");
   $mail ->Subject = $mailSub;
   $mail ->Body = $mailMsg;
   $mail ->AddAddress($mailto);
   if(!$mail->Send())
   {
   		?>
   		<script type="text/javascript">
   			alert("mail not sent");
   			location.href="login.php";
   		</script>
   		<?php
   }
   else
   {
   		session_destroy(); 		
   		?>
   		<script type="text/javascript">
   			alert("mail sent successfully.");
   			location.href="login.php";
   		</script>
   		<?php   	 	   		
   }
?>
</body>
</html>
