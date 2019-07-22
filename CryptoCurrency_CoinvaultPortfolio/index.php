<?php ob_start(); 
session_start();
    
?>
<!DOCTYPE html>
<!--
 Created on : 10-Mar-2018, 4:09:51 PM
    Author     : Elliot Tadic
    Final Project

    index.php will feature fields for username and password. It will act as a
    gateway into the site. Users will enter their credentials and they will be 
    verified against server values before having access to user stock balances.
-->
<html>
    <head>
        <title>Coin Vault</title>
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="javascript/Java.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        
        $username = ""; //Users username
        $password = ""; //Users password
        $errUsername = ""; //Error message for username exceptions
        $errPassword = ""; //Error message for password exceptions
        $con = ""; //Database connection
        
        //Establishes a database connection
        function getDatabaseConnection() {
            global $con;

            $con = mysqli_connect("127.0.0.1", "root", "mj2a56zx3d", "CoinVault");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
        }

        //Verifies user input and allows access to account
        function validateLogin() {
            global $username;
            global $password;
            global $errUsername;
            global $errPassword;
            global $con;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (empty($_POST["username"])) {
                    $errUsername = "Username cannot be empty!";
                } else if (isset($_POST["username"])) {
                    $username = $_POST["username"];
                }

                if (empty($_POST["password"])) {
                    $errPassword = "Password cannot be empty!";
                } else if (isset($_POST["password"])) {
                    $password = $_POST["password"];
                }

                if ($password !== "" && $username !== "") {



                    $sql = "SELECT userID, username, password FROM UserInfo WHERE username='$username'";

                    $result = $con->query($sql);

                    $row = $result->fetch_assoc();

                    if (!$row) {
                        $errUsername = "User does not exist!";
                    } else {

                        if ($row["password"] == $password) {
                            $ID = $row["userID"];
                            $_SESSION['ID']=$ID;
                            header("Location: pages/main.php");
                        } else {
                            $errPassword = "Invalid password! Try Again!";
                        }

                        $con->close();
                    }
                }
            }
        }

        //Redirects to Create User page
        function redirectCreate() {

            if (isset($_POST['Create'])) {

                header("Location: pages/createUser.php");
            }
        }

        getDatabaseConnection();
        redirectCreate();
        validateLogin();
        ?>

        <div class="title"><h1>Coin Vault</h1><br></div>

        <div class="container">

            <div class="picture"></div>

            <div class="fields">
                <div class="containerForm">
                    <h2>Login</h2>
                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                        <p>Username</p>
                        <input type="text" name="username" placeholder="Username"><br>
                        <span class="error"><?php echo $errUsername; ?></span> <br>
                        <p>Password</p>
                        <input type="password" name="password" placeholder="Password"><br>
                        <span class="error"><?php echo $errPassword; ?></span> <br>
                        <input type="Submit"  Value ="Submit">
                        <input type="Submit" name="Create" Value ="Create New User">
                    </form>

                </div>

            </div>  

        </div>
    </body>
    
</html>
<?php ob_flush(); ?>