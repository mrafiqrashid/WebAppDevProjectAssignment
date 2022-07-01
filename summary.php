<?php
//This is the main page form the company user

session_start();

$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
} else {
    $userID = $_SESSION['userID'];
}
//echo $_SESSION['userID'];

//$projectid = 43211;
$score1 = $score2 = $score3 = $score4 = $score5 = $score6 = $score7 = $scoreoverall = 0;
$projectid = $_GET['projectid'];
$fscore1 = " / 90";
$fscore2 = " / 30";
$fscore3 = " / 45";
$fscore4 = " / 25";
$fscore5 = " / 25";
$fscore6 = " / 30";
$fscore7 = " / 75";
$fscoreoverall = " / 320";

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
            width: 800px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 120px;
            
           
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
                        <h2 class="pull-left" >Summary Project Page</h2></br>
    <div style="float:right;">
                        <h5 class="pull-right"><?php echo "User ID: <small>" . $_SESSION['userID'] . "</small>"; ?></h5>
    </br>
    <h5 class="pull-right"><?php echo "Project ID: <small>" . $_GET['projectid'] . "</small>"; ?></h5>
                    </div>
    </div>
                    <div class="mt-3 mb-3 clearfix">
                
                    <a onclick="window.print()" class="btn btn-secondary pull-left">Print this page</a>
                        <a href="viewEvaluationProject.php" class="btn btn-warning pull-right">View Evaluation Project</a>
                        <!-- <a href="addQuestion.php" class="btn btn-success pull-right mr-1"><i class="fa fa-plus"></i> Add New Stock</a> -->
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT projectid, score1, score2, score3, score4, score5, score6, score7, scoreoverall, percent, level, definition, infocrldid from score natural join infocrld where projectid=:projectid;";
                    
                    if ($result = $pdo->prepare($sql)) {
                        
                        
                        $result->bindParam(":projectid", $projectid); 
                        $result->execute();
                        $row = $result->fetch();
                      //  echo "projectid".$row['projectid']; echo "test3";

                        $score1 = $row['score1'];
                        $score2 = $row['score2'];
                        $score3 = $row['score3'];
                        $score4 = $row['score4'];
                        $score5 = $row['score5'];
                        $score6 = $row['score6'];
                        $score7 = $row['score7'];
                        $scoreoverall  = $row['scoreoverall'];
                        $percent  = $row['percent'];

                      //  echo $row['score1']."score2 ".$row['score2']."score3 ".$row['score3']."score4".$row['score4']."score5 ".$row['score5']."score6 ".$row['score6']."score7 ".$row['score7']."scoreoverall ".$row['scoreoverall'];
                        if ($result->rowCount() > 0) {
                            echo '<table class="table table-bordered table-striped">';
                  
                            echo "<tbody>";
                          //  while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td class='p-3' width='18%'>Project ID</td>";
                                echo "<td class='p-3' width='82%'>" . $row['projectid'] . "</td>";
                                echo "<tr>";
                                echo "<td>Section 1</td>";
                                echo "<td>" . $row['score1'] .$fscore1 . "</td>";
                                echo "<tr>";
                                echo "<td>Section 2</td>";
                                echo "<td>" . $row['score2'] .$fscore2 . "</td>";
                                echo "<tr>";
                                echo "<td>Section 3</td>";
                                echo "<td>" . $row['score3'] .$fscore3  . "</td>";
                                echo "<tr>";
                                echo "<td>Section 4</td>";
                                echo "<td>" . $row['score4'] .$fscore4 . "</td>";
                                echo "<tr>";
                                echo "<td>Section 5</td>";
                                echo "<td>" . $row['score5'] .$fscore5 . "</td>";
                                echo "<tr>";
                                echo "<td>Section 6</td>";
                                echo "<td>" . $row['score6'] .$fscore6 . "</td>";
                                echo "<tr>";
                                echo "<td>Section 7</td>";
                                echo "<td>" . $row['score7'] .$fscore7 . "</td>";
                                echo "<tr>";
                                echo "<td>Overall Score</td>";
                                echo "<td>" . $row['scoreoverall'] .$fscoreoverall . "</td>";
                                echo "<tr>";
                                echo "<td>Percentage</td>";
                                echo "<td>" . $row['percent'] . "</td>";
                                echo "<tr>";
                                echo "<td>Project Level</td>";
                                echo "<td>" . $row['infocrldid'] . ". " . $row['level'] . "</td>";
                                echo "<tr>";
                                echo "<td>Summary</td>";
                                echo "<td>" . $row['definition'] . "</td>";
                               
                            //   echo '<a href="readQuestion.php?questionid=' . $row['questionid'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                            //    echo '<a href="updateQuestion.php?questionid=' . $row['questionid'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            //    echo '<a href="deleteQuestion.php?questionid=' . $row['questionid'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                            
                                echo "</tr>";
                          //  }
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
                </div>
            </div>
        </div>
    </div>
</body>

</html>