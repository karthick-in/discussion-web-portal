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
  <title>Registration page | student discussion web portal</title>
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
        <div class="container">
          <?php

          //cultural registration

          if(isset($_POST["cultural-register"]))
          {
            $uname=$_SESSION["uname"];
            $eventname=$_POST["eventname"];
            $phn=$_POST["phn"];
            $qry="select * from cultural where event_name='$eventname'";
            
            $exec=mysqli_query($con,$qry);
            if(!$exec)
            {
              echo "Query failed to execute, contact developer!";
            }
            else
            {
              $erow=mysqli_fetch_assoc($exec);
              $eventid=$erow["event_id"];
              $qury="insert into cultural_registration values('$eventid','$uname','$phn')";
              $exec=mysqli_query($con,$qury);
             if($exec){
              ?>
                <script type="text/javascript">
                  alert("Registered successfully.");                  
                  window.location.href="event.php";
                </script>
              <?php
            }
              if(!$exec)
              {
                ?>
                <script type="text/javascript">
                  alert("Failed to register.. may be you already registered!");
                  window.location.href="event.php";
                </script>
                <?php
              }
            }
          }

           //sports registration

          if(isset($_POST["sports-register"]))
          {
            $uname=$_SESSION["uname"];
            $eventname=$_POST["eventname"];
            $phn=$_POST["phn"];
            $qry="select * from sports where event_name='$eventname'";
            
            $exec=mysqli_query($con,$qry);
            if(!$exec)
            {
              echo "Query failed to execute, contact developer!";
            }
            else
            {
              $erow=mysqli_fetch_assoc($exec);
              $eventid=$erow["event_id"];
              $qury="insert into sports_registration values('$eventid','$uname','$phn')";
              $exec=mysqli_query($con,$qury);
              if($exec){
              ?>
                <script type="text/javascript">
                  alert("Registered successfully.");                  
                  window.location.href="event.php";
                </script>
              <?php
            }
              if(!$exec)
              {
                ?>
                <script type="text/javascript">
                  alert("Failed to register.. may be you already registered!");
                  window.location.href="event.php";
                </script>
                <?php
              }
            }

          }

          if(isset($_POST["cultural"]))
          {
            $q="select * from cultural";
            $x=mysqli_query($con,$q);
            if(!$x)
            {
              echo "Query failed";
            }
            else
            {
              ?>

              <form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
                <table class="table table-hover table-borderless text-center">
                  <caption>Register for cultural</caption>
                  <tr>
                    <td>Event name</td>
                    <td><select name="eventname" class="form-control">
                      <?php
                      while($row=mysqli_fetch_assoc($x))
                      {
                        echo "<option>".$row["event_name"]."</option>";
                      }
                      ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td>Phone number</td>
                    <td><input type="number" name="phn" class="form-control" required="">
                    </td>
                  </tr>
                </table>
                <input type="submit" name="cultural-register" value="Register" class="btn btn-lg btn-success">
              </form>        
              <?php

            }    
          }
          elseif(isset($_POST["sports"]))
          {
            $q="select * from sports";
            $x=mysqli_query($con,$q);
            if(!$x)
            {
              echo "Query failed";
            }
            else
            {
              ?>
              <form method="post" action=<?php echo $_SERVER["PHP_SELF"]; ?>>
                <table class="table table-hover table-borderless text-center">
                  <caption>Register for sports</caption>
                  <tr>
                    <td>Event name</td>
                    <td><select name="eventname" class="form-control">
                      <?php
                      while($row=mysqli_fetch_assoc($x))
                      {
                        echo "<option>".$row["event_name"]."</option>";
                      }
                      ?>
                    </select></td>
                  </tr>
                  <tr>
                    <td>Phone number</td>
                    <td><input type="number" name="phn" class="form-control" required="">
                    </td>
                  </tr>
                </table>
                <input type="submit" name="sports-register" value="Register" class="btn btn-lg btn-success">
              </form>  
              <?php
            }
          }
          ?>
        </div>
      </center>
      <br><br><br>
      <?php include 'footer.html';?>  
    </body>
    </html>