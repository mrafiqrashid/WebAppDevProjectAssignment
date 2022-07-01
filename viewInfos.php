
<?php
//This is the main page form the company user

session_start();

$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
} else {
    $userID = $_SESSION['userID'];
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
                        <h2 class="pull-left" >The Complexity and Risk Level Definition</h2>
                <!--        <h5 class="pull-right"><?php echo "User ID: <small>" . $_SESSION['userID'] . "</small>"; ?></h5> -->
                    </div>
                    <div class="mt-3 mb-3 clearfix">
                        <a href="homeManager.php" class="btn btn-warning pull-right">Homepage</a>
                      <!--  <a href="addQuestion.php" class="btn btn-success pull-right mr-1"><i class="fa fa-plus"></i> Add New Stock</a>   -->
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "select infocrldid, level, definition, score from infocrld";
                    if ($result = $pdo->prepare($sql)) {
                      //  $result->bindParam(":userID", $userID);
                        $result->execute();
                        if ($result->rowCount() > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>NO</th>";
                            echo "<th>Level</th>";
                            echo "<th>Definition</th>";
                            echo "<th>Score</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['infocrldid'] . "</td>";
                                echo "<td>" . $row['level'] . "</td>";
                                echo "<td>" . $row['definition'] . "</td>";
                                echo "<td>" . $row['score'] . "</td>";
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

                    echo nl2br("\n\n");
                    echo('<span style="font-size: 30px;"><a><b>Calculation Method</a></b></span>');
                    echo nl2br("\n\n");
                    echo "<img src='calcyy.png' >"; 
                    echo nl2br("\n\nThe questions are all of equal value in the overall score. Please note though that if questions 1, 3, and 11, which deal with money, scope, and time in the project characteristics section, are all answered as '5', a triple constraint condition will apply resulting in '5' response scoring for all questions in this section (i.e. the maximum score of 90 for the section). In addition, if the project has no procurement (addressed in question 2) the minimum score is automatically assigned for each question in the procurement section.");
                    echo nl2br("The criteria in the PCRA consider a very broad range of potential project risks which stem from virtually every possible root cause relevant for just about any project. However, not every project risk will apply to every project in every instance. When the PCRA was validated in 2009, it was determined that approximately 70% of the project risks reflected in the assessment criteria would apply to any single project. Therefore, when calculating the final PCRA score, the total numeric value is normalized to accurately reflect the more realistic range of relevant risks for a single project.");

                    echo nl2br("\n\n");
                    echo('<span style="font-size: 30px;"><a><b>Section Description</a></b></span>');
                    echo nl2br("\n\n");
                    echo("<img src='secyy.png'>");

                    echo nl2br("\n\n");
                    echo ('<span style="font-size: 30px;"><a><b>Risk and Complexity Definitions</a></b></span>');
                    echo nl2br("\n\n");
                    echo nl2br("<b>Risk:</b>\n
                    The SEI, the authoring agency of the Continuous Risk Management Guidebook, uses the following definition for the term 'risk':\n\n");
                    echo nl2br("<i>The possibility of suffering loss.</i>\n\n");
                    echo nl2br ("The Government of Canada (GC) cites the SEI as the basis for the concepts, methods, and guidelines embodied in the Integrated Risk Management Framework (IRMF)
                    Within that Framework, the following definition of risk provides a standard for the GC:\n\n");

                    echo nl2br("<i>Risk refers to the uncertainty that surrounds future events and outcomes. 
                    It is the expression of the likelihood and impact of an event with the potential to influence the achievement of an organization's objectives.</i>\n\n");

                    echo nl2br("Risk has three key characteristics. The first is that it looks ahead into the future.The second is that there is an element of uncertainty: a condition or a situation exists that might cause a problem for the project in the future. The third characteristic is related to the outcome. Although it is acknowledged that risk, if managed properly, 
                    can lead to opportunity, the definition of risk adopted for the purposes of this policy instrument focuses on adverse outcomes. 
                    This definition is consistent with the SEI's Continuous Risk Management software engineering practice supported by 
                    An Enhanced Framework for the Management of Information Technology Projects and conforms to the risk management concepts of the 
                    Treasury Board of Canada Secretariat's Integrated Risk Management Framework.\n\n");
                    
                    echo nl2br("Project complexity: Complexity is, fittingly, a much more difficult concept to define. Once again, the SEI provides a solid definition from Webster's:\n\n");
                    
                    echo nl2br("<b>Complexity:</b>\n
                    (Apparent) the degree to which a system or component has a design or implementation that is difficult to understand and verifyFootnote1;
                    (Inherent) the degree of complication of a system or system component, determined by such factors as the number and intricacy of interfaces, 
                    the number and intricacy of conditional branches, the degree of nesting, and the types of data structuresFootnote2.");
                    echo nl2br("\n\n");
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>