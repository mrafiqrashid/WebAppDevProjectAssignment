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
$userid= $position = $username = $password = "";
$userid_err = $position_err = $username_err = $password_err = "";
$pdo;
//$userID = $_SESSION['userID'];
// Processing form data when form is submitted
//echo $_GET['userid'];
if (isset($_POST['userid']) && !empty($_POST['userid'])) {
    $userid = $_POST['userid'];
    $position = $_POST['position'];
    $username = $_POST['username'];
    $password = $_POST['password'];
 //   echo $userid.$position.$username.$password;
 //echo "position".$position; 


    // Validate position
    $input_position = trim($position);
    if (empty($input_position)) {
        $position_err = "Please enter position.";
    } else {
        $position = $input_position;
    }

    // Validate username
    $input_username = trim($username);
    if (empty($input_username)) {
        $username_err = "Please enter a username.";
    } else {
        $username = $input_username;
    }

    // Validate password
    $input_password = trim($password);
    if (empty($input_password)) {
        // echo $input_category;
        $password_err = "Please enter a password.";
    }else {
        $password = $input_password;
    }



    // Check input errors before inserting in database
    if (empty($userid_err) && empty($position_err) && empty($username_err) && empty($password_err)) {
        // Prepare an update statement
        $sql = "UPDATE user SET userid=:userid, position=:position, username=:username, password=:password WHERE userid=:userid";
    //    echo $userid.$position.$username.$password;

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userid", $userid);
            $stmt->bindParam(":position", $position);
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records updated successfully. Redirect to landing page
                if ($position = 'Admin'){
                    header("location: homeAdmin.php");
                    exit();

                }
                if ($position = 'Manager'){
                header("location: homeManager.php");
                exit();
                }
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
    
    if (isset($_GET["userid"]) && !empty(trim($_GET["userid"]))) {
        // Get URL parameter
        $userid =  trim($_GET["userid"]);
       // echo $userid;

        // Prepare a select statement
        $sql = "SELECT * FROM user WHERE userid = :userid";
        if ($stmt = $pdo->prepare($sql)) {
            
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userid", $userid);
            $stmt->execute();
            $row = $stmt->fetch();

          //  echo "position".$row['position'];
            $userid = $row['userid'];
            $position = $row['position'];
            $username = $row['username'];
            $password = $row['password'];
                       


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                

                
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
    <title>Update Profile</title>
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
                    <h2 class="mt-5">Update Profile</h2>
                    <p>Please edit the input values and submit to update the Information.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" name="userid" class="form-control <?php echo (!empty($userid_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $userid; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $userid_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control <?php echo (!empty($position_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $position; ?>" readonly>
                            <span class="invalid-feedback"><?php echo $position_err; ?></span>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>

                        <input type="hidden" name="userid" value="<?php echo $userid; ?>" />
                        <input type="hidden" name="position" value="<?php echo $position; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="homeAdmin.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
