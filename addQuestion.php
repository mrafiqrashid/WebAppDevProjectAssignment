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
//$userID = $_SESSION['userID'];

// Define variables and initialize with empty values
$questionid = $question = $criteria = $rating = $cid = $no = "";
$questionid_err = $question_err = $criteria_err = $rating_err = $cid_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate cid
    $input_no = trim($_POST["no"]);
    if (empty($input_no)) {
        $no_err = "Please enter a No Question.";
    }else {
        $no = $input_no;
    }

    // Validate cid
    $input_cid = trim($_POST["cid"]);
    if (empty($input_cid)) {
        $cid_err = "Please enter a cid.";
    }else {
        $cid = $input_cid;
    }

    // Validate Rating
    $input_rating = trim($_POST["rating"]);
    if (empty($input_rating)) {
        $rating_err = "Please enter a rating.";
    }else {
        $rating = $input_rating;
    }

    // Validate question
    $input_question = trim($_POST["question"]);
    if (empty($input_question)) {
        // echo $input_question;
        $question_err = "Please enter a question.";
    } else {
        $question = $input_question;
    }

    

    // Check input errors before inserting in database
    if (empty($cid_err) && empty($question_err) && empty($rating_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO question (cid, rating, question, no) VALUES (:cid, :rating, :question, :no)";

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_cid = $cid;
            $param_rating = $rating;
            $param_question = $question;

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":cid", $param_cid);
            $stmt->bindParam(":rating", $param_rating);
            $stmt->bindParam(":question", $param_question);
            $stmt->bindParam(":no", $no);
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: viewQuestion1.php");
                exit();
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
    <title>add Question</title>
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
                    <h2 class="mt-5">Add Question</h2>
                    <p>Please fill this form and submit to create record to the database.</p>
                    
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                    <div class="form-group">
                            <label>Question No</label>
                            <input type="text" name="no" class="form-control <?php echo (!empty($no_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $no; ?>">
                            <span class="invalid-feedback"><?php echo $no_err; ?></span>
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
                        
                            
                            <textarea  name="rating" rows="4" cols="69" class="<?php echo (!empty($ratint_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rating; ?>"></textarea>
                            <span class="invalid-feedback"><?php echo $rating_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Question</label>
                        
                            
                            <textarea  name="question" rows="4" cols="69" class="<?php echo (!empty($question_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $question; ?>"></textarea>
                            <span class="invalid-feedback"><?php echo $question_err; ?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="viewQuestion1.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>