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
$infocrldid = $level = $definition = $score = "";
$infocrldid_err = $level_err = $definition_err = $score_err = "";
$pdo;
//$userID = $_SESSION['userID'];
// Processing form data when form is submitted
//echo $_GET['infocrldid'];
if (isset($_POST['infocrldid']) && !empty($_POST['infocrldid'])) {
    $infocrldid = $_POST['infocrldid'];
    $level = $_POST['level'];
    $definition = $_POST['definition'];
    $score = $_POST['score'];
    //echo $questionid.$criteria.$question;

   // echo "test1";

    // Validate level
    $input_level = trim($level);
    if (empty($input_level)) {
        $level_err = "Please enter a level.";
    } else {
        $level = $input_level;
    }

    // Validate definition
    $input_definition = trim($definition);
    if (empty($input_definition)) {
        $definition_err = "Please enter a definition.";
    } else {
        $definition = $input_definition;
    }

    // Validate score
    $input_score = trim($score);
    if (empty($input_score)) {
        // echo $input_category;
        $score_err = "Please enter a score.";
    }else {
        $score = $input_score;
    }

    

    // Check input errors before inserting in database
    if (empty($infocrldid_err) && empty($level_err) && empty($definition_err) && empty($score_err)) {
        // Prepare an update statement
        $sql = "UPDATE infocrld SET infocrldid=:infocrldid, level=:level, definition=:definition, score=:score WHERE infocrldid=:infocrldid";
       

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_infocrldid = $infocrldid;
            $param_level = $level;
            $param_definition = $definition;
            $param_score = $score;

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":infocrldid", $param_infocrldid);
            $stmt->bindParam(":level", $param_level);
            $stmt->bindParam(":definition", $param_definition);
            $stmt->bindParam(":score", $param_score);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: viewInfo.php");
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
    // Check existence of id parameter before processing further
    echo $_GET["infocrldid"];
    if (isset($_GET["infocrldid"]) && !empty(trim($_GET["infocrldid"]))) {
        // Get URL parameter
        $infocrldid =  trim($_GET["infocrldid"]);

        // Prepare a select statement
        $sql = "SELECT * FROM infocrld WHERE infocrldid = :infocrldid";
        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_infocrldid = $infocrldid;
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":infocrldid", $param_infocrldid);

            // Set parameters
            $param_infocrldid = $infocrldid;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $infocrldid = $row["infocrldid"];
                    $level = $row["level"];
                    $definition = $row["definition"];
                    $score = $row["score"];
                    
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                  //  header("location: error.php");
                  echo "test";
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
     //   header("location: error.php");
     echo "test";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Information</title>
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
                    <h2 class="mt-5">Update Information</h2>
                    <p>Please edit the input values and submit to update the Information.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        <div class="form-group">
                            <label>Complexity and Risk Level ID</label>
                            <input type="text" name="infocrldid" class="form-control <?php echo (!empty($infocrldid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $infocrldid; ?>">
                            <span class="invalid-feedback"><?php echo $infocrld_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Level</label>
                            <input type="text" name="level" class="form-control <?php echo (!empty($level_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $level; ?>">
                            <span class="invalid-feedback"><?php echo $level_err; ?></span>
                        </div>
                       
                        <div class="form-group">
                            <label>definition</label>
                            <input type="text" name="definition" class="form-control <?php echo (!empty($definition_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $definition; ?>">
                            <span class="invalid-feedback"><?php echo $definition_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>score</label>
                            <input type="text" name="score" class="form-control <?php echo (!empty($score_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $score; ?>">
                            <span class="invalid-feedback"><?php echo $score_err; ?></span>
                        </div>
                        
                        <input type="hidden" name="infocrlid" value="<?php echo $infocrldid; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewInfo.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>