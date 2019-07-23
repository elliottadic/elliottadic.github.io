<?php ob_start(); ?><!DOCTYPE html>
<!--
The index page will prompt users for a username and password that fit a set's
criteria. The page will determine if the input is valid and either redirect thematic
to the Home.php page, or display an error message.


Created By: Elliot Tadic 

-->

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php
        $password = ""; //Global variable carrying the current password value
        $email = ""; //Global variable carrying the current email value
        $errPassword = ""; //Global variable carrying the appropriate error message for the password field
        $errEmail = ""; //Global variable carrying the appropriate error message for the email field

        
        //Funtion validateLogin() Determines if there is any input and decides if its valid. Will display error message or redirect
        
        
        function validateLogin(){
            global $password;
            global $email;
            global $errPassword;
            global $errEmail;
            
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["password"])) {
                $errPassword = "Password cannot be empty";
            } else if (isset($_POST["password"])) {
                $password = $_POST["password"];

                if (!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{6,}$/", $password)) {
                    $errPassword = "Password must contain one uppercase, one lowercase, and one digit. Minimum 6 characters.";
                    $password = "";
                }
            }

            if (empty($_POST["email"])) {
                $errEmail = "Email cannot be empty";
            } else if (isset($_POST["email"])) {
                $email = $_POST["email"];

                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $email = $_POST["email"];
                } else {
                    $errEmail = "Not a valid email address format";
                    $email = "";
                }
            }
            
            
            if (($email !== "") && ($password !== "")) {

                header("Location: Home.php");
            }
            
        }
        }
        
        validateLogin();
        
        ?>
        <div class="title"><h1>Student Grade Calculator</h1><br></div>

        <div class="container">




            <div class="containerForm">
                <h2>Login</h2>
                <form name="login" method="POST" action="<?php $_SERVER["PHP_SELF"] ?>">
                    <p>Email</p>
                    <input type="text" name="email" placeholder="Email" ><br>
                    <span class="error"><?php echo $errEmail; ?></span> <br>
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Password" ><br>
                    <span class="error"><?php echo $errPassword; ?></span> <br>
                    <input type="Submit" Value ="Submit">
                </form>

            </div>



        </div>



    </body>
</html>
<?php ob_flush(); ?>