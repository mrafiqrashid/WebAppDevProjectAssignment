<?php
// Include config file
require_once "config.php";
session_start();

//$userid = $_SESSION['userID'] = $_SESSION['userid'] ;
//echo $userid;

//$f = hash('md5', '123');
//echo $f;
//if (password_verify('123', $f)){
//    echo yes;
//}
// Define variables and initialize with empty values
$userid= $position = $username = $password = $cpassword ="";
$userid_err = $position_err = $username_err = $password_err = $cpassword_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $userid = rand(10000, 99999);
    $position = $_POST["position"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $r = hash('md5', $password);
    

    //echo $position.$username.$password.$password;
    // Validate position
    $input_position = trim($_POST["position"]);
    if (empty($input_position)) {
        $position_err = "Please enter a position.";
    }else {
        $position = $input_position;
    }


    // Validate password and confirm password
    $input_password = trim($_POST["password"]);
    $input_cpassword = trim($_POST["cpassword"]);
   // echo "ter".$input_cpassword."  ";

    if (empty($input_cpassword)) {

        $cpassword_err = "Please enter a confirm password.";
    }

    if (empty($input_password)) {
        $password_err = "Please enter a password.";
    } else if($input_cpassword != $input_password ){
            $cpassword_err = "Please enter a correct confirm password with password.";
        
    } else {
        $password = $input_password;
     //   echo "test";
    }







    // Check input errors before inserting in database
    if (empty($userid_err) && empty($position_err) && empty($username_err) && empty($password_err) && empty($cpassword_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO user (userid, position, username, password) VALUES (:userid, :position, :username, :password)";

        if ($stmt = $pdo->prepare($sql)) {
            // Set parameters
            $param_userid = $userid;
            $param_position = $position;
            $param_username = $username;
            $param_password = $password;

          //  echo $param_userid.$param_position.$param_username.$param_password;

            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":userid", $param_userid);
            $stmt->bindParam(":position", $param_position);
            $stmt->bindParam(":username", $param_username);
            $stmt->bindParam(":password", $r);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Records created successfully. Redirect to landing page
                header("location: k.php");
             //   header("location: index.php");
               exit();
             //echo $r;
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
                    <h2 class="mt-5">Register an Account</h2>
                    <p>Please fill this form and submit to create record to the database.</p>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


                    <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Position</label>
                            <input type="text" name="position" class="form-control <?php echo (!empty($postion_err)) ? 'is-invalid' : ''; ?>" value="Manager" readonly>
                            <span class="invalid-feedback"><?php echo $position_err; ?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="cpassword" class="form-control <?php echo (!empty($cpassword_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cpassword; ?>">
                            <span class="invalid-feedback"><?php echo $cpassword_err; ?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="k.php" class="btn btn-secondary ml-2">Back to Login</a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
