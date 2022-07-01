<?php

require_once "config.php";
session_start();

$_SESSION['userID'] = $_SESSION['userid'];
if (!isset($_SESSION['userID'])) {
    header("Location: logoutUser.php");
}
    else {
        $userID = $_SESSION['userID'];
    }

// Process delete operation after confirmation
if (isset($_POST["projectid"]) && !empty($_POST["projectid"])) {
    // Include config file
    require_once "config.php";

   

    // Prepare a delete statement
    $sql = "DELETE FROM project WHERE projectid = :projectid";

    if ($stmt = $pdo->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bindParam(":projectid", $param_projectid);

        // Set parameters
        $param_projectid = trim($_POST["projectid"]);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: viewProject.php");
            exit();
          // echo $_POST["projectid"];
          
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    unset($stmt);

    // Close connection
    unset($pdo);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["projectid"]))) {
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
    <title>Delete Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Project</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="projectid" value="<?php echo trim($_GET["projectid"]); ?>" >
                            <p>Are you sure you want to delete this question?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="viewProject.php" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>