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
	<title>Home page | student discussion web portal</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="main.css">
	<style type="text/css">
		.jumbotron{
			height: 150px;
		}
		.timing{
			font-size:14px;
			color: #5e605c;
		}
	</style>
</head>
<body>
	<div class="container-fluid">
		<center>
		<div class="jumbotron">
				<h1>Techart Student Discussion Web Portal</h1>
			</div>			
			<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="home.php">Web portal</a>
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
							<li style="font-size: medium;"><a href="logout.php">Logout</a></li></ul>
						</li>
					</ul>
						</div>
					</nav>
				</center>
					<div class="container">
						<span class="glyphicon glyphicon-time"></span>
					<?php echo " ".date('d-m-Y H:i:s'); ?>
					</div><center>				
					<form action="home.php" method="POST">
						<table>
							<tr>
								<td>
									<input type="text" name="search" class="form-control" width="20%" placeholder="Search" required="">
								</td>
								<td>
									<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span></button></td>
								</tr>
							</table>
						</form>
						<h2><i>Questions asked</i></h2>
					</center>
					<div class="container">
						<hr>
			<?php
			include 'dbconnection.php';
			$reportOk=0;
			if(isset($_POST["search"]))
			{
				$search=$_POST["search"];
				$q="select * from question where question like '%$search%' order by qid desc";
				loadQuestion($q,$con);
			}
			else
			{
				$qry="select * from question order by qid desc";
				loadQuestion($qry,$con);
			}
			?>
					</div><br>
					<center>
						<a href="askquestion.php" class="btn btn-warning" role="button">Ask your own questions if you dont find here...</a>
						<br><br>
						<a href="home.php" class="btn btn-default" role="button">Reload questions</a>
					</center>
					<br><br>
					<?php include 'footer.html';?>	
				</div>

	<?php
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

	function loadQuestion($querycame,$conn){
		$exe=mysqli_query($conn,$querycame);
		if(!$exe){
			echo "query failed to execute!";
		}
		else {					
			while($row=mysqli_fetch_assoc($exe))
			{
				$reportOk=0;
				$uname=$row["username"];
				$name=getName($uname,$conn);
				$question=$row['question'];
				$qid=$row['qid'];
				if($uname!=$_SESSION['uname']){
					$reportOk=1;
				}
				$timing=$row["time"];
				echo "<span class='glyphicon glyphicon-question-sign'></span>"." <b>$name</b> : ".$question."<br>";
				?>
				<p class="timing"><?php echo $timing." (".$uname." )";?></p>
				<?php
				$qry="select * from answer where qid='$qid'";
				$x=mysqli_query($conn,$qry);
				$answer="";
				if($x)
				{
					$answer_row=mysqli_fetch_assoc($x);
					$answer=$answer_row['answer'];
				}
				show_details($answer,$qid,$reportOk);
			}
		}
	}

	function show_details($ans,$questionid,$reportok)
	{
		?>					
		<form method="POST" action="questiondetails.php">
			<textarea rows="3" cols="10" placeholder="No answers found!" class="form-control" required="" disabled=""><?php echo $ans;?></textarea>
			<br>
			<input type="hidden" name="qid" value="<?php echo $questionid;?>">
			<center>
				<input type="submit" name="details" class="btn btn-primary" value="View details or answer...">
			</form>
			<form method="POST" action="report-question.php">
				<br>
				<?php 
				if($reportok==1){
					?><input type="submit" name="report" class="btn btn-primary" value="Report this question">
					<?php
				}
				?>							
			</center>
			<input type="hidden" name="qid" value="<?php echo $questionid;?>">
		</form>
		<hr>
		<?php
	}				
	?>
			</body>
			</html>				