<%-- 
    Document   : updateHalls
    Created on : 8-Apr-2018, 6:28:26 PM
    Author     : elliottadic
--%>
<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page import="data.HallDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit Hall</title>
    </head>
    <body>
        <%! String Id = "";%>
        <%! String name = "";%>
        <%! String error = "";%>

        <%
            try {
                DBManager dbm = new DBManager();
                Id = String.valueOf(request.getAttribute("ID"));
                ResultSet rs = dbm.executeQuery("SELECT * FROM dbRoseBanquetHall.Hall WHERE HallID='" 
                        + Id + "'");
                while (rs.next()) {

                    name = rs.getString("HallName");
                }

            } catch (Exception e) {
                out.println("Error getting player info " + e);
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
        <h1>Edit Hall</h1>
        <form action="RoseBanquetHallServlet" method="GET">
            <br>Name: <input type="text" name="name" size="15" value="<%= name%>">
            <span style="color: Red;"> <%= error%> </span>
            <input type="hidden" name ="Id" value="<%= Id%>">
            <br><br><input type="submit" name="action" value="Save">
        </form><br>
        <form style="display:inline;" action="HallAdmin.jsp" method="GET">
            <input type="submit" value="Cancel"> 
        </form>
    </body>
</html>
