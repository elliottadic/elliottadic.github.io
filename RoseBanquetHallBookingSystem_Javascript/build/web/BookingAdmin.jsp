<%-- 
    Document   : BookingAdmin
    Created on : 19-Apr-2018, 12:28:54 AM
    Author     : elliottadic
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page import="data.Booking"%>
<%@page import="data.BookingDAO"%>
<%@page import="java.util.ArrayList"%>
<%@page import="data.Client"%>
<%@page import="data.ClientDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Booking Admin</title>
    </head>
    <body>
        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <h1>Booking Administration</h1>
        <ol>
            <%
                BookingDAO BDAO = new BookingDAO();
                ArrayList<Booking> bookings = BDAO.retrieveBookings();
                String hiddenNumber = "";
                for (Booking b : bookings) {

                    String sql = "SELECT * FROM (dbRoseBanquetHall.Booking INNER JOIN Client ON Client.ClientID = Booking.ClientID INNER JOIN Hall ON Hall.HallID = Booking.HallID) WHERE BookingID= " + b.getID();
                    DBManager dbm = new DBManager();
                    ResultSet rs = dbm.executeQuery(sql);
                    if (rs.next()) {
                        char[] numberChars = rs.getString("ClientCreditCard").toCharArray();

                        numberChars[0] = '*';
                        numberChars[1] = '*';
                        numberChars[2] = '*';
                        numberChars[3] = '*';
                        numberChars[4] = '*';
                        numberChars[5] = '*';
                        numberChars[6] = '*';
                        numberChars[7] = '*';

                        hiddenNumber = String.valueOf(numberChars);

            %>
            <li style="margin: 20px 0">
                <form action="RoseBanquetHallServletThree" method="GET">
                    Hall: <%=rs.getString("HallName")%> <br>
                    Client: <%=rs.getString("ClientName")%><br>
                    Card Number: <%=hiddenNumber%><br>
                    Date: <%=b.getDate()%>
                    <input type="submit" name="action" value="Delete Booking" style="float: right; margin-right: 800px; display:inline-block;">
                    <input type="submit" name="action" value="Edit Booking" style="float: right; display:inline-block;">
                    <input type="hidden" name="ID" value="<%=b.getID()%>">
                </form>
            </li>
            <%
                    }
                }
            %>
        </ol>

        <form style="display:inline-block;" action="bookHall.jsp" method="GET">

            <input type="submit" value="Book Hall">

        </form>

        <form style="display:inline-block;" action="index.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>