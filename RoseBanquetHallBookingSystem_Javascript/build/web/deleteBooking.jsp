<%-- 
    Document   : deleteBooking
    Created on : 19-Apr-2018, 3:50:26 AM
    Author     : elliottadic
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete Booking</title>
    </head>
    <body>

        <%! String id = "";%>
        <%! String date = "";%> 
        <%
            try {
                DBManager dbm = new DBManager();
                id = String.valueOf(request.getAttribute("ID"));
                ResultSet rs = dbm.executeQuery("Select Date FROM dbRoseBanquetHall."
                        + "Booking WHERE BookingID='" + id + "'");
                while (rs.next()) {

                    date = rs.getString("Date");
                }
            } catch (Exception e) {
                out.println("Error getting halls " + e);
            }
        %>
        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <p>Delete booking on : <%=date%> 
            <br><br>Are you sure you want to delete this booking?</p>

        <form action="RoseBanquetHallServletThree" method="GET">
            <br><input type="submit" name="action" value="Delete">
            <input type="hidden" name="ID" value="<%=id%>">
        </form>
        <form action="BookingAdmin.jsp" method="GET">
            <br><input type="submit" name="action" value="Cancel">
        </form>
    </body>
</html>