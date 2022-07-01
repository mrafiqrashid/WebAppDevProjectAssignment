<?php
// Include config file
require_once "config.php";
session_start();
$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
} else {
    $userID = $_SESSION['userID'];
}

// Define variables and initialize with empty values
$projectid = $projectname = $owner = $financial = $duration = $mode = $userid = "";
$projectid_err = $projectname_err = $owner_err = $financial_err = $duration_err = $mode_err = $userid_err = "";

//$pdo;
//$userID = $_SESSION['userID'];
// Processing form data when form is submitted
if (isset($_POST['projectid']) && !empty($_POST['projectid'])) {
    $projectid = $_POST['projectid'];
    $projectname = $_POST['projectname'];
    $owner = $_POST['owner'];
    $financial = $_POST['financial'];
    $duration = $_POST['duration'];
    $mode = $_POST['mode'];
    $userid = $_SESSION['userid'];
    //echo $questionid.$criteria.$question;

    
    // Validate projectname
    $input_projectid = trim($projectid);
    if (empty($input_projectid)) {
        $projectid_err = "Please enter a project ID.".$projectid;
    } else {
        $projectid = $input_projectid;
    }
    
    // Validate projectname
    $input_projectname = trim($projectname);
    if (empty($input_projectname)) {
        $projectname_err = "Please enter a project name.".$projectname;
    } else {
        $projectname = $input_projectname;
    }

    // Validate owner
    $input_owner = trim($owner);
    if (empty($input_owner)) {
        $owner_err = "Please enter a project owner.";
    } else {
        $owner = $input_owner;
    }

    // Validate financial
    $input_financial = trim($financial);
    if (empty($input_financial)) {
        // echo $input_category;
        $financial_err = "Please enter a project financial.";
    }else {
        $financial = $input_financial;
    }

     // Validate duration
     $input_duration = trim($duration);
     if (empty($input_duration)) {
         // echo $input_category;
         $duration_err = "Please enter a project duration.";
     }else {
         $duration = $input_duration;
     }

     // Validate mode
     $input_mode = trim($mode);
     if (empty($input_mode)) {
         // echo $input_category;
         $mode_err = "Please enter a project mode.";
     }else {
         $mode = $input_mode;
     }
     
 

    

    // Check input errors before inserting in database
    if (empty($projectname_err) && empty($owner_err) && empty($financial_err) && empty($duration_err) && empty($mode_err)) {
        // Prepare an update statement
        $sql = "UPDATE project SET projectid=:projectid, projectname=:projectname, owner=:owner, financial=:financial, duration=:duration, mode=:mode, userid=:userid WHERE projectid=:projectid";
       

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_projectid = $projectid;
            $param_projectname = $projectname;
            $param_owner = $owner;
            $param_financial = $financial;
            $param_duration = $duration;
            $param_mode = $mode;
            $param_userid = $_SESSION['userid'];

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":projectid", $param_projectid);
            $stmt->bindParam(":projectname", $param_projectname);
            $stmt->bindParam(":owner", $param_owner);
            $stmt->bindParam(":financial", $param_financial);
            $stmt->bindParam(":duration", $param_duration);
            $stmt->bindParam(":mode", $param_mode);
            $stmt->bindParam(":userid", $_SESSION['userid']);

      //      echo $param_projectid.$param_projectname.$param_owner.$param_financial.$param_duration.$param_mode.$_SESSION['userid'];


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: viewProject.php");
                exit();
             //echo $questionid.$criteria.$question;
             //  echo "Oops! Something went wrong. Please try again later.";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
} else {
    echo $_GET["projectid"];
    // Check existence of id parameter before processing further
    if (isset($_GET["projectid"]) && !empty(trim($_GET["projectid"]))) {
        // Get URL parameter
        $projectid =  trim($_GET["projectid"]);

        // Prepare a select statement
        $sql = "SELECT * FROM project WHERE projectid = :projectid";
        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_projectid = $projectid;
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":projectid", $param_projectid);

            // Set parameters
            $param_projectid = $projectid;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $projectid = $row["projectid"];
                    $projectname = $row["projectname"];
                    $owner = $row["owner"];
                    $financial = $row["financial"];
                    $duration = $row["duration"];
                    $mode = $row["mode"];
                    $userid = $row["userid"];
                    
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);

        // Close connection
        unset($pdo);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
        body {
  background-image: url('3.png');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
            <div style="background-color:blue; padding: 20px; background: rgba(202, 222, 238, 0.6)" >
                <div class="col-md-12">
                    <h2 class="mt-5">Update Project</h2>
                    <p>Please edit the input values and submit to update the project.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        <div class="form-group">
                            <label>Project ID</label>
                            <input type="text" name="projectid" class="form-control <?php echo (!empty($projectid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $projectid; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $projectid_err; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Project Name</label>
                            <input type="text" name="projectname" class="form-control <?php echo (!empty($projectname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $projectname; ?>">
                            <span class="invalid-feedback"><?php echo $projectname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Owner</label>
                            <input type="text" name="owner" class="form-control <?php echo (!empty($owner_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $owner; ?>">
                            <span class="invalid-feedback"><?php echo $owner_err; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Financial</label>
                            <input type="text" name="financial" class="form-control <?php echo (!empty($financial_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $financial; ?>">
                            <span class="invalid-feedback"><?php echo $financial_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="text" name="duration" class="form-control <?php echo (!empty($duration_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $duration; ?>">
                            <span class="invalid-feedback"><?php echo $duration_err; ?></span>
                        </div>

                      


                        Project Mode
                    <div class="form-group">
                            <select name="mode" style=padding:6px; required>
                            <option value="<?php echo $mode; ?>"><?php echo $mode; ?></option>
                            <option value="Insource">Insource</option>
                            <option value="Outsource">Outsource</option>
                            <option value="Co-source">Co-source</option>
                            <option value="Unspecified">Unspecified</option>
                            </select>
                           
                            <span class="invalid-feedback"><?php echo $rating_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" name="userid" class="form-control <?php echo (!empty($userid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $userid; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $userid_err; ?></span>
                        </div>
                        
                        <input type="hidden" name="projectid" value="<?php echo $projectid; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewProject.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>