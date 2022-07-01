<?php
// Check existence of id parameter before processing further

$questionid = $cid = $question = $rating = "";

if (isset($_GET["questionid"]) && !empty(trim($_GET["questionid"]))) {
    $questionid = $_GET["questionid"];
    // Include config file
    require_once "config.php";
//echo $row["questionid"];

    // Prepare a select statement
    $sql = "SELECT * FROM question WHERE questionid = :questionid";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":questionid", $questionid);

        // Set parameters
        $param_questionid = trim($_GET["questionid"]);

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
                $no = $row["no"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
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
    echo $_GET["questionid"];
    //header("location: error.php");
    //exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Question</title>
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
        <div style="background-color:blue; padding: 20px; background: rgba(202, 222, 238, 0.6)" >
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Question</h1>
                    <div class="form-group">
                        <label>Question No</label>
                        <p><b><?php echo $row["no"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Criteria ID</label>
                        <p><b><?php echo $row["cid"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Rating</label>
                        <p><b><?php echo $row["rating"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Question</label>
                        <p><b><?php echo $row["question"]; ?></b></p>
                    </div>
                  
                    <p><a href="viewQuestion1.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>