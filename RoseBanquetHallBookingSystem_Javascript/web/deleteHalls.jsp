<%-- 
    Document   : deleteHalls
    Created on : 8-Apr-2018, 6:31:14 PM
    Author     : elliottadic
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete hall</title>
    </head>
    <body>

        <%! String id = "";%>
        <%! String name = "";%> 
        <%
            try {
                DBManager dbm = new DBManager();
                id = String.valueOf(request.getAttribute("ID"));
                ResultSet rs = dbm.executeQuery("Select HallName FROM "
                        + "dbRoseBanquetHall.Hall WHERE HallID='" + id + "'");
                while (rs.next()) {

                    name = rs.getString("HallName");
                }
            } catch (Exception e) {
                out.println("Error getting halls " + e);
            }
        %>
        <img src='rose.jpg'>
        <h1>Rose Banquet Halls</h1>
        <p>Delete Hall : <%=name%> 
            <br><br>Are you sure you want to delete this hall?</p>

        <form action="RoseBanquetHallServlet" method="GET">
            <br><input type="submit" name="action" value="Delete">
            <input type="hidden" name="ID" value="<%=id%>">
        </form>
        <form action="HallAdmin.jsp" method="GET">
            <br><input type="submit" name="action" value="Cancel">
        </form>
    </body>
</html>
