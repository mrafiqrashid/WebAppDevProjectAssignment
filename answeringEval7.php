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

$infocrldid = "";
$score1 = $score2 = $score3 = $score4 = $score5 = $score6 = $score7 = $scoreoverall = $total2 = 0;
$total=0;
$name1="ans";
$names = "ans";
$count = 0;
$scoreoverall = $percent = 0;
$projectid = $_GET['projectid'];


$sql = "select score1, score2, score3, score4, score5, score6 from score where projectid = :projectid";
if ($result = $pdo->prepare($sql)) {
 $result->bindParam(":projectid", $projectid);

    $result->execute();
    $row = $result->fetch();

    $score1 = $row['score1'];
    $score2 = $row['score2'];
    $score3 = $row['score3'];
    $score4 = $row['score4'];
    $score5 = $row['score5'];
    $score6 = $row['score6'];

    $total2 = $score1 + $score2 + $score3 + $score4 + $score5 + $score6;


}


$TEST2 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST"){

   $projectid = $_POST['projectid'];
    $test = $_POST["count"];
    $total = 0;
    $infocrldid = 0;
    for($i=1;$i<=$test;$i++){
        $c = "ans".$i;
        $total = $total + $_POST[$c];
        
    }
    $scoreoverall = $total + $_POST['sum'];

    $percent = $scoreoverall / 320 * 100;
    echo "percent".$percent;

    
    if($percent < 45){
        $infocrldid = 1;

    }
    else if ($percent < 64){
        $infocrldid = 2;
    }
    else if($percent < 83){
        $infocrldid = 3;

    }
    else {
        $infocrldid = 4;
    }
    echo "info ".$infocrldid."er";
    $percent1 = $percent."%";

    $sql = "UPDATE score SET score7=:score7, scoreoverall=:scoreoverall, infocrldid=:infocrldid, percent=:percent WHERE projectid=:projectid";

    if ($stmt = $pdo->prepare($sql)) {
        // Set parameters
        $param_projectid = $projectid;
        $param_score1 = $total;
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":projectid", $param_projectid);
        $stmt->bindParam(":score7", $total);
        $stmt->bindParam(":scoreoverall", $scoreoverall);
        $stmt->bindParam(":infocrldid", $infocrldid);
        $stmt->bindParam(":percent", $percent1);

        if ($stmt->execute()){
            // Records created successfully. Redirect to landing page
            header("location: summary.php?projectid=$projectid");
            exit();

            
         echo $scoreoverall;
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
                        <h2 class="pull-left" >Questions Section 7</h2></br>
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
                    require_once "config.php";
                    $count=0;

                    // Attempt select query execution
                    $sql = "select questionid, question, rating, no from question where cid = 7 order by no";
                    if ($result = $pdo->prepare($sql)) {
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
                    <input type="hidden" name="projectid" value="<?php echo $projectid; ?>" >
                    <input type="hidden" name="sum" value="<?php echo $total2; ?>" >
                    <input type="submit" class="btn btn-primary ml-2" value="Next">

                        </div>
                        <div style="float:left;">

                        <?php
                    echo '<a class="btn btn-primary" href="answeringEval6a.php?projectid=' . $_GET['projectid'] . '" role="button">Back</a>';
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