<?php ob_start(); ?><!DOCTYPE html>
<!--
 Created on : 10-Mar-2018, 4:09:51 PM
    Author     : Elliot Tadic
    Final Project

createUser.php will be used to add new users to the database. Before adding, the
program will check if the user already exists and display an error message appropriately.

 
-->
<html>
    <head>
        <title>Coin Vault</title>
        <link rel="stylesheet" href="../css/update.css">
        <script type="text/javascript" src="../javascript/Java.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        $errUsername = ""; //Error message for username exceptions
        $errPassword = ""; //Error message for password exceptions
        $username = ""; //User entered username
        $password = ""; //User entered password
        $con = ""; //Database connection
        //Establishes a connection to the database
        function getDatabaseConnection() {
            global $con;

            $con = mysqli_connect("127.0.0.1", "root", "mj2a56zx3d", "CoinVault");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
        }

        //Adds a user to the database using provided information
        function createUser() {
            global $username;
            global $password;
            global $errUsername;
            global $errPassword;
            global $con;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST["Cancel"])) {

                    header("Location: ../index.php");
                }

                if (empty($_POST["username"])) {
                    $errUsername = "Username cannot be empty!";
                } else if (isset($_POST["username"])) {
                    $username = $_POST["username"];
                }

                if (empty($_POST["password"])) {
                    $errPassword = "Password cannot be empty!";
                } else if (isset($_POST["password"])) {
                    $password = $_POST["password"];
                    if (!preg_match('/^.{6,12}$/', $password)) {
                        $errPassword = "Must be 6-12 characters!!";
                        $password = "";
                    }
                }

                if ($password !== "" && $username !== "") {


                    $sql = "INSERT INTO UserInfo (username, password, ETHBalance, BTCBalance, LTCBalance, TRXBalance) values ('$username', '$password', '0', '0', '0', '0')";
                    $sql2 = "SELECT userID, username, password FROM UserInfo WHERE username='$username'";
                    $result = $con->query($sql2);
                    $row = $result->fetch_assoc();

                    if (!$row) {

                        $result = $con->query($sql);
                        header("Location: ../index.php");
                    } else {
                        $errUsername = "Username Taken!";
                    }



                    $con->close();
                }
            }
        }

        getDatabaseConnection();
        createUser();
        ?>


        <div class="title">
            <h1>Coin Vault</h1><br>
            <p id="value">Create New User</p><br>
        </div>


        <div class="container2">




            <div class="containerForm">

                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                    <p>Username</p>
                    <input type="text" name="username" placeholder="Username"><br>
                    <span class="error2"><?php echo $errUsername; ?></span> <br><br>
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Password"><br>
                    <span class="error2"><?php echo $errPassword; ?></span> <br><br>

                    <input type="Submit" name="Create" Value ="Create User">
                    <input type="Submit"  name="Cancel" Value ="Cancel">
                </form>



            </div>  

        </div>


    </body>
</html>
<?php ob_flush(); ?>