<?php
//This is the main page form the company user
require_once "config.php";
session_start();
$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
} else {
    $userID = $_SESSION['userID'];
}
//echo $_SESSION['userID'];



//echo "getprojectid".$_GET['projectid'];
$projectid = $_GET['projectid'];
//echo " projectid".$projectid;
//$_SESSION['projectid'] = $projectid;
//echo " sessionprojectid".$_SESSION['projectid'];
$total=0;
$name1="ans";
$names = "ans";
$count = 0;
$score1 = "";
//echo $projectid;

$TEST2 = "";



if ($_SERVER["REQUEST_METHOD"] == "POST"){


    

    $projectid = $_POST['projectid'];
   // echo "projectid line 30".$_SESSION['projectid'];

   // echo $_POST["ans2"];
   // echo $_POST["count"];

    $test = $_POST["count"];
    $total = 0;

    for($i=1;$i<=$test;$i++){
    //    echo "test";
        $c = "ans".$i;
      //  echo $c;
        $total = $total + $_POST[$c];
        
    }
    $sql = "UPDATE score SET score6=:score2 WHERE projectid=:projectid";

    if ($stmt = $pdo->prepare($sql)) {
        // Set parameters
        $param_projectid = $projectid;
        
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":projectid", $param_projectid);
        $stmt->bindParam(":score2", $total);

        if ($stmt->execute()){
            // Records created successfully. Redirect to landing page
        //    answeringEval1a.php?projectid=23455;
            header("location: answeringEval7.php?projectid=$projectid");
            exit();
        // echo "final total ".$total;
         //  echo $param_projectid.$param_score1;
        }
        else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
    // Close statement
    unset($stmt);
}

?>

<html lang="en">

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            width: 1500px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 220px;
            
           
        }
        tr{
            background-color: #FFFFFF;
            
        }

        td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
 
  border-style:solid;
  border-color: red;

}
table.table-bordered{
    border:2px solid black;
    margin-top:20px;
  }
table.table-bordered > thead > tr > th{
    border:2px solid black;
}
table.table-bordered > tbody > tr > td{
    border:2px solid grey;
}
       
        td{
            background-color: #D6EEEE;
            border: 30px solid #ddf;
            
        }
        body {
  background-image: url('3.png');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
    </style>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left" >Questions Section 6</h2>
    </br>
    <div style="float:right;">
                        <h5 class="pull-right"><?php echo "User ID: <small>" . $_SESSION['userID'] . "</small>"; ?></h5>
    </br>
    <h5 class="pull-right"><?php echo "Project ID: <small>" . $_GET['projectid'] . "</small>"; ?></h5>
                    </div>
    </div>
                    <div class="mt-3 mb-3 clearfix">
                        <a href="homeManager.php" class="btn btn-warning pull-right">Homepage</a>
                        
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <?php
                    // Include config file
                   // require_once "config.php";
                    $count=0;
                 //   echo "<var>c</var> = 0";
                 //   echo "<var>name1</var> = ans.c";
               //  echo "projectid".$_GET['projectid'];

                    // Attempt select query execution
                    $sql = "select questionid, question, rating, no from question where cid = 6 order by no";
                    if ($result = $pdo->prepare($sql)) {
                      //  $result->bindParam(":userID", $userID);
                        $result->execute();
                        if ($result->rowCount() > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>No Question</th>";
                            echo "<th>Question</th>";
                            echo "<th>Rating</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                $count += 1;
                                $names = "ans".$count;
                        //        echo "<var>c</var> += 1";
                                echo "<tr>";
                                echo "<td>" . $row['no'] . "</td>";
                                echo "<td>" . $row['question'] . "</td>";
                                echo "<td>" . $row['rating'] . "</td>";
                                echo "<td>";
                               
                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input" type="radio" name='.$names.'  value="1" required
                                >';
                                echo '<label class="form-check-label" for="inlineRadio1">1</label>';
                                echo '</div>';
                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input" type="radio" name='.$names.'  value="2">';
                                echo '<label class="form-check-label" for="inlineRadio2">2</label>'; 
                                echo '</div>';
                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input" type="radio" name='.$names.' value="3">';
                                echo '<label class="form-check-label" for="inlineRadio3">3</label>'; 
                                echo '</div>';
                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input" type="radio" name='.$names.'  value="4">';
                                echo '<label class="form-check-label" for="inlineRadio4">4</label>'; 
                                echo '</div>';
                                echo '<div class="form-check form-check-inline">';
                                echo '<input class="form-check-input" type="radio" name='.$names.'  value="5">';
                                echo '<label class="form-check-label" for="inlineRadio5">5</label>';
                                echo '</div>';
                          //      echo '<a href="updateQuestion.php?questionid=' . $row['questionid'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                           //     echo '<a href="deleteQuestion.php?questionid=' . $row['questionid'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            unset($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    unset($pdo);
                    ?>
                    <div style="float:right;">
                    <input type="hidden" name="count" value="<?php echo $count; ?>" >
                    <input type="hidden" id="projectid" name="projectid" value="<?php echo $projectid; ?>">
                    <input type="submit" class="btn btn-primary ml-2" value="Next"> 
                    <?php

//echo "projectid".$_GET['projectid'];
                    
              //      echo '<a type="submit" class="btn btn-primary ml-2" href="answeringEval2a.php?projectid=' . $projectid . '" class="mr-3" title="Evaluate Project" data-toggle="tooltip">Next</a>'; ?>

                        </div>
                        <div style="float:left;">

                    <!--    <a href="answeringEval1a.php?projectid=' . $projectid . '" class="mr-3" title="Evaluate Project" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>   -->
                    <?php
                 //   echo "projectid".$_GET['projectid'];
                    echo '<a class="btn btn-primary" href="answeringEval5a.php?projectid=' . $_GET['projectid'] . '" role="button">Back</a>';
                 //   echo '<a href="answeringEval1a.php?projectid=' . $_GET['projectid'] . '" type="submit" name="back" class="btn btn-primary ml-2" value="Back"></a>';

                    ?>
                    
                </div>
                    </form>
                    <br>
                    
                    <br>
                    <br>

                    <div class="col-sm">
                </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>