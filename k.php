<?php
require_once "config.php";
session_start();
$username = "";
$password = "";
$errors = "";
$position = "";
    
if (isset($_POST['loginmanager'])){

    //set login attempt if not set
		if(!isset($_SESSION['attempt'])){
			$_SESSION['attempt'] = 0;
        }

        //check if there are 3 attempts already
        if($_SESSION['attempt'] == 3) {
			$_SESSION['error'] = 'Attempt limit reach';
           
            
		}

    else if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = hash('md5', $_POST['password']);;
        
        require_once "config.php";
        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(":username", $username);
      //  $stmt->bindParam(":position", $position);
        $stmt->execute();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);


        
        if ($rows) {



            
            //echo $rows['position'];
            if ($rows['position'] == 'Manager'){
                echo "yes manager";

             
                
            
                if ($password == $rows['password']) {
                    $_SESSION['userid'] = $rows['userid'];
                    $_SESSION['username'] = $rows['username'];
                    //$_SESSION['success'] = 'Login successful';
					//unset our attempt
					unset($_SESSION['attempt']);
                    //echo $_SESSION['username'];
                    header("Location: homeManager.php");
                } else {
                    $_SESSION['error'] = 'Password incorrect';
                    //this is where we put our 3 attempt limit
					$_SESSION['attempt'] += 1;
                
                    if($_SESSION['attempt'] == 3){
                        $errors = "attempt in 20 seconds";
						$_SESSION['attempt_again'] = time() + (20);//20 seconds
                        
                    }  
                }
            }
            else $errors = "Your username is for Admin account!";
            
        } 
        else {
            $errors = "Your username is not found!";
        }
    }
}


	//check if can login again
	if(isset($_SESSION['attempt_again'])){
		$now = time();
		if($now >= $_SESSION['attempt_again']){
			unset($_SESSION['attempt']);
			unset($_SESSION['attempt_again']);
            header ("Location: k.php");
		}
	}
	
    if (isset($_POST['loginadmin'])){
        

        //set login attempt if not set
            if(!isset($_SESSION['attempt'])){
                $_SESSION['attempt'] = 0;
            }
    
            //check if there are 3 attempts already
            if($_SESSION['attempt'] == 3) {
                $_SESSION['error'] = 'Attempt limit reach';
                
                
            }
    
        else if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = hash('md5', $_POST['password']);;
            require_once "config.php";
            $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
            $stmt->bindParam(":username", $username);
           // $stmt->bindParam(":position", $position);
            $stmt->execute();
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
         
            if ($rows) {

                if ($rows['position'] == 'Admin'){
                    if ($password == $rows['password']) {
                        $_SESSION['userid'] = $rows['userid'];
                        $_SESSION['username'] = $rows['username'];
                        //$_SESSION['success'] = 'Login successful';
                        //unset our attempt
                        unset($_SESSION['attempt']);
                        //echo $_SESSION['username'];
                        header("Location: homeAdmin.php");
                    } else {
                        $_SESSION['error'] = 'Password incorrect';
                        //this is where we put our 3 attempt limit
                        $_SESSION['attempt'] += 1;
                    
                        if($_SESSION['attempt'] == 3){
                            $errors = "attempt in 20 seconds";
                            $_SESSION['attempt_again'] = time() + (20);  //20 seconds
                          
                        }  
                    }
                }
                    else $errors = "Your username is for Manager account!";
            } 
            else {
                $errors = "Your username is not found!";
            }
        }
    }

    
    
        //check if can login again
        if(isset($_SESSION['attempt_again'])){
            $now = time();
            if($now >= $_SESSION['attempt_again']){
                unset($_SESSION['attempt']);
                unset($_SESSION['attempt_again']);
                header ("Location: k.php");
            }
        }
?>


<html lang="en">

<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="loginStyle.css">


    <style>
body {
  background-image: url('hihi.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed; 
  background-size: 100% 100%;
}
</style>
</head>

<body>
    <div class="login-form">
        <form method="post">
            <h2 class="text-center">Project Complexity and Risk Assessment Tool Log in</h2>
            <?php
            if ($errors != "") {
                echo '<p style="color:red">' . $errors;
            }
            ?>
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            </div>
            <div class="form-group" style="margin: auto;">
                <input type="submit" name="loginadmin" class="btn btn-primary btn-lg" value="Login as a Admin">
            
                <input type="submit" name="loginmanager" class="btn btn-primary btn-lg" value="Login as a Manager">
            </div>
            <div class="form-group">
                <br>
            <div class="icheck-primary">
            Don't have an account?
            <a href="addManager.php" class="link-primary">Register here</a>
            </div>
        </div>
            <div class="form-group">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember"> Remember Me </label>
            </div>
        </div>
        </form>

        <?php
				if(isset($_SESSION['error'])){
					?>
					<div class="alert alert-danger text-center" style="margin-top:20px;">
						<?php echo $_SESSION['error']; ?>
					</div>
					<?php

					unset($_SESSION['error']);
				}

				if(isset($_SESSION['success'])){
					?>
					<div class="alert alert-success text-center" style="margin-top:20px;">
						<?php echo $_SESSION['success']; ?>
					</div>
					<?php

					unset($_SESSION['success']);
				}
			?>
    </div>
</body>
</html>