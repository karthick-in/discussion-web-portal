<?php
session_start();
if(!isset($_SESSION["uname"])){
	header("location:welcomepage.php");
}
else{
	include 'dbconnection.php';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Question details | student discussion web portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
		.timing{
			font-size:15px;
			color: #5e605c;
		}
	</style>
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
				<li class="active"><a href="home.php"><span class='glyphicon glyphicon-home'></span> Home</a></li>
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
							<li style="font-size: medium;"><a href="logout.php">Logout</a></li>
						</li>
					</ul>
				</div>
			</nav>
	<div class="container">
		<?php 
		if(isset($_POST["report"])){
			?>
			<script type="text/javascript">
				alert("report clicked for...<?php echo $qid;?>");
				window.location.href = 'home.php'; 
			</script>
			<?php
		}
		//if first time is executed this if is called
		if(isset($_POST['qid']) && $_POST['qid']){
			$qid=$_POST["qid"];
			loadpage($qid,$con);
		}
		else{ //if the page reloads after first time, this else is called
			$qid=$_SESSION['qid'];					
			loadpage($qid,$con);
		}

		?><hr>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
			<textarea name="answerta" rows="5" cols="100" class="form-control" required="" placeholder="Type your answer here..."></textarea>
			<br>
			<input type="hidden" name="questid" value="<?php echo $qid;?>">
			<center>
				<input type="submit" name="submit-answer" value="Submit your answer" class="btn btn-primary">
				<input type="reset" name="" class="btn btn-primary"><br>
				<br>
			</center>
		</form>

	<?php
	if(isset($_POST['submit-answer'])){
		$uid=$_SESSION['uname'];
		$ans=$_POST['answerta'];
		$questid=$_POST['questid'];
		$insertq="insert into answer values('','$uid','$questid','$ans',CURRENT_TIME)";
		$exe_insertq=mysqli_query($con,$insertq);
		if(!$exe_insertq)
		{
			echo "<script>
			alert('query failed');</script>";
		}
		else
		{
			$_SESSION['qid']=$questid;
			?>
			<script type="text/javascript">
				//alert("Your answer submitted successfully...");
				location.href='questiondetails.php';
			</script>
			<?php
			//header("location:questiondetails.php?id=$questid");
		}
	}
	?>
	<center><a href="home.php" class="btn btn-default" role="button">Go back to home</a></center>
	<br>
	<?php
	function loadpage($qidd,$conn)
	{

		$qry="select * from question where qid='$qidd'";
		$x=mysqli_query($conn,$qry);
		$qry2="select * from answer where qid='$qidd'";
		$x2=mysqli_query($conn,$qry2);
		if(!$x && !$x2)
		{
			?>
			<script type="text/javascript">
				alert('Query execution failed...!');
			</script>
			<?php
		}
		else
		{
			$qrow=mysqli_fetch_assoc($x);
			$uname=$qrow["username"];
			$name=getName($uname,$conn);					
			echo "<i><u>Question</u></i><center><br><p class='bg-danger'><span class='glyphicon glyphicon-question-sign'></span> ".$qrow['question']."</p></center>";
			?>
			<form method="POST" action="report-question.php">
				<p class='timing'><?php echo $qrow['time']." (".$name." -".$uname." )";
				if($uname!=$_SESSION['uname']){?>
					<input type="submit" name="report" class="btn btn-link" value="Report"></p>
				</center>
				<input type="hidden" name="qid" value="<?php echo $qidd;?>">
			<?php }?>
		</form>
		
		<i><u>Available answers</u></i><br><br>
		<?php
		$i=1;
		if(mysqli_num_rows($x2)>0)
		{
			while ($arow=mysqli_fetch_assoc($x2))
			{
				$uname=$arow["username"];
				$name=getName($uname,$conn);
				?>												
				<p class="bg-success"><?php echo "<span class='glyphicon glyphicon-ok-sign'></span> ".$arow['answer'];?></p>	
				<form action="report-question.php" method="post">
					<p class='timing'><?php echo $arow['time']." (".$name." -".$uname." )";
					if($uname!=$_SESSION['uname']){?>
						<input type="hidden" name="aid" value="<?php echo $arow['aid'];?>">
						<input type="submit" class="btn btn-link" name="report-answer" value="Report"></p>
						<?php
					}
					?>
				</form>
				<?php
				$i++;
			}						
		}
		else
		{
			?>
			<center><p class="bg-danger">No answers found!</p></center>
			<?php
		}
	}
	}				
	function getName($getuname,$connect)
	{
		$quer="select name from profile where username='$getuname'";
		$xi=mysqli_query($connect,$quer);
		if($xi)
		{
			$row=mysqli_fetch_assoc($xi);			
			return $row["name"];
		}
		else {
			return false;
		}
	}
			include 'footer.html';	?>	
		</div>
	</body>
	</html>