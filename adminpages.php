<?php
if($_SESSION['uname']=='admin'){
	?>
	<li class="dropdown">	
	<a class="dropdown-toggle" data-toggle="dropdown" href="#">
		<span class="glyphicon glyphicon-pencil"></span> Admin panel</a>
		<ul class="dropdown-menu">
			<li style="font-size: medium;"><a href="reportedquestiondisplay.php">View reported Questions</a></li>
			<li style="font-size: medium;"><a href="addcompetition.php">Add competitions</a></li>
			<li style="font-size: medium;"><a href="eventstudents.php">Event registered students</a></li>
			<li class="divider"></li>
			<li style="font-size: medium;"><a href="logout.php">Logout</a></li></ul>
		</li>
			<?php
		}
		?>