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
	<title>Reported questions | admin panel</title>
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
				<h2>Reported questions table</h2>
				<br>
				<table border="2" class='table table-hover' cellpadding="10">
					<tr style="background-color: #d1b7e2;">
					<th>S.no</th><th>Question ID</th><th>Question</th><th>Reported by</th><th>Description</th><th>Date</th><th>Delete</th></tr>
			<?php			
			$q='select * from report_question';
			$x=mysqli_query($con,$q);
			if(!$x){
				echo 'query failed! Contact develper';
			}
			else{
				$i=1;
				while ($row=mysqli_fetch_assoc($x)) {
					$qid=$row['qid'];
					$question=getQuestion($con,$qid);
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $qid;?></td>
						<td><?php echo $question;?></td>
						<td><?php echo $row['reported_by'];?></td>
						<td><?php echo $row['description'];?></td>
						<td><?php echo $row['date'];?></td>
						<td>
							<form action="<?php echo $_SERVER['PHP_SELF'];?>" method='post'>
								<button type="submit" name="deletequestion" class="btn btn-lg btn-danger"><span class='glyphicon glyphicon-trash'></span></button>
								<input type="hidden" name="qid" value="<?php echo $qid;?>">
							</form></td>
					</tr>
					<?php
					$i++;
				}
				echo "</table>";
			}
			if(isset($_POST["deletequestion"])){
				$qidd=$_POST["qid"];
				deleteQuestion($qidd,$con);
			}
			?>
			</div>			
			<?php 
			function getQuestion($conn,$qidd){
				$qry="select * from question where qid='$qidd'";
				$x=mysqli_query($conn,$qry);
				$qrow=mysqli_fetch_assoc($x);
				return $qrow['question'];
			}
			function deleteQuestion($questid,$conn){
				$q="delete from question where qid='$questid'";
				$qforreport="delete from report_question where qid='$questid'";
				$exe=mysqli_query($conn,$q);
				$x=mysqli_query($conn,$qforreport);
				if(!$exe){
					echo 'Delete failed, contact developer!';					
				}
				else{
					?>
					<script type="text/javascript">
						alert('Question deleted.');
						location.href='reportedquestiondisplay.php';
					</script>
					<?php						
				}
			}
			include 'footer.html';?>
		</body>
		</html>