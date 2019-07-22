<?php ob_start();
session_start();?><!DOCTYPE html>
<!--
 Created on : 10-Mar-2018, 4:09:51 PM
    Author     : Elliot Tadic
    Final Project

updateBalanceTrx.php will prompt the account owner to update their assets information
regarding Tronix stocks, and upload it to the database, changing the users total assets value.
 
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
        
       if ($_SESSION['ID']) {
            $ID = $_SESSION['ID'];
        } //Maintains user identity accross requests/pages

        $balance = ""; //Users new balance
        $errbalance = ""; //Error message for balance exceptions
        $con = ""; //Database connection

        //Establishes a connection to the database
        function getDatabaseConnection() {
            global $con;

            $con = mysqli_connect("127.0.0.1", "root", "mj2a56zx3d", "CoinVault");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
        }

        //Validates and uploads new stock balance to the database
        function updateBalance() {
            global $balance;
            global $errbalance;
            global $ID;
            global $con;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if (isset($_POST["Cancel"])) {
                    
                    header("Location: main.php?ID=$ID");
                }


                if (empty($_POST["TrxBalance"]) && $_POST["TrxBalance"] !== '0') {
                    $errbalance = "Balance cannot be empty";
                }

                if (isset($_POST["TrxBalance"]) && empty($_POST["Cancel"])) {

                    $balance = $_POST["TrxBalance"];

                    if (is_numeric($balance) == true) {

                        if ($balance > 65000000000) {

                            $errbalance = "Greater than coin supply!";
                        } else if ($balance < 0) {

                            $errbalance = "Cannot enter a negative value!";
                        } else if ($balance < 0.00000001 && $balance !== "0") {

                            $errbalance = "Smallest ownable value is  .00000001!";
                        } else {

                            $sql = "UPDATE UserInfo SET TRXBalance='$balance' WHERE userID=$ID";

                            $con->query($sql);

                            $con->close();
                            
                            
                           
                            
                            header("Location: main.php?ID=$ID");
                        }
                    } else {
                        $errbalance = "Must be a number!";
                    }
                }
            }
        }


        getDatabaseConnection();
        updateBalance();
        
        ?>


        <div class="title">
            <h1>My Portfolio</h1><br>
            <p id="value">Update Tronix Balance</p><br>
        </div>


        <div class="container"> 

            <img id="4" src="../images/Tronix.png" alt="Logo"> <h2>TRX</h2><br>

            <form action="<?php $_SERVER["PHP_SELF"] ?> " method="POST">
                <input type="text" name="TrxBalance" placeholder="New Tronix Balance"><br>
                <span class="error"><?php echo $errbalance; ?></span> <br>
                <input type="submit" name="submit" value="Submit">
                <input type="submit" name="Cancel" value="Cancel" >
            </form><br>

        </div>


    </body>
</html>
<?php ob_flush(); ?>