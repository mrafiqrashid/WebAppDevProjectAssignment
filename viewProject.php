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
            width: 1500px;
            margin: 0 auto;
        }

        table tr td:last-child {
            width: 70px;
            
           
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
                        <h2 class="pull-left" >Project Details</h2>
                        <h5 class="pull-right"><?php echo "User ID: <small>" . $_SESSION['userID'] . "</small>"; ?></h5>
                    </div>
                    <div class="mt-3 mb-3 clearfix">
                        <a href="homeManager.php" class="btn btn-warning pull-right">Homepage</a>
                        <a href="addProject.php" class="btn btn-success pull-right mr-1"><i class="fa fa-plus"></i> Register New Project</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    $userid = $_SESSION['userID'];

                    // Attempt select query execution
                    $sql = "SELECT projectid, projectname, owner, financial, duration, mode, userid FROM project where userid = :userid";
                    if ($result = $pdo->prepare($sql)) {
                        $result->bindParam(":userid", $userid);
                        $result->execute();
                        if ($result->rowCount() > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Project ID</th>";
                            echo "<th>Project Name</th>";
                            echo "<th>Owner</th>";
                            echo "<th>Financial</th>";
                            echo "<th>Project Duration</th>";
                            echo "<th>Mode</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = $result->fetch()) {
                                echo "<tr>";
                                echo "<td>" . $row['projectid'] . "</td>";
                                echo "<td>" . $row['projectname'] . "</td>";
                                echo "<td>" . $row['owner'] . "</td>";
                                echo "<td>" . $row['financial'] . "</td>";
                                echo "<td>" . $row['duration'] . "</td>";
                                echo "<td>" . $row['mode'] . "</td>";
                                echo "<td>";
                       //         echo '<a href="readProject.php?projectid=' . $row['projectid'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="updateProject.php?projectid=' . $row['projectid'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="deleteProject.php?projectid=' . $row['projectid'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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