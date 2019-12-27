<?php
session_start();
if(!isset($_SESSION["uname"]))
{
	header("location:welcomepage.php");
}
else
{
	include 'dbconnection.php';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Report question | student discussion web portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div class="container-fluid">
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
					<li class="active"><a href="report-question.php"><span class='glyphicon glyphicon-remove-circle'></span> Report question</a></li>
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
					</ul>
				</div>
			</nav>
			<center>
	<?php
	//report submission part
	if(isset($_POST["reportbtn"]))
	{
		$qidd=$_POST["qid"];
		$reportdesc=$_POST["report-desc"];
		$reported_by=$_SESSION["uname"];

		$queryy="insert into report_question values('$qidd','$reported_by',CURRENT_TIME,'$reportdesc')";
		$exe=mysqli_query($con,$queryy);
		if(!$exe)
		{
			echo "Report submission query failed!";
			?>
			<script type="text/javascript">
				alert("Report failed, You may have already reported this question!");
				location.href="home.php";
			</script>
			<?php
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Question reported succesfully...");
				location.href="home.php";
			</script>
			<?php
		}
	}
	if(isset($_POST["reportans"])){
		$aidd=$_POST["aid"];
		$reportdesc=$_POST["report-desc"];
		$reported_by=$_SESSION["uname"];
		$queryy="insert into report_answer values('$aidd','$reported_by',CURRENT_TIME,'$reportdesc')";
		$exe=mysqli_query($con,$queryy);
		if(!$exe)
		{
			echo "Report submission query failed!";
			?>
			<script type="text/javascript">
				alert("Report failed, You may have already reported this answer!");
				location.href="home.php";
			</script>
			<?php
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Answer reported succesfully...");
				location.href="home.php";
			</script>
			<?php
		}
	}
	if (isset($_POST['report-answer'])) {
		$aid=$_POST['aid'];
		$qry="select * from answer where aid='$aid'";
		$x=mysqli_query($con,$qry);
		if(!$x)
		{
			echo "Query failed to execute";
		}
		else
		{
			$row=mysqli_fetch_assoc($x);
			?>
			<div class="container">
				<b><i>Answer</i></b><br>
				<h3 class="bg-success"><?php echo $row["answer"];?></h3	>
				<hr>
				<p><i>Why do you want to report this answer?</i></p>

				<form method="POST" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
					<textarea placeholder="Report description is must" name="report-desc" rows="4" class="form-control" required=""></textarea>
					<input type="hidden" name="aid" value=<?php echo $aid; ?>>
					<br>
					<input type="submit" name="reportans" class="btn btn-lg btn-danger" value="Report">
				</form>
			</div>
			<?php
		}
	}
	if(isset($_POST["report"]))
	{
		$qid=$_POST["qid"];
		$qry="select * from question where qid='$qid'";
		$x=mysqli_query($con,$qry);
		if(!$x)
		{
			echo "Query failed to execute";
		}
		else
		{
			$row=mysqli_fetch_assoc($x);
			?>
			<div class="container">
				<b><i>Question</i></b><br>
				<h3 class="bg-danger"><?php echo $row["question"];?></h3	>
				<hr>
				<p><i>Why do you want to report this question?</i></p>

				<form method="POST" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
					<textarea placeholder="Report description is must" name="report-desc" rows="4" class="form-control" required=""></textarea>
					<input type="hidden" name="qid" value=<?php echo $qid; ?>>
					<br>
					<input type="submit" name="reportbtn" class="btn btn-lg btn-danger" value="Report">
				</form>
			</div>
			<?php
		}
	}
	?>
				<br><br>
				<?php include 'footer.html';?>	
			</center>
		</body>
		</html>