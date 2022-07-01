
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
            width: 1100px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 80px;
            
           
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
                        <a href="homeAdmin.php" class="btn btn-warning pull-right">Homepage</a>
                        <!-- <a href="addQuestion.php" class="btn btn-success pull-right mr-1"><i class="fa fa-plus"></i> Add New Stock</a> -->
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
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['infocrldid'] . "</td>";
                                echo "<td>" . $row['level'] . "</td>";
                                echo "<td>" . $row['definition'] . "</td>";
                                echo "<td>" . $row['score'] . "</td>";
                                echo "<td>";
                                echo '<a href="updateInfo.php?infocrldid=' . $row['infocrldid'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                        //        echo '<a href="updateQuestion.php?questionid=' . $row['infocrldid'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                        //        echo '<a href="deleteQuestion.php?questionid=' . $row['infocrldid'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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
                </div>
            </div>
        </div>
    </div>
</body>

</html>