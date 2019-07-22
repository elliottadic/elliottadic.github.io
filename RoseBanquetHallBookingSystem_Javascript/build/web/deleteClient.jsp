<%-- 
    Document   : deleteClient
    Created on : 18-Apr-2018, 7:42:42 PM
    Author     : elliottadic
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete Client</title>
    </head>
    <body>

        <%! String id = "";%>
        <%! String name = "";%> 
        <%! String number = "";%> 
        <%
            try {
                DBManager dbm = new DBManager();
                id = String.valueOf(request.getAttribute("ID"));
                ResultSet rs = dbm.executeQuery("Select * FROM dbRoseBanquetHall."
                        + "Client WHERE ClientID='" + id + "'");
                while (rs.next()) {

                    name = rs.getString("ClientName");
                    number = rs.getString("ClientCreditCard");
                }
            } catch (Exception e) {
                out.println("Error getting halls " + e);
            }
        %>
        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <p>Delete Client : <%=name%> <br>Card Number : <%=number%>
            <br><br>Are you sure you want to delete this Client?</p>

        <form action="RoseBanquetHallServletTwo" method="GET">
            <br><input type="submit" name="action" value="Delete">
            <input type="hidden" name="ID" value="<%=id%>">
        </form>
        <form action="ClientAdmin.jsp" method="GET">
            <br><input type="submit" name="action" value="Cancel">
        </form>
    </body>
</html>
