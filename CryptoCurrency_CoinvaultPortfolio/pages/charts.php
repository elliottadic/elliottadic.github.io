<?php ob_start(); 
session_start();?><!DOCTYPE html>
<!--

    Created on : 10-Mar-2018, 4:09:51 PM
    Author     : Elliot Tadic
    Final Project

    Charts.php will retrieve account balances linked to the users username
    from a database, and display them in the form of a pie chart. PHP will be used
    to fetch the most current price of each stock/coin and update the pie chart 
    as the values of the users stock balance changes. The total value of all Users 
    stocks will be displayed above the main UI.
-->
<html>
    <head>
        <title>Coin Vault</title>
        <link rel="stylesheet" href="../css/charts.css">
        <script type="text/javascript" src="../javascript/Java.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <?php
        if ($_SESSION['ID']) {
            $ID = $_SESSION['ID'];
        } //Maintains user identity accross requests/pages

        $ethLastValue = ""; //Current price of Ethereum stock
        $btcLastValue = ""; //Current price of Bitcoin stock
        $trxLastValue = ""; //Current price of Tronix stock
        $ltcLastValue = ""; //Current price of Litecoinstock
        $ethBalance = ""; //Current balance of Ethereum stock
        $btcBalance = ""; //Current balance of Bitcoin stock
        $trxBalance = ""; //Current balance of Tronix stock
        $ltcBalance = ""; //Current balance of Litecoin stock
        $con = ""; //Database connection

        //Establishes a database connection
        function getDatabaseConnection() {
            global $con;

            $con = mysqli_connect("127.0.0.1", "root", "mj2a56zx3d", "CoinVault");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
        }


        //Retrieves all stock balances belonging to the user
        function retrieveBalances() {

            global $ethBalance;
            global $btcBalance;
            global $trxBalance;
            global $ltcBalance;
            global $ID;
            global $con;


            $sql = "SELECT ETHBalance, BTCBalance, TRXBalance, LTCBalance FROM UserInfo WHERE userID='$ID'";

            $result = $con->query($sql);

            $row = $result->fetch_assoc();

            $ethBalance = round($row['ETHBalance'], 8);
            $btcBalance = round($row['BTCBalance'], 8);
            $trxBalance = round($row['TRXBalance'], 8);
            $ltcBalance = round($row['LTCBalance'], 8);
        }

        //Refreshes stock values from URL
        function updateLastPrice() {
            global $ethLastValue;
            global $btcLastValue;
            global $ltcLastValue;
            global $trxLastValue;
            $url = "https://api.coinmarketcap.com/v1/ticker/?limit=0";
            $fgc = file_get_contents($url);
            $json = json_decode($fgc, true);

            foreach ($json AS $d) {

                if ($d['id'] == "ethereum") {

                    $ethLastValue = $d['price_usd'];
                }
            }

            $ethLastValue = round($ethLastValue, 2);

            foreach ($json AS $d) {

                if ($d['id'] == "bitcoin") {

                    $btcLastValue = $d['price_usd'];
                }
            }

            $btcLastValue = round($btcLastValue, 2);

            foreach ($json AS $d) {

                if ($d['id'] == "tron") {

                    $trxLastValue = $d['price_usd'];
                }
            }

            $trxLastValue = round($trxLastValue, 2);

            foreach ($json AS $d) {

                if ($d['id'] == "litecoin") {

                    $ltcLastValue = $d['price_usd'];
                }
            }

            $ltcLastValue = round($ltcLastValue, 2);
        }

        //Redirects to Wallet/Home page
        function redirectWallet() {
            global $ID;


            if (isset($_POST['redirect'])) {

                header("Location: main.php");
            }
        }
        
        //Redirects to Login page
        function redirectLogin() {

            if (isset($_POST['redirect2'])) {

                header("Location: ../index.php");
            }
        }



        getDatabaseConnection();
        retrieveBalances();
        updateLastPrice();
        redirectWallet();
        redirectLogin();
        
        ?>


        <div class="title">
            <h1>My Portfolio</h1><br>
            <p id="value"></p>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <input type="submit" name="redirect" Value="See Wallet">
            </form>

            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <input type="submit" name="redirect2" Value="Log Out">
            </form>


        </div>


        <div class="container">

            <div class="piechart" id="piechart" ></div>


        </div>
<?php
if ($btcBalance == "0" && $ethBalance == "0" && $ltcBalance == "0" && $trxBalance == "0") {
    
} else {
    
    echo '<script type="text/javascript">getGraph( ' . $ethBalance . ' , ' . $btcBalance . ', ' . $ltcBalance . ', ' . $trxBalance . ' , ' . $trxLastValue . ' , ' . $ethLastValue . ' , ' . $btcLastValue . ' , ' . $ltcLastValue . ');</script>';
}
echo '<script type="text/javascript">getTotalCharts( ' . $ethBalance . ' , ' . $btcBalance . ', ' . $ltcBalance . ', ' . $trxBalance . ' , ' . $trxLastValue . ' , ' . $ethLastValue . ' , ' . $btcLastValue . ' , ' . $ltcLastValue . ');</script>';
?>
    </body>
</html>
<?php ob_flush(); ?>