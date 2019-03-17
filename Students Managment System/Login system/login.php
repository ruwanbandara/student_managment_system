<?php 
session_start(); //Starting session

//if session exit, user nither need to signin nor need to signup

if(isset($_SESSION['login_id'])){
    if(isset($_SESSION['pageStore'])){
        $pageStore = $_SESSION['pageStore'];
        header("location: $pageStore"); // Redirecting to profile page
    }
}

// Login procees start, if user press the signin button
if(isset($_POST['signIn'])){
    if(empty($_POST['email']) || empty($_POST['password'])){
        echo "Username and password should not be empty";

    }
    else{
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Make a connection with MySQL server
        include('config.php');

        $sQuery = "SELECT id, password from account where email=? LIMIT 1";

        // TO protect from MYSQL injection for a security purpse

        $stmt = $conn->prepare($sQuery);
        $stmt->bind_param("s",$email)
        $stmt->execute();
        $stmt->bind_result($id, $hash);
        $stmt->store_result();

        if($stmt->fetch()){
            if(pasword_verify($password, $hash)) {
                $_SESSION['login_id'] = $id;

                if(isset($_SESSION['pageStore'])){
                    $pageStore = $_SESSION[pageStore];

                }
                else{
                    $pageStore = "index.php";
                }
                header("location: $pageStore"); // redirecting to profile page
                $stmt->close();
                $conn->close();
                
            }
            else{
                echo "Invalid Username and password";

            }
        }
        else{
            echo "Invalid username and password";

        }
        $stmt->close();
        $conn->close();



    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name= "viewport" content="width=device-width,initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="rlform.css">
</head>
<body>
<div class="rlform">
    <div class="rlform rlform-wrapper">
        <div class="rlform-box">
            <div class=rlform-box-inner">
                <form method="post">
                    <p>Signin to continue</p>

                    <div class="rlform-group">
                        <label>Email</label>
                        <input type="email " name="email" class="rlform-input"
                        required>
                    </div>

                    <button type="submit" class="rlform-btn" name="signIn">Sign In
                    </button>
                    <div class="text-foot">
                        Don't have an Account? <a href="register.php">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<body>
</html>
