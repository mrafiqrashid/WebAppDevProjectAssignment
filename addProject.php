<?php
// Include config file
require_once "config.php";
session_start();
$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
}
    else {
        $userID = $_SESSION['userID'];
    }

// Define variables and initialize with empty values
$projectid = $projectname = $owner = $financial = $duration = $mode = $userid = "";
$projectid_err = $projectname_err = $owner_err = $financial_err = $duration_err = $mode_err = $userid_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $projectid = rand(10, 100000);
    $projectname = $_POST["projectname"];
    $owner = $_POST["owner"];
    $financial = $_POST["financial"];
    $duration = $_POST["duration"];
    $mode = $_POST["mode"];
   // $userid = $_SESSION["userID"];
    // Validate projectname
    $input_projectname = trim($_POST["projectname"]);
    if (empty($input_projectname)) {
        $projectname_err = "Please enter a project name.";
    }else {
        $projectname = $input_projectname;
    }


    // Validate Owner
    $input_owner = trim($_POST["owner"]);
    if (empty($input_owner)) {
        $owner_err = "Please enter an owner.";
    }else {
        $owner = $input_owner;
    }

    // Validate financial
    $input_financial = trim($_POST["financial"]);
    if (empty($input_financial)) {
        // echo $input_financial;
        $financial_err = "Please enter a project financial.";
    }
        else if(!is_numeric($input_financial)){
            $financial_err = "Please enter a decimal number.";

        }
     else {
        $financial = $input_financial;
    }

    // Validate duration
    $input_duration = trim($_POST["duration"]);
    if (empty($input_duration)) {
        $duration_err = "Please enter a project duration.";
    }else {
        $duration = $input_duration;
    }


    // Validate mode
    $input_mode = trim($_POST["mode"]);
    if (empty($input_mode)) {
        $mode_err = "Please enter a project mode.";
    }else {
        $mode = $input_mode;
    }

    
    

    // Check input errors before inserting in database
    if (empty($projectname_err) && empty($owner_err) && empty($financial_err) && empty($duration_err) && empty($mode_err) && empty($userid_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO project (projectid, projectname, owner, financial, duration, mode, userid) VALUES (:projectid, :projectname, :owner, :financial, :duration, :mode, :userid)";

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_projectid = $projectid;
            $param_projectname = $projectname;
            $param_owner = $owner;
            $param_financial = $financial;
            $param_duration = $duration;
            $param_mode = $mode;
            $param_userid = $userid;

         //   echo $param_projectid.$param_projectname.$param_owner.$param_financial.$param_duration.$param_mode.$param_userid;

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":projectid", $param_projectid);
            $stmt->bindParam(":projectname", $param_projectname);
            $stmt->bindParam(":owner", $param_owner);
            $stmt->bindParam(":financial", $param_financial);
            $stmt->bindParam(":duration", $param_duration);
            $stmt->bindParam(":mode", $param_mode);
            $stmt->bindParam(":userid", $_SESSION['userid']);
           
           
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                
                
                // Records created successfully. Redirect to landing page
              //  header("location: viewProject.php");
              //  exit();
             // echo "donescore";
                
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    if (empty($projectname_err) && empty($owner_err) && empty($financial_err) && empty($duration_err) && empty($mode_err) && empty($userid_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO score (projectid, score1, score2, score3, score4, score5, score6, score7, scoreoverall, infocrldid, percent) VALUES (:projectid, 0, 0, 0, 0, 0, 0, 0, 0, 1, '0%')";

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_projectid = $projectid;

         //   echo $param_projectid.$param_projectname.$param_owner.$param_financial.$param_duration.$param_mode.$param_userid;

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":projectid", $param_projectid);
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: viewProject.php");
                exit();
             //  echo "est";
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        unset($stmt);
    }

    // Close connection
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>add Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
        div{
            opacity: 2;
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
                <div class="col-md-12">
                <div style="background-color:blue; padding: 20px; background: rgba(202, 222, 238, 0.6)" >
                    <h2 class="mt-5">Add Project</h2>
                    <p>Please fill this form and submit to create record to the database.</p>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    

                    Company Name
                    <div class="form-group">
                        <input type="text" class="form-control" name="projectname" placeholder="Company Name" required="required">
                    </div>
                    Owner
                    <div class="form-group">
                        <input type="text" class="form-control" name="owner" placeholder="Owner" required="required">
                    </div>
                    Financial
                    <div class="form-group">
                        <input type="text" class="form-control" name="financial" placeholder="Financial" required="required">
                    </div>
                    Duration
                    <div class="form-group">
                        <input type="text" class="form-control" name="duration" placeholder="Duration" required="required">
                    </div>
                    Mode
                    <div class="form-group">
                            <select name="mode" style=padding:6px; required>
                            <option value="">Mode</option>
                            <option value="Insource">Insource</option>
                            <option value="Outsource">Outsource</option>
                            <option value="Co-source">Co-source</option>
                            <option value="Unspecified">Unspecified</option>
                            </select>
                           
                            <span class="invalid-feedback"><?php echo $rating_err; ?></span>
                        </div>
                    User ID    
                    <div class="form-group">
                        <input type="text" class="form-control" name="userid" placeholder="<?php echo $_SESSION['userid']?>" value="<?php $_SESSION['userid']?>">
                    </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewProject.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>