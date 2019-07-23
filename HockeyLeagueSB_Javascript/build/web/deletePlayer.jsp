<%-- 
    Document   : deletePlayer
    Created on : 23-Mar-2018, 8:51:54 PM
    Author     : elliottadic
--%>

<%@page import="java.sql.ResultSet"%>
<%@page import="data.DBManager"%>
<%@page import="data.playerDAO"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Delete Player</title>
    </head>
    <body>
        <%! String Id = "";%>
        <%! String name = "";%>
        <%
            try {
                DBManager dbm = new DBManager();
                Id = String.valueOf(request.getAttribute("ID"));
                ResultSet rs = dbm.executeQuery("SELECT playerName FROM dbhockeyleague.Players WHERE PlayerID='" + Id + "'");
                while (rs.next()) {

                    name = rs.getString("playerName");

                }

            } catch (Exception e) {
                out.println("Error getting players " + e);
            }


        %>
        <h1>HOCKEY LEAGUE</h1>
        <p> Delete player <%= name%> <br><br>Are you sure you want to delete this player?</p>

        <form action="HockeyLeagueServlet" method="GET" style="display: inline-block">
            <input type="submit" name="action" value="Delete"> 
            <input type="hidden" name="ID" value="<%=Id%>">
        </form>
        <form action="index.jsp" method="GET" style="display: inline-block"> 
            <input type="submit"  value="Cancel"> 

        </form>

    </body>
</html>
