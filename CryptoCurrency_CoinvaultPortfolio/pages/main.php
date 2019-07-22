<?php ob_start();
session_start();?><!DOCTYPE html>
<!--
 Created on : 10-Mar-2018, 4:09:51 PM
    Author     : Elliot Tadic
    Final Project

    main.php will retrieve account balances linked to the users username
    from a database, and display them in text in the form of an electronic portfolio. 
    It will feature a refresh button that will use PHP to fetch the most current price 
    of each stock/coin and update the pricing/coin as it fluxuates every 10 minutes. The total value of 
    all Users stocks will be displayed above the main UI.

    Users will be able to refresh current stock prices and in turn their total assets 
    value. Users will be able to save their account balances in a database so they won't have to 
    enter their balances everytime they wish to use the app.
-->
<html>
    <head>
        <title>Coin Vault</title>
        <link rel="stylesheet" href="../css/main.css">
        <script type="text/javascript" src="../javascript/Java.js"></script>

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
        $ltcBalance = ""; //Current balanceof Litecoin stock
        $con = ""; //Database connection
        //Establishes a databse connection
        function getDatabaseConnection() {
            global $con;

            $con = mysqli_connect("127.0.0.1", "root", "mj2a56zx3d", "CoinVault");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
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

        //Redirects to updateBalanceEth page
        function updateBalanceEth() {
            global $ID;

            if (isset($_POST['BalanceEth'])) {

                header("Location: updateBalanceEth.php");
            }
        }

        //Redirects to updateBalanceLtc page
        function updateBalanceLtc() {
            global $ID;

            if (isset($_POST['BalanceLtc'])) {

                header("Location: updateBalanceLtc.php");
            }
        }

        //Redirects to updateBalanceBtc page
        function updateBalanceBtc() {
            global $ID;

            if (isset($_POST['BalanceBtc'])) {

                 header("Location: updateBalanceBtc.php");
            }
        }

        //Redirects to updateBalanceTrx page
        function updateBalanceTrx() {
            global $ID;

            if (isset($_POST['BalanceTrx'])) {

                 header("Location: updateBalanceTrx.php");
            }
        }

        //Redirects to charts page
        function redirectCharts() {
            global $ID;
            if (isset($_POST['redirect'])) {

                header("Location: charts.php");
            }
        }

        //Redirects to Login page
        function redirectLogin() {

            if (isset($_POST['redirect2'])) {

                header("Location: ../index.php");
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

        getDatabaseConnection();
        updateBalanceEth();
        updateBalanceBtc();
        updateBalanceLtc();
        updateBalanceTrx();
        updateLastPrice();
        retrieveBalances();
        redirectCharts();
        redirectLogin();
        ?>


        <div class="title">
            <h1>My Portfolio</h1><br>
            <p id="value"></p>
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <input type="submit" name="redirect" Value="See Graph">
            </form>

            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <input type="submit" name="redirect2" Value="Log Out">
            </form>


        </div>



        <div class="container"> 
            <div class="ETH">
                <h2>ETH</h2>
                <img id="1" src="../images/Ethereum.png" alt="Logo"> 
                <p id="titleEth">Last Value(USD)</p>
                <p id="CurrentValueEth">$<?php echo $ethLastValue; ?></p><br>
                <p id="LabelEth">Balance</p><br>
                <p id="HoldingsEth"><?php echo $ethBalance; ?></p> 
                <form action="<?php $_SERVER["PHP_SELF"] ?> "method="POST">
                    <input type="submit" name="BalanceEth" Value="Update Balance">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>">
                </form>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                    <input type="submit" name="LastPrice" Value="Update Last Price">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>"
                </form>
            </div> 
            <div class="BTC">
                <h2>BTC</h2>
                <img id="2" src="../images/Bitcoin.png" alt="Logo">
                <p id="titleBtc">Last Value(USD)</p>
                <p id="CurrentValueBtc">$<?php echo $btcLastValue; ?></p><br>
                <p id="LabelBtc">Balance</p><br>
                <p id="HoldingsBtc"><?php echo $btcBalance; ?></p> 
                <form action="javascript:updateBalanceBtc()">
                    <input type="submit" name="BalanceBtc" Value="Update Balance">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>">
                </form>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                    <input type="submit" name="LastPrice" Value="Update Last Price">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>"
                </form>
            </div> 
            <div class="LTC">
                <h2>LTC</h2>
                <img id="3" src="../images/LiteCoin.png" alt="Logo">
                <p id="titleLtc">Last Value(USD)</p>
                <p id="CurrentValueLtc">$<?php echo $ltcLastValue; ?></p><br>
                <p id="LabelLtc">Balance</p><br>
                <p id="HoldingsLtc"><?php echo $ltcBalance; ?></p>
                <form action="<?php $_SERVER["PHP_SELF"] ?>">
                    <input type="submit" name="BalanceLtc" Value="Update Balance">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>">
                </form>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                    <input type="submit" name="LastPrice" Value="Update Last Price">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>"
                </form>

            </div> 
            <div class="TRX">
                <h2>TRX</h2>
                <img id="4" src="../images/Tronix.png" alt="Logo">
                <p id="titleTrx">Last Value(USD)</p>
                <p id="CurrentValueTrx">$<?php echo $trxLastValue; ?></p><br>
                <p id="LabelTrx">Balance</p><br>
                <p id="HoldingsTrx"><?php echo $trxBalance; ?></p> 
                <form action="<?php $_SERVER["PHP_SELF"] ?>">
                    <input type="submit" name="BalanceTrx" Value="Update Balance">
                    <input type="hidden" name="ID" value="<?php echo $ID ?>">
                </form>
                <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                    <input type="submit" name="LastPrice" Value="Update Last Price" >
                    <input type="hidden" name="ID" value="<?php echo $ID ?>"
                </form>

            </div> 
        </div>
        
<?php echo '<script type="text/javascript"> getTotalMain();</script>'; ?>

    </body>
</html>
<?php ob_flush(); ?>