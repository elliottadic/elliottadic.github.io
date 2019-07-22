/* 
 Created on : 10-Mar-2018, 4:09:51 PM
 Author     : Elliot Tadic
 Final Project
 Java.js is the script file read from by main.html, and charts.html
 
 
 */



function getTotalMain() {
    var ethValue = document.getElementById("CurrentValueEth").innerHTML;
    var ethHolding = parseFloat(document.getElementById("HoldingsEth").innerHTML);
    ethValue = parseFloat(ethValue.replace("$", ""));
    var btcValue = document.getElementById("CurrentValueBtc").innerHTML;
    var btcHolding = parseFloat(document.getElementById("HoldingsBtc").innerHTML);
    btcValue = parseFloat(btcValue.replace("$", ""));
    var ltcValue = document.getElementById("CurrentValueLtc").innerHTML;
    var ltcHolding = parseFloat(document.getElementById("HoldingsLtc").innerHTML);
    ltcValue = parseFloat(ltcValue.replace("$", ""));
    var trxValue = document.getElementById("CurrentValueTrx").innerHTML;
    var trxHolding = parseFloat(document.getElementById("HoldingsTrx").innerHTML);
    trxValue = parseFloat(trxValue.replace("$", ""));
    var totalValue = (ethValue * ethHolding) + (btcValue * btcHolding) + (ltcValue * ltcHolding) + (trxValue * trxHolding);
    totalValue = (Math.round(totalValue * 100.0) / 100.0).toFixed(2);
    document.getElementById("value").innerHTML = "Value USD: $" + totalValue;
} //Gets value of all user balances and trading prices, then displays total assets

function getTotalCharts(ethBalance, btcBalance, ltcBalance, trxBalance, trxPrice, ethPrice, btcPrice, ltcPrice) {

    var ethTotal = ethBalance * ethPrice;
    var btcTotal = btcBalance * btcPrice;
    var ltcTotal = ltcBalance * ltcPrice;
    var trxTotal = trxBalance * trxPrice;


    var totalBalance = ethTotal + btcTotal + ltcTotal + trxTotal;
    totalBalance = (Math.round(totalBalance * 100.0) / 100.0).toFixed(2);
    document.getElementById("value").innerHTML = "Value USD: $" + totalBalance;
} //Gets value of all user balances and trading prices, then displays total assets

function getGraph(ethBalance, btcBalance, ltcBalance, trxBalance, trxPrice, ethPrice, btcPrice, ltcPrice) {

    var ethTotal = ethBalance * ethPrice;
    var btcTotal = btcBalance * btcPrice;
    var ltcTotal = ltcBalance * ltcPrice;
    var trxTotal = trxBalance * trxPrice;


    var totalBalance = ethTotal + btcTotal + ltcTotal + trxTotal;

    var percentEth = (ethTotal / totalBalance) * 100;
    var percentBtc = (btcTotal / totalBalance) * 100;
    var percentLtc = (ltcTotal / totalBalance) * 100;
    var percentTrx = (trxTotal / totalBalance) * 100;


    var piechart = new CanvasJS.Chart("piechart", {
        animationEnabled: true,
        title: {
            text: "Crypto Currency Balance"
        },

        data: [{
                type: "pie",
                indexLabelFormatter: function (e) {
                    if (e.dataPoint.y === 0)
                        return "";
                    else
                        return e.dataPoint.label + " " + e.dataPoint.y.toFixed(2) + "%";
                },
                startAngle: 240,

                indexLabel: "{label} {y}",
                yValueFormatString: "##0.00\"%\"",
                dataPoints: [
                    {y: percentEth, label: "Ethereum"},
                    {y: percentBtc, label: "Bitcoin"},
                    {y: percentLtc, label: "Litecoin"},
                    {y: percentTrx, label: "TRON"}

                ]
            }]
    });
    piechart.render();


} //Gets value of all user balances and displays portfolio weight of each stock/coin




