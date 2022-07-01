<?php

    
    session_start();
    require_once "config.php";
  
  //echo $_SESSION['userid']
$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
}
    else {
        $userID = $_SESSION['userID'];
    }
    
    $username = $_SESSION['username'];
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Manager</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Gallery</a></li>
        <li><a href="updateUser.php?userid=<?php echo $_SESSION['userid']?>">Update Profile</a></li>
      

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logoutManager.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron">
  <div class="container text-center">
    <h1>Project Complexity and Risk Assessment Tool</h1>      
    
  </div>
</div>
  
<div class="container-fluid bg-3 text-center">    
  <h3>Hi, <?php echo $_SESSION['username']?></h3><br>
  <div class="row">
    <div class="col-sm-4">
    <a class="btn btn-primary btn-lg" href="viewProject.php" role="button">Manage Project</a>
    </div>
    <div class="col-sm-4"> 
    <a class="btn btn-primary btn-lg" href="viewEvaluationProject.php" role="button">View Evaluation Project</a>
    </div>
    <div class="col-sm-4"> 
    <a class="btn btn-primary btn-lg" href="viewInfos.php" role="button">Complexity and Risk Level Definition</a>
    </div>
  </div>
</div><br>





</body>
</html>
