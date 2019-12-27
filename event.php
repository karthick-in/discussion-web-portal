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
  <title>Event details</title>
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
            <li class="active"><a href="event.php"><span class='glyphicon glyphicon-knight'></span> Events</a></li>
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
        <p>Register your entry in your favourite sport or cultural competition to shine in your future. Do it now!</p>
        <br>
        <form method="POST" action="registration.php"> 
          <input type="submit" name="cultural" value="Register for Cultural" class="btn btn-lg btn-primary">
          <br><br>
          <input type="submit" name="sports" value="Register for Sports" class="btn btn-lg btn-primary">
        </form>
        <br>
        <div class="container">
          <table border="1" class='table table-hover table-borderless'> 
            <caption>Cultural competition details</caption>
            <tr style="background-color: #d1b7e2;"><th>Cultural Event ID</th>
              <th>Event name</th><th>Timing</th><th>Event incharge</th>
            </tr>       
              <?php
              $q="select * from cultural";
              $exe=mysqli_query($con,$q);
              displayTable($exe);            
              ?>
            <table border="1" class='table table-hover table-borderless'>
              <caption>Sports competition details</caption>
              <tr>
                <tr style="background-color: #d1b7e2;"><th>Sports Event ID</th>
                  <th>Event name</th><th>Timing</th><th>Event incharge</th>
                </tr> 
              </tr>
                <?php
                $q="select * from sports";
                $exe=mysqli_query($con,$q);
                displayTable($exe);
                ?>                
            </div>
            <div>
            <b>About Event page</b><br>
            In this page, students can register their entries in events that they like to join
          </div>
          </center>
          <br><br><br>
          <?php 

          function displayTable($execute){
            if(!$execute) {
                echo "query failed to execute!";
              }
              else {
                while($row=mysqli_fetch_assoc($execute)){
                  echo "<tr><td>".$row['event_id']."</td><td>".$row['event_name']."</td><td>".$row['time']."</td><td>".$row['incharge']."</td></tr>"; 
                }
                echo '</table>';
              }
          }
          include 'footer.html';?> 
        </body>
        </html>