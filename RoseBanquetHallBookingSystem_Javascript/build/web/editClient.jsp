<%-- 
    Document   : editClient
    Created on : 18-Apr-2018, 7:54:06 PM
    Author     : elliottadic
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page import="data.ClientDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit Client</title>
    </head>
    <body>
        <%! String Id = "";%>
        <%! String name = "";%>
        <%! String number = "";%>
        <%! String error = "";%>

        <%
            try {
                DBManager dbm = new DBManager();
                Id = String.valueOf(request.getAttribute("ID"));
                ResultSet rs = dbm.executeQuery("SELECT * FROM dbRoseBanquetHall.Client WHERE ClientID='" + Id + "'");
                while (rs.next()) {

                    name = rs.getString("ClientName");
                    number = rs.getString("ClientCreditCard");
                }

            } catch (Exception e) {
                out.println("Error getting Client info " + e);
            }
            
            error = String.valueOf(request.getAttribute("Error"));

            if (error == "null") {
                error = "";
            } else {
                error = String.valueOf(request.getAttribute("Error"));
            }


        %>

        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <h1>Edit Client</h1>
        <form action="RoseBanquetHallServletTwo" method="GET">
            <br>
            Name: <input type="text" name="name" size="15" value="<%= name%>"><br>
            Credit Card: <input type="text" name="number" size="15" value="<%= number%> "><br>
            <span style="color: Red;"> <%= error%> </span>
            <input type="hidden" name ="Id" value="<%= Id%>">
            <br><br><input type="submit" name="action" value="Save">
        </form><br>
        <form style="display:inline;" action="ClientAdmin.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>