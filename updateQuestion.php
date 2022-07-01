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

$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
} else {
    $userID = $_SESSION['userID'];
}

// Define variables and initialize with empty values
$questionid = $cid = $question = $rating = "";
$questionid_err = $cid_err = $question_err = $rating_err = "";
$pdo;
//$userID = $_SESSION['userID'];
// Processing form data when form is submitted
if (isset($_POST['questionid']) && !empty($_POST['questionid'])) {
    $questionid = $_POST['questionid'];
    $cid = $_POST['cid'];
    $rating = $_POST['rating'];
    $question = $_POST['question'];
    //echo $questionid.$criteria.$question;

    // Validate cid
    $input_cid = trim($cid);
    if (empty($input_criteria)) {
        $criteria_err = "Please enter a criteria.";
    } else {
        $criteria = $input_criteria;
    }

    // Validate rating
    $input_rating = trim($rating);
    if (empty($input_rating)) {
        $rating_err = "Please enter a rating.";
    } else {
        $rating = $input_rating;
    }

    // Validate question
    $input_question = trim($question);
    if (empty($input_question)) {
        // echo $input_category;
        $question_err = "Please enter a question.";
    }else {
        $question = $input_question;
    }

    

    // Check input errors before inserting in database
    if (empty($questionid_err) && empty($cid_err) && empty($rating_err) && empty($question_err)) {
        // Prepare an update statement
        $sql = "UPDATE question SET questionid=:questionid, cid=:cid, rating=:rating, question=:question WHERE questionid=:questionid";
       

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_questionid = $questionid;
            $param_cid = $cid;
            $param_rating = $rating;
            $param_question = $question;

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":questionid", $param_questionid);
            $stmt->bindParam(":cid", $param_cid);
            $stmt->bindParam(":rating", $param_rating);
            $stmt->bindParam(":question", $param_question);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                header("location: viewQuestion1.php");
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
    if (isset($_GET["questionid"]) && !empty(trim($_GET["questionid"]))) {
        // Get URL parameter
        $questionid =  trim($_GET["questionid"]);

        // Prepare a select statement
        $sql = "SELECT * FROM question WHERE questionid = :questionid";
        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_questionid = $questionid;
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":questionid", $param_questionid);

            // Set parameters
            $param_questionid = $questionid;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Retrieve individual field value
                    $questionid = $row["questionid"];
                    $cid = $row["cid"];
                    $rating = $row["rating"];
                    $question = $row["question"];
                    
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
    <title>Update Question</title>
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
                    <h2 class="mt-5">Update Question</h2>
                    <p>Please edit the input values and submit to update the question.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        <div class="form-group">
                            <label>Question ID</label>
                            <input type="text" name="questionid" class="form-control <?php echo (!empty($questionid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $questionid; ?>">
                            <span class="invalid-feedback"><?php echo $questionid_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Criteria ID</label><br>
                            <select name="cid" style=padding:6px; required>
                            <option value="<?php echo $cid; ?>"><?php echo $cid; ?></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            </select>
                           
                            <span class="invalid-feedback"><?php echo $rating_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="text" name="rating" class="form-control <?php echo (!empty($rating_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rating; ?>">
                            <span class="invalid-feedback"><?php echo $rating_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Question</label>
                            <input type="text" name="question" class="form-control <?php echo (!empty($question_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $question; ?>">
                            <span class="invalid-feedback"><?php echo $question_err; ?></span>
                        </div>
                        
                        <input type="hidden" name="questionid" value="<?php echo $questionid; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewQuestion1.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>