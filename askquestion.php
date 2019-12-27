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
  <title>Ask question</title>
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
            <li class="active"><a href="askquestion.php"><span class='glyphicon glyphicon-question-sign'></span> Ask question</a></li>
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
          </ul>
        </div>
      </nav>    
      
      <center>
        <div class="container">
          <form method="POST" class="form-group" action="askquestion.php">
            <table class="text-center">
              <tr>
                <td colspan="2">
                  <textarea rows="5" cols="200" name="question" class="form-control" placeholder="Ask question" required=""></textarea><br><br>
                </td>
              </tr>
              <tr>
                <td>
                  <button type="submit" class="btn btn-primary"><h4>Submit Question</h4></button>
                </td>
              </tr>
              <tr>
                <td><br>
                  <button type="reset" class="btn btn-primary"><h5>Clear</h5></button>
                </td>
              </tr>
            </table>
          </form>
          <script>
            function goBack() {
              window.history.back();
            }
          </script>
        </div>
        <?php
        if(isset($_POST["question"]))
        {
          $question=$_POST["question"];
          $uname=$_SESSION["uname"];
          include 'dbconnection.php';
          $qry="insert into question values('','$uname','$question',CURRENT_TIME)";
          $x=mysqli_query($con,$qry);
          if(!$x)
          {
            ?>
            <script type="text/javascript">
              alert("Failed to submit!");
            </script>
            <?php
          }
          else
          {
            ?>
            <script type="text/javascript">
              alert("Question submitted successfully.");
            </script>
            <?php
          }
        }
        ?>
      </center>
      <center>
        <br><br><br>
        <?php include 'footer.html';?> 
      </center>
    </div>
  </body>
  </html>